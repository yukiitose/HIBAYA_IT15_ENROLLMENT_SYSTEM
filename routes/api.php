<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;

// Public routes - NO auth required
Route::post('/login',           [AuthController::class, 'login']);
Route::post('/forgot-password', [PasswordResetController::class, 'forgotPassword']);
Route::post('/reset-password',  [PasswordResetController::class, 'resetPassword']);
Route::post('/self-register', [PasswordResetController::class, 'selfRegister']);
Route::post('/create-password', [PasswordResetController::class, 'createPassword']);

// Protected routes - auth required
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',   [AuthController::class, 'logout']);
    Route::get('/user',      [AuthController::class, 'user']);
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/students',                      [StudentController::class, 'index']);
    Route::get('/students/summary',              [StudentController::class, 'summary']);
    Route::get('/students/enrollment-stats',     [StudentController::class, 'enrollmentStats']);
    Route::get('/students/course-distribution',  [StudentController::class, 'courseDistribution']);

    Route::get('/courses',               [CourseController::class, 'index']);
    Route::get('/courses/by-department', [CourseController::class, 'byDepartment']);
    Route::get('/courses/summary',       [CourseController::class, 'summary']);
});