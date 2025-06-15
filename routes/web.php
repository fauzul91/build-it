<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    HomeController,
    TutorController,
    CourseController,
    AccountController,
    CategoryController,
    CourseVideoController,
    TransactionController,
    CourseBenefitController
};

Route::get('/', [HomeController::class, 'index'])->name('landing.home');
Route::get('/kelas', [HomeController::class, 'course'])->name('landing.course');
Route::get('/kelas/{slug}', [HomeController::class, 'detail'])->name('course.detail');
Route::get('/jadi-tutor', [HomeController::class, 'jadiTutor'])->name('landing.tutor');
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
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/settings', [AccountController::class, 'index'])->name('settings');
    Route::post('/settings/profile', [AccountController::class, 'updateProfile'])->name('settings.profile.update');
    Route::post('/settings/password', [AccountController::class, 'updatePassword'])->name('settings.password.update');
    Route::get('/kelas/{slug}/order', [TransactionController::class, 'showOrder'])->name('order.index');
    Route::post('/kelas/{slug}/checkout', [TransactionController::class, 'checkout'])->name('order.checkout');
    Route::get('/transactions', fn() => view('transaction.index'))->name('transaction.index');
    Route::get('/dashboard', fn() => view('dashboard.index'))->name('dashboard');
});

Route::prefix('tutor')->middleware('auth')->group(function () {
    Route::get('/verif', [TutorController::class, 'verif'])->name('tutor.verif');
    Route::post('/verif', [TutorController::class, 'verifStore'])->name('tutor.verif.store');
    Route::get('/status-course', [CourseController::class, 'tutorStatusCourses'])->name('course.tutor.status');
    Route::resource('courses', CourseController::class);
    Route::post('/course/{id}/publish', [CourseController::class, 'publish'])->name('course.publish');
    Route::post('/course/{id}/resubmit', [CourseController::class, 'resubmit'])->name('course.resubmit');
    Route::get('/courses/{course}/preview', [CourseController::class, 'preview'])->name('tutor.course.preview');
    Route::resource('courses.videos', CourseVideoController::class);
    Route::resource('courses.benefits', CourseBenefitController::class);
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/tutor-aktif', [TutorController::class, 'activeTutors'])->name('tutor.active');
    Route::get('/tutor-pending', [TutorController::class, 'pendingTutors'])->name('tutor.pending');
    Route::post('/tutor/approve/{id}', [TutorController::class, 'approve'])->name('tutor.approve');
    Route::post('/tutor/reject/{id}', [TutorController::class, 'reject'])->name('tutor.reject');
    Route::get('/course-verification', [CourseController::class, 'pendingCourses'])->name('course.verification.index');
    Route::get('/course-active', [CourseController::class, 'activeCourses'])->name('course.active.index');
    Route::get('/course/{course}/detail', [CourseController::class, 'adminShow'])->name('admin.course.show');
    Route::post('/course/{id}/approve', [CourseController::class, 'approve'])->name('course.approve');
    Route::post('/course/{id}/reject', [CourseController::class, 'reject'])->name('course.reject');
    Route::get('/courses/{course}/preview', [CourseController::class, 'adminPreview'])->name('admin.course.preview');
    Route::resource('categories', CategoryController::class);
});