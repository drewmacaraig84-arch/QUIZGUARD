<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Question;
use App\Models\QuestionBank;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    // list of ACTIVE quizzes
    public function index()
    {
        $quizzes = Quiz::with('subject')
            ->where('teacher_id', Auth::id())
            ->where('status', 'active')      // hides inactive/archived (soft deleted) quizzes
            ->orderBy('open_at', 'desc')
            ->get();

        return view('teacher.quizzes', ['quizzes' => $quizzes]);
    }

    // teacher picks one of their active banks from the library
    public function create()
    {
        $banks = QuestionBank::where('teacher_id', Auth::id())
            ->where('status', 'active')
            ->get();

        return view('teacher.quiz_create', ['banks' => $banks]);
    }

    // saves new quiz
    public function store(Request $request)
    {
        // validate every field before touching the database
        $request->validate([
            'bank_id'             => 'required|exists:question_banks,bank_id',
            'title'               => 'required|max:45',
            'section'             => 'required|max:45',
            'time_limit_min'      => 'required|integer|min:1',
            'max_violation'       => 'required|integer|min:1',
            'passing_score'       => 'required|integer|min:0|max:100',
            'attempts_allowed'    => 'required|integer|min:1',
            'number_of_questions' => 'required|integer|min:1',
            'grading_method'      => 'required|in:highest,latest',
            'open_at'             => 'required|date',
            'closed_at'           => 'required|date|after:open_at',
        ]);

        // the bank must be active and owned by teacher
        $bank = QuestionBank::where('bank_id', $request->bank_id)
            ->where('teacher_id', Auth::id())
            ->where('status', 'active')
            ->firstOrFail();

        // count the active questions inside that bank
        $available = Question::where('bank_id', $bank->bank_id)
            ->where('status', 'active')
            ->count();

        // can't ask for more questions than the bank has
        if ($request->number_of_questions > $available) {
            return back()
                ->withErrors(['number_of_questions' => "This bank only has $available questions."])
                ->withInput();
        }

        $quiz = Quiz::create([
            'teacher_id'          => Auth::id(),          // always the logged-in teacher
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
            // checkboxes: true if ticked, false if not
            'shuffle_questions'   => $request->boolean('shuffle_questions'),
            'shuffle_answers'     => $request->boolean('shuffle_answers'),
            'status'              => 'active',            // new quizzes start active
        ]);

        ActivityLog::record(Auth::user()->school_id_num, Auth::user()->role, 'QUIZ_CREATED', 'Created quiz: ' . $quiz->title);

        return redirect('/teacher/quizzes')->with('success', 'Quiz created.');
    }

    // shows the questions inside one bank
    // teacher can see the correct answers
    public function show($id)
    {
        $bank = QuestionBank::with('subject')
            ->where('bank_id', $id)
            ->where('teacher_id', Auth::id())
            ->where('status', 'active')
            ->firstOrFail();

        $questions = Question::where('bank_id', $bank->bank_id)
            ->where('status', 'active')
            ->orderBy('question_id')
            ->get();   // options is JSON text: json_decode it in the view

        return view('teacher.bank_questions', ['bank' => $bank, 'questions' => $questions]);
    }
}
