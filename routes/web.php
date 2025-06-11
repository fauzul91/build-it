<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseVideoController;

Route::get('/', [HomeController::class, 'index'])->name('landing.home');
Route::get('/kelas', [HomeController::class, 'course'])->name('landing.course');
Route::get('/kelas/detail', [HomeController::class, 'detail'])->name('course.detail');
Route::get('/jadi-tutor', [HomeController::class, 'jadiTutor'])->name('landing.tutor');
Route::get('/course/{course}', [CourseController::class, 'show'])->name('course.show');
Route::get('/auth-google-redirect', [AuthController::class, 'google_redirect'])->name('google-redirect');
Route::get('/auth-google-callback', [AuthController::class, 'google_callback'])->name('google-callback');

Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', fn() => view('auth.register'))->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/register-tutor', fn() => view('auth.register-tutor'))->name('register.tutor');
    Route::post('/register-tutor', [AuthController::class, 'registerTutor']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.index'))->name('dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/settings', [AccountController::class, 'index'])->name('settings');
    Route::post('/settings/profile', [AccountController::class, 'updateProfile'])->name('settings.profile.update');
    Route::post('/settings/password', [AccountController::class, 'updatePassword'])->name('settings.password.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:tutor'])->group(function () {
    Route::get('/verif', [TutorController::class, 'verif'])->name('tutor.verif');
    Route::post('/verif', [TutorController::class, 'verifStore'])->name('tutor.verif.store');
    Route::get('/status-course', [CourseController::class, 'tutorStatusCourses'])->name('course.tutor.status');
    Route::resource('courses', CourseController::class);
    Route::post('/course/publish/{id}', [CourseController::class, 'publish'])->name('course.publish');
    Route::resource('courses.videos', CourseVideoController::class);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/tutor-aktif', [TutorController::class, 'activeTutors'])->name('tutor.active');
    Route::get('/tutor-pending', [TutorController::class, 'pendingTutors'])->name('tutor.pending');
    Route::post('/tutor/approve/{id}', [TutorController::class, 'approve'])->name('tutor.approve');
    Route::post('/tutor/reject/{id}', [TutorController::class, 'reject'])->name('tutor.reject');
    Route::post('/course/approve/{id}', [CourseController::class, 'approve'])->name('course.approve');
    Route::post('/course/reject/{id}', [CourseController::class, 'reject'])->name('course.reject');
    Route::get('/course-verification', [CourseController::class, 'pendingCourses'])->name('course.verification.index');
    Route::get('/course-active', [CourseController::class, 'activeCourses'])->name('course.active.index');
    Route::resource('categories', CategoryController::class);
});

Route::middleware(['auth', 'role:admin|tutor'])->group(function () {
    Route::get('/course/{course}/videos/preview', [CourseController::class, 'preview'])->name('video.preview');
    Route::get('/transactions', fn() => view('transaction.index'))->name('transaction.index');
});