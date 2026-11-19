<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Quiz;
use App\Models\QuestionBank;
use App\Models\Subject;
use App\Models\User;
use App\Models\ViolationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // admin: counts across the system
    public function admin()
    {
        return view('admin.dashboard', [
            'students'   => User::where('role', 'student')->where('status', 'active')->count(),
            'teachers'   => User::where('role', 'teacher')->where('status', 'active')->count(),
            'subjects'   => Subject::where('status', 'active')->count(),
            'quizzes'    => Quiz::where('status', 'active')->count(),
            'attempts'   => Attempt::count(),
            'violations' => ViolationLog::count(),
        ]);
    }

    // teacher: counts for the teacher own work
    public function teacher()
    {
        // attempts that belong to teacher quizzes
        $myAttempts = Attempt::whereHas('quiz', fn($q) => $q->where('teacher_id', Auth::id()));

        return view('teacher.dashboard', [
            'banks'      => QuestionBank::where('teacher_id', Auth::id())->where('status', 'active')->count(),
            'quizzes'    => Quiz::where('teacher_id', Auth::id())->where('status', 'active')->count(),
            'attempts'   => (clone $myAttempts)->count(),
            'flagged'    => (clone $myAttempts)->where('violation_count', '>', 0)->count(),   // attempts with violations
        ]);
    }

    // student: open quizzes, finished attempts, unfinished attempt
    public function student()
    {
        $now = now();

        return view('student.dashboard', [
            'openQuizzes' => Quiz::where('status', 'active')
                ->where('section', Auth::user()->section)
                ->where('open_at', '<=', $now)
                ->where('closed_at', '>=', $now)
                ->count(),
            'finished'    => Attempt::where('student_id', Auth::id())->where('status', '!=', 'in_progress')->count(),
            'ongoing'     => Attempt::where('student_id', Auth::id())->where('status', 'in_progress')->first(),
        ]);
    }
}
