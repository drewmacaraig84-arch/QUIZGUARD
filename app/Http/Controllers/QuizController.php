<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Question;
use App\Models\QuestionBank;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    public function index()
    {
       $quizzes = Quiz::with('subject')
            ->where('teacher_id', Auth::id())
            ->orderByRaw("CASE WHEN status = 'active' THEN 0 ELSE 1 END")
            ->orderBy('open_at', 'desc')
            ->get();

        return view('teacher.quizzes', ['quizzes' => $quizzes]);
    }

    public function create()
    {
        $banks = QuestionBank::with([
                'subject',
                'questions' => fn ($q) => $q->where('status', 'active')->orderBy('question_id'),
            ])
            ->where('teacher_id', Auth::id())
            ->where('status', 'active')
            ->orderBy('uploaded_at', 'desc')
            ->get();

        $subjects = Subject::where('status', 'active')
            ->orderBy('subject_code')
            ->get();

        $sections = User::where('role', 'student')
            ->where('status', 'active')
            ->whereNotNull('section')
            ->where('section', '!=', '')
            ->distinct()
            ->orderBy('section')
            ->pluck('section');

        return view('teacher.quiz_setup', [
            'banks'    => $banks,
            'subjects' => $subjects,
            'sections' => $sections,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'creation_mode'    => 'required|in:manual,bank',
            'title'            => 'required|string|max:45',
            'section'          => 'required|string|max:45',
            'time_limit_min'   => 'required|integer|min:1',
            'max_violation'    => 'required|integer|min:1',
            'passing_score'    => 'required|integer|min:0|max:100',
            'attempts_allowed' => 'required|integer|min:1',
            'grading_method'   => 'required|in:highest,latest',
            'open_at'          => 'required|date',
            'closed_at'        => 'required|date|after:open_at',
        ]);

        if ($request->creation_mode === 'bank') {
            $request->validate([
                'bank_id'             => 'required|exists:question_banks,bank_id',
                'number_of_questions' => 'required|integer|min:1',
            ]);

            $bank = QuestionBank::where('bank_id', $request->bank_id)
                ->where('teacher_id', Auth::id())
                ->where('status', 'active')
                ->firstOrFail();

            $available = Question::where('bank_id', $bank->bank_id)
                ->where('status', 'active')
                ->count();

            if ($request->number_of_questions > $available) {
                return back()
                    ->withErrors(['number_of_questions' => "This bank only has $available active questions."])
                    ->withInput();
            }

            $quiz = Quiz::create([
                'teacher_id'          => Auth::id(),
                'bank_id'             => $bank->bank_id,
                'subject_id'          => $bank->subject_id,
                'title'               => $request->title,
                'section'             => $request->section,
                'time_limit_min'      => $request->time_limit_min,
                'max_violation'       => $request->max_violation,
                'passing_score'       => $request->passing_score,
                'attempts_allowed'    => $request->attempts_allowed,
                'number_of_questions' => $request->number_of_questions,
                'grading_method'      => $request->grading_method,
                'open_at'             => $request->open_at,
                'closed_at'           => $request->closed_at,
                'shuffle_questions'   => $request->boolean('shuffle_questions'),
                'shuffle_answers'     => $request->boolean('shuffle_answers'),
                'status'              => 'active',
            ]);
        } else {
            // Manual / Wayground-style builder: no pre-uploaded question bank required
            $request->validate([
                'subject_id'                 => 'required|exists:subjects,subject_id',
                'questions'                  => 'required|array|min:1',
                'questions.*.text'           => 'required|string',
                'questions.*.type'           => 'required|in:multiple_choice,identification',
                'questions.*.points'         => 'required|integer|min:1',
                'questions.*.options'        => 'nullable|array',
                'questions.*.correct_answer' => 'required|string|max:255',
            ]);

            // Validate each multiple-choice question has >= 2 options and a valid correct letter
            $normalizedQuestions = [];
            foreach (array_values($request->questions) as $index => $q) {
                $num = $index + 1;
                if ($q['type'] === 'multiple_choice') {
                    $cleanOptions = [];
                    foreach (['A', 'B', 'C', 'D'] as $letter) {
                        $val = trim((string) ($q['options'][$letter] ?? ''));
                        if ($val !== '') {
                            $cleanOptions[$letter] = $val;
                        }
                    }

                    if (count($cleanOptions) < 2) {
                        return back()
                            ->withErrors(['questions' => "Question #$num must have at least 2 choices."])
                            ->withInput();
                    }

                    $correct = strtoupper(trim((string) $q['correct_answer']));
                    if (!isset($cleanOptions[$correct])) {
                        return back()
                            ->withErrors(['questions' => "Question #$num: select a non-empty choice as the correct answer."])
                            ->withInput();
                    }

                    $normalizedQuestions[] = [
                        'text'    => trim($q['text']),
                        'type'    => 'multiple_choice',
                        'options' => $cleanOptions,
                        'answer'  => $correct,
                        'points'  => (int) $q['points'],
                    ];
                } else {
                    $normalizedQuestions[] = [
                        'text'    => trim($q['text']),
                        'type'    => 'identification',
                        'options' => null,
                        'answer'  => trim((string) $q['correct_answer']),
                        'points'  => (int) $q['points'],
                    ];
                }
            }

            $quiz = DB::transaction(function () use ($request, $normalizedQuestions) {
                $bank = QuestionBank::create([
                    'teacher_id'       => Auth::id(),
                    'subject_id'       => $request->subject_id,
                    'bank_title'       => Str::limit($request->title, 45, ''),
                    'source_file_name' => 'Created in Quiz Setup',
                    'uploaded_at'      => now(),
                    'status'           => 'active',
                ]);

                foreach ($normalizedQuestions as $q) {
                    Question::create([
                        'bank_id'         => $bank->bank_id,
                        'question_text'   => $q['text'],
                        'question_type'   => $q['type'],
                        'options'         => $q['options'] ? json_encode($q['options']) : null,
                        'correct_answers' => $q['answer'],
                        'points'          => max(1, $q['points']),
                        'status'          => 'active',
                    ]);
                }

                return Quiz::create([
                    'teacher_id'          => Auth::id(),
                    'bank_id'             => $bank->bank_id,
                    'subject_id'          => $request->subject_id,
                    'title'               => $request->title,
                    'section'             => $request->section,
                    'time_limit_min'      => $request->time_limit_min,
                    'max_violation'       => $request->max_violation,
                    'passing_score'       => $request->passing_score,
                    'attempts_allowed'    => $request->attempts_allowed,
                    'number_of_questions' => count($normalizedQuestions),
                    'grading_method'      => $request->grading_method,
                    'open_at'             => $request->open_at,
                    'closed_at'           => $request->closed_at,
                    'shuffle_questions'   => $request->boolean('shuffle_questions'),
                    'shuffle_answers'     => $request->boolean('shuffle_answers'),
                    'status'              => 'active',
                ]);
            });
        }

        ActivityLog::record(
            Auth::user()->school_id_num,
            Auth::user()->role,
            'QUIZ_CREATED',
            'Created quiz: ' . $quiz->title
        );

        return redirect('/teacher/quizzes')->with('success', 'Quiz created.');
    }

    public function deactivate($id)
    {
        $quiz = Quiz::where('quiz_id', $id)
            ->where('teacher_id', Auth::id())
            ->firstOrFail();

        $quiz->update(['status' => 'inactive']);

        ActivityLog::record(
            Auth::user()->school_id_num,
            Auth::user()->role,
            'QUIZ_DEACTIVATED',
            'Deactivated quiz: ' . $quiz->title
        );

        return redirect('/teacher/quizzes')->with('success', 'Quiz deactivated.');
    }

    public function activate($id)
    {
        $quiz = Quiz::where('quiz_id', $id)
            ->where('teacher_id', Auth::id())
            ->firstOrFail();

        $quiz->update(['status' => 'active']);

        ActivityLog::record(
            Auth::user()->school_id_num,
            Auth::user()->role,
            'QUIZ_ACTIVATED',
            'Activated quiz: ' . $quiz->title
        );

        return redirect('/teacher/quizzes')->with('success', 'Quiz activated.');
    }
}