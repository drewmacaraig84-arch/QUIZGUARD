<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\QuestionBankController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentQuizController;
use App\Http\Controllers\TeacherResultController;
use App\Http\Controllers\TeacherSettingsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// TEMPORARY: skips the login page while it doesn't exist
Route::get('/dev-login/{role?}', function ($role = 'admin') {
    abort_unless(app()->environment('local'), 404);
    abort_unless(in_array($role, ['admin', 'teacher', 'student']), 404);

    $user = User::where('role', $role)->where('status', 'active')->first();
    abort_unless($user, 404, "No active $role found. Run: php artisan migrate:fresh --seed");

    Auth::login($user);
    return redirect("/$role/dashboard");
});

// ==========================================
// Admin Routes
// ==========================================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users', [UserController::class, 'store']);
    Route::post('/admin/users/{id}/toggle', [UserController::class, 'toggle']);
    Route::post('/admin/users/import', [UserController::class, 'import']);
    Route::get('/admin/sections-subjects', [SubjectController::class, 'index'])->name('admin.sections_subjects');
    Route::post('/admin/subjects', [SubjectController::class, 'store']);
    Route::post('/admin/subjects/{id}/toggle', [SubjectController::class, 'toggle']);
    Route::get('/admin/logs', [ActivityLogController::class, 'index'])->name('admin.logs');
});

// ==========================================
// Teacher Routes
// ==========================================
Route::middleware(['auth', 'role:teacher'])->group(function () {
    // Teacher Dashboard
    Route::get('/teacher/dashboard', [DashboardController::class, 'teacher']);

    // Question bank library
    Route::get('/teacher/question-banks', [QuestionBankController::class, 'index']);
    Route::post('/teacher/question-banks', [QuestionBankController::class, 'store']);
    Route::post('/teacher/question-banks/{id}/archive', [QuestionBankController::class, 'archive']);
    Route::post('/teacher/question-banks/{id}/activate', [QuestionBankController::class, 'activate']);
    Route::get('/teacher/question-banks/{id}', [QuestionBankController::class, 'show']);

    // Quizzes
    Route::get('/teacher/quizzes', [QuizController::class, 'index']);
    Route::get('/teacher/quizzes/create', [QuizController::class, 'create']);
    Route::post('/teacher/quizzes', [QuizController::class, 'store']);
    Route::get('/teacher/quizzes/{id}/edit', [QuizController::class, 'edit']);
    Route::post('/teacher/quizzes/{id}', [QuizController::class, 'update']);
    Route::post('/teacher/quizzes/{id}/deactivate', [QuizController::class, 'deactivate']);
    Route::post('/teacher/quizzes/{id}/activate', [QuizController::class, 'activate']);

    // Quiz results and attempt details
    Route::get('/teacher/quizzes/{id}/results', [TeacherResultController::class, 'results']);
    Route::get('/teacher/attempts/{id}', [TeacherResultController::class, 'attempt']);

    // Settings
    Route::get('/teacher/settings', [TeacherSettingsController::class, 'index']);
    Route::post('/teacher/settings/password', [TeacherSettingsController::class, 'password']);
});

// ==========================================
// Student Routes
// ==========================================
Route::middleware(['auth', 'role:student'])->group(function () {
    // Student Dashboard
    Route::get('/student/dashboard', [DashboardController::class, 'student']);

    // Quizzes the student can take
    Route::get('/student/quizzes', [StudentQuizController::class, 'index']);
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
