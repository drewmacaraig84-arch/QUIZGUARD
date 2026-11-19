<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionBankController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentQuizController;
use Illuminate\Support\Facades\Route;

// redirect to login page
Route::get('/', function () {
    return redirect('/login');
});

// authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1'); // 5 tries per minute
Route::post('/logout', [AuthController::class, 'logout']);

// protected routes requires authentication from not users
Route::middleware('auth')->group(function () {

    // admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('/admin/activity-logs', [ActivityLogController::class, 'index']);

    // teacher
    Route::get('/teacher/dashboard', function () {
        return view('teacher.dashboard');
    });

    // question bank library
    Route::get('/teacher/question-banks', [QuestionBankController::class, 'index']);
    Route::post('/teacher/question-banks', [QuestionBankController::class, 'store']);
    Route::post('/teacher/question-banks/{id}/archive', [QuestionBankController::class, 'archive']);

    // quizzes
    Route::get('/teacher/quizzes', [QuizController::class, 'index']);
    Route::get('/teacher/quizzes/create', [QuizController::class, 'create']);
    Route::post('/teacher/quizzes', [QuizController::class, 'store']);

    // student
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    });

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
