<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionBankController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentQuizController;
use App\Http\Controllers\TeacherResultController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OtpController;
use Illuminate\Support\Facades\Route;

// redirect to login page
Route::get('/', function () {
    return redirect('/login');
});

// authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1'); // 5 tries per minute
Route::post('/logout', [AuthController::class, 'logout']);

// otp verification routes
Route::get('/verify-otp', [OtpController::class, 'showVerify']);
Route::post('/verify-otp', [OtpController::class, 'verify'])->middleware('throttle:5,1');
Route::post('/verify-otp/resend', [OtpController::class, 'resend'])->middleware('throttle:3,1');

// protected routes requires authentication from not users
Route::middleware('auth')->group(function () {

    // admin
    Route::get('/admin/dashboard', [DashboardController::class, 'admin']);
    Route::get('/admin/activity-logs', [ActivityLogController::class, 'index']);

    // manage users
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::post('/admin/users', [UserController::class, 'store']);
    Route::post('/admin/users/{id}/toggle', [UserController::class, 'toggle']);

    // manage subjects
    Route::get('/admin/subjects', [SubjectController::class, 'index']);
    Route::post('/admin/subjects', [SubjectController::class, 'store']);
    Route::post('/admin/subjects/{id}/toggle', [SubjectController::class, 'toggle']);

    // teacher
    Route::get('/teacher/dashboard', [DashboardController::class, 'teacher']);

    // question bank library
    Route::get('/teacher/question-banks', [QuestionBankController::class, 'index']);
    Route::post('/teacher/question-banks', [QuestionBankController::class, 'store']);
    Route::post('/teacher/question-banks/{id}/archive', [QuestionBankController::class, 'archive']);
    Route::get('/teacher/question-banks/{id}', [QuestionBankController::class, 'show']);

    // quizzes
    Route::get('/teacher/quizzes', [QuizController::class, 'index']);
    Route::get('/teacher/quizzes/create', [QuizController::class, 'create']);
    Route::post('/teacher/quizzes', [QuizController::class, 'store']);
    Route::get('/teacher/quizzes/{id}/edit', [QuizController::class, 'edit']);
    Route::post('/teacher/quizzes/{id}', [QuizController::class, 'update']);
    Route::post('/teacher/quizzes/{id}/deactivate', [QuizController::class, 'deactivate']);

    // quiz results and attempt details
    Route::get('/teacher/quizzes/{id}/results', [TeacherResultController::class, 'results']);
    Route::get('/teacher/attempts/{id}', [TeacherResultController::class, 'attempt']);

    // student
    Route::get('/student/dashboard', [DashboardController::class, 'student']);

    // quizzes the student can take
    Route::get('/student/quizzes', [StudentQuizController::class, 'index']);
    Route::post('/student/quizzes/{id}/start', [StudentQuizController::class, 'start']);

    // take the quiz
    Route::get('/student/attempts/{id}', [StudentQuizController::class, 'show']);
    Route::post('/student/attempts/{id}/answer', [StudentQuizController::class, 'saveAnswer']);
    Route::post('/student/attempts/{id}/submit', [StudentQuizController::class, 'submit']);
    Route::get('/student/attempts/{id}/result', [StudentQuizController::class, 'result']);

    // anti-cheat
    Route::post('/student/attempts/{id}/violation', [StudentQuizController::class, 'logViolation']);
    Route::post('/student/attempts/{id}/violation/{violationId}/return', [StudentQuizController::class, 'logReturn']);
});
