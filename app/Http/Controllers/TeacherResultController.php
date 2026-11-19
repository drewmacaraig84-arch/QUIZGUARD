<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Quiz;
use App\Models\StudentAnswer;
use App\Models\ViolationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherResultController extends Controller
{
    // results of one quiz : one row per student using the quiz grading_method
    public function results($id)
    {
        // the quiz must belong to the logged-in teacher
        $quiz = Quiz::with('subject')
            ->where('quiz_id', $id)
            ->where('teacher_id', Auth::id())
            ->firstOrFail();

        // finished attempts only
        $attempts = Attempt::with('student')
            ->where('quiz_id', $quiz->quiz_id)
            ->where('status', '!=', 'in_progress')
            ->get();

        // group by student then pick the attempt that counts
        $results = $attempts->groupBy('student_id')->map(function ($studentAttempts) use ($quiz) {
            if ($quiz->grading_method === 'highest') {
                $counted = $studentAttempts->sortByDesc('percentage')->first();   // best attempt
            } else {
                $counted = $studentAttempts->sortByDesc('submitted_at')->first(); // latest attempt
            }

            return [
                'student'  => $counted->student,
                'counted'  => $counted,
                'attempts' => $studentAttempts->count(),   // how many attempts the student used
            ];
        })->values();

        // quick summary on the top of the page
        $average = $results->count() > 0 ? round($results->avg(fn($r) => $r['counted']->percentage)) : 0;
        $passed  = $results->filter(fn($r) => $r['counted']->percentage >= $quiz->passing_score)->count();

        return view('teacher.quiz_results', [
            'quiz'     => $quiz,
            'results'  => $results,
            'average'  => $average,
            'passed'   => $passed,
            'attempts' => $attempts,   // every attempt if the page wants a full list
        ]);
    }

    // details of one attempt: answers and every violation
    public function attempt($id)
    {
        $attempt = Attempt::with(['student', 'quiz'])->where('attempt_id', $id)->firstOrFail();

        // the attempt's quiz must belong to the logged-in teacher
        abort_if($attempt->quiz->teacher_id != Auth::id(), 404);

        // teacher can see the questions with the correct answers
        $answers = StudentAnswer::with('question')
            ->where('attempt_id', $attempt->attempt_id)
            ->orderBy('answer_id')
            ->get();

        // violations in the order they happened
        $violations = ViolationLog::where('attempt_id', $attempt->attempt_id)
            ->orderBy('occurred_at')
            ->get();

        // readable names for the violation types
        $labels = [
            'tab_switch'      => 'Switched browser tab',
            'third_party_app' => 'Used another app',
            'fullscreen_exit' => 'Exited fullscreen',
            'copy_paste'      => 'Copy / paste',
            'window_blur'     => 'Left the window',
        ];

        return view('teacher.attempt_detail', [
            'attempt'    => $attempt,
            'answers'    => $answers,
            'violations' => $violations,
            'labels'     => $labels,
        ]);
    }
}
