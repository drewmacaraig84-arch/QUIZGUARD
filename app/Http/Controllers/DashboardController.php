<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Quiz;
use App\Models\QuestionBank;
use App\Models\Subject;
use App\Models\User;
use App\Models\ViolationLog;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // admin: live numbers taken from the real tables
    public function admin()
    {
        // is the database answering, and how fast? (a real measurement)
        $start = microtime(true);
        try {
            DB::select('select 1');
            $dbOk = true;
        } catch (\Exception $e) {
            $dbOk = false;
        }
        $dbMs = round((microtime(true) - $start) * 1000);

        $since = now()->subDay();

        // last 24 hours in 12 blocks of 2 hours (oldest first): failed logins + violations
        $chart = [];
        for ($i = 11; $i >= 0; $i--) {
            $end  = now()->subHours($i * 2);
            $from = $end->copy()->subHours(2);

            $events = ActivityLog::where('action', 'LOGIN_FAILED')
                ->where('created_at', '>', $from)->where('created_at', '<=', $end)->count()
                + ViolationLog::where('occurred_at', '>', $from)->where('occurred_at', '<=', $end)->count();

            $chart[] = ['label' => $end->format('g A'), 'events' => $events];
        }

        // bar height as a percentage of the biggest bar (max 85% so the number fits above it)
        $max = max(1, max(array_column($chart, 'events')));
        foreach ($chart as $k => $bar) {
            $chart[$k]['height'] = max(2, round($bar['events'] / $max * 85));
        }

        return view('admin.dashboard', [
            // totals
            'students'   => User::where('role', 'student')->where('status', 'active')->count(),
            'teachers'   => User::where('role', 'teacher')->where('status', 'active')->count(),
            'subjects'   => Subject::where('status', 'active')->count(),
            'quizzes'    => Quiz::where('status', 'active')->count(),
            'attempts'   => Attempt::count(),
            'violations' => ViolationLog::count(),

            // live numbers
            'activeSessions' => Attempt::where('status', 'in_progress')->count(),
            'failedLogins'   => ActivityLog::where('action', 'LOGIN_FAILED')->where('created_at', '>=', $since)->count(),
            'violations24'   => ViolationLog::where('occurred_at', '>=', $since)->count(),
            'dbOk'           => $dbOk,
            'dbMs'           => $dbMs,
            'mailer'         => config('mail.default'),

            // chart and table
            'chart'      => $chart,
            'chartTotal' => array_sum(array_column($chart, 'events')),
            'recent'     => ActivityLog::with('user')
                ->whereIn('action', ['LOGIN_FAILED', 'QUIZ_AUTO_SUBMITTED'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
            'checkedAt'  => now()->format('M d, g:i A'),
        ]);
    }

    // teacher: counts for the teacher own work
    public function teacher()
    { // attempts that belong to the teacher's quizzes
        $myAttempts = Attempt::whereHas('quiz', fn($q) => $q->where('teacher_id', Auth::id()));

        // same attempts as a list of ids, used to find the teacher's violations
        $myAttemptIds = Attempt::whereHas('quiz', fn($q) => $q->where('teacher_id', Auth::id()))->select('attempt_id');

        return view('teacher.dashboard', [
            'banks'    => QuestionBank::where('teacher_id', Auth::id())->where('status', 'active')->count(),
            'quizzes'  => Quiz::where('teacher_id', Auth::id())->where('status', 'active')->count(),
            'attempts' => (clone $myAttempts)->count(),
            'flagged'  => (clone $myAttempts)->where('violation_count', '>', 0)->count(),

            // new: today's numbers
            'submissionsToday' => (clone $myAttempts)->where('status', '!=', 'in_progress')->whereDate('submitted_at', today())->count(),
            'violationsToday'  => ViolationLog::whereIn('attempt_id', $myAttemptIds)->whereDate('occurred_at', today())->count(),

            // new: the "My Quizzes" table (closing soonest first) and the "Recent Violations" list
            'quizList' => Quiz::with('subject')
                ->where('teacher_id', Auth::id())
                ->where('status', 'active')
                ->orderBy('closed_at')
                ->limit(5)
                ->get(),
            'recentViolations' => ViolationLog::with('attempt.student', 'attempt.quiz')
                ->whereIn('attempt_id', $myAttemptIds)
                ->orderBy('occurred_at', 'desc')
                ->limit(5)
                ->get(),
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
