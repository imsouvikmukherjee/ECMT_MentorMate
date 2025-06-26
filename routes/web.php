<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\MentoringController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    if (Auth::check()) {
        $usertype = Auth::user()->usertype;
        if ($usertype === 'Student') {
            return redirect()->route('user.dashboard');
        } elseif (in_array($usertype, ['Admin', 'Mentor', 'Superadmin'])) {
            return redirect()->route('admin_dashboard');
        }
    }
    return redirect('/login');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth','isAdmin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('user-profile',[DashboardController::class,'userProfile'])->name('user_profile');
    Route::post('/user-profile-image-update',[DashboardController::class,'userImageUpdate']);
    Route::post('/user-profile-password-update',[DashboardController::class,'passwordUpdate']);

    Route::get('/student/dashboard',[DashboardController::class,'userDashboard'])->name('user.dashboard');
    Route::get('/student/edit-profile',[DashboardController::class,'editProfile'])->name('user.edit.profile');
    Route::post('/student/update-profile',[DashboardController::class,'updateProfile'])->name('user.update.profile');
    Route::get('/student/change-requests',[DashboardController::class,'showChangeRequests'])->name('user.change.requests');
    Route::get('/student/mentoring',[DashboardController::class,'mentoring'])->name('user.mentoring');
    // Route::post('/student/mentoring/update',[DashboardController::class,'updateMentoringData'])->name('user.mentoring.update');

    Route::get('student/add-mentoring',[DashboardController::class,'addmentoring'])->name('add_mentoring');

    Route::get('student/get-departments', [DashboardController::class, 'getDepartments'])->name('getDepartments.user');
    Route::get('student/get-semesters', [DashboardController::class, 'getSemesters'])->name('getSemesters.user');



    Route::get('/get-subjects/{semester_id}', [DashboardController::class, 'getSubjects']);
    Route::get('/get-practical-subjects/{semester_id}', [DashboardController::class, 'getPracticalSubjects']);
    Route::get('/get-semester-subjects/{semester_id}', [DashboardController::class, 'getSemesterSubjects']);
    Route::get('/get-attendance-subjects/{semester_id}', [DashboardController::class, 'getAttendanceSubjects']);
    Route::post('student/add-mentoring-store',[DashboardController::class,'addMentoringStore'])->name('add_mentoring_store');
    Route::get('student/mentoring-info/{id}',[DashboardController::class,'mentoringInfo']);
    Route::get('/student/mentoring-update/{id}',[DashboardController::class,'mentoringUpdate']);
    Route::post('/student/mentoring-update-store/{id}',[DashboardController::class,'mentoringUpdateStore']);

    // Mentoring Routes
    Route::get('/mentoring/edit', [MentoringController::class, 'edit'])
        ->name('user.mentoring.edit');
    Route::post('/mentoring/update', [MentoringController::class, 'update'])
        ->name('user.mentoring.update');
});

Route::get('/user/forgot-password',[ForgotPasswordController::class,'forgotPasswordForm'])->name('forgot_password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('send_reset_link');

Route::get('/reset-password-form/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password-store', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
