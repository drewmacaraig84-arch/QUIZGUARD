<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

//redirect to login page
Route::get('/', function () {
    return redirect('/login');
});

// authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// protected routes requires authentication from not users
Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/teacher/dashboard', function () {
        return view('teacher.dashboard');
    });

    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    });
});
