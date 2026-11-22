<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\QuestionBankController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentPortalController;
use App\Http\Controllers\StudentQuizController;
use App\Http\Controllers\TeacherResultController;
use Illuminate\Support\Facades\Route;

// Redirect home to login page
Route::get('/', function () {
    return redirect('/login');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1'); // 5 tries per minute
Route::post('/logout', [AuthController::class, 'logout']);

// OTP verification routes
Route::get('/verify-otp', [OtpController::class, 'showVerify']);
Route::post('/verify-otp', [OtpController::class, 'verify'])->middleware('throttle:5,1');
Route::post('/verify-otp/resend', [OtpController::class, 'resend'])->middleware('throttle:3,1');

// ==========================================
// Admin UI Preview Routes
// ==========================================
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/sections-subjects', [AdminController::class, 'sectionsSubjects'])->name('admin.sections_subjects');
    Route::get('/logs', [AdminController::class, 'logs'])->name('admin.logs');
});

// ==========================================
// Student Portal UI Preview Routes
// ==========================================
Route::prefix('student')->group(function () {
    Route::get('/quizzes', [StudentPortalController::class, 'quizzes'])->name('student.quizzes');
    Route::get('/instructions', [StudentPortalController::class, 'instructions'])->name('student.instructions');
    Route::get('/exam', [StudentPortalController::class, 'exam'])->name('student.exam');
    Route::get('/submitted', [StudentPortalController::class, 'submitted'])->name('student.submitted');
    Route::get('/reviewer', [StudentPortalController::class, 'reviewer'])->name('student.reviewer');
    Route::get('/profile', [StudentPortalController::class, 'profile'])->name('student.profile');
});

// ==========================================
// Protected Routes (Requires Authentication)
// ==========================================
Route::middleware('auth')->group(function () {

    // Admin Backend Actions
    Route::get('/admin/activity-logs', [ActivityLogController::class, 'index']);
    Route::post('/admin/users', [UserController::class, 'store']);
    Route::post('/admin/users/{id}/toggle', [UserController::class, 'toggle']);
    Route::get('/admin/subjects', [SubjectController::class, 'index']);
    Route::post('/admin/subjects', [SubjectController::class, 'store']);
    Route::post('/admin/subjects/{id}/toggle', [SubjectController::class, 'toggle']);

    // Teacher Dashboard
    Route::get('/teacher/dashboard', [DashboardController::class, 'teacher']);

    // Question bank library
    Route::get('/teacher/question-banks', [QuestionBankController::class, 'index']);
    Route::post('/teacher/question-banks', [QuestionBankController::class, 'store']);
    Route::post('/teacher/question-banks/{id}/archive', [QuestionBankController::class, 'archive']);
    Route::get('/teacher/question-banks/{id}', [QuestionBankController::class, 'show']);

    // Quizzes
    Route::get('/teacher/quizzes', [QuizController::class, 'index']);
    Route::get('/teacher/quizzes/create', [QuizController::class, 'create']);
    Route::post('/teacher/quizzes', [QuizController::class, 'store']);
    Route::get('/teacher/quizzes/{id}/edit', [QuizController::class, 'edit']);
    Route::post('/teacher/quizzes/{id}', [QuizController::class, 'update']);
    Route::post('/teacher/quizzes/{id}/deactivate', [QuizController::class, 'deactivate']);

    // Quiz results and attempt details
    Route::get('/teacher/quizzes/{id}/results', [TeacherResultController::class, 'results']);
    Route::get('/teacher/attempts/{id}', [TeacherResultController::class, 'attempt']);

    // Student Dashboard
    Route::get('/student/dashboard', [DashboardController::class, 'student']);

    // Quizzes the student can take
    Route::get('/student/quizzes-backend', [StudentQuizController::class, 'index']);
    Route::post('/student/quizzes/{id}/start', [StudentQuizController::class, 'start']);

    // Take the quiz
    Route::get('/student/attempts/{id}', [StudentQuizController::class, 'show']);
    Route::post('/student/attempts/{id}/answer', [StudentQuizController::class, 'saveAnswer']);
    Route::post('/student/attempts/{id}/submit', [StudentQuizController::class, 'submit']);
    Route::get('/student/attempts/{id}/result', [StudentQuizController::class, 'result']);

    // Anti-cheat
    Route::post('/student/attempts/{id}/violation', [StudentQuizController::class, 'logViolation']);
    Route::post('/student/attempts/{id}/violation/{violationId}/return', [StudentQuizController::class, 'logReturn']);
});
