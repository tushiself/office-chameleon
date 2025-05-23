<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\StaffController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'Login'])->name('login');
Route::post('/sign-in', [AuthController::class, 'signin'])->name('login.store');
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetPasswordEmail'])->name('password.email');
Route::get('/password/change',  [AuthController::class, 'create'])
    ->name('password.change.form');

Route::post('/password/change', [AuthController::class, 'store'])
    ->name('password.change.store');

    // AuthController -------------------------------------------


    // DashboardController -------------------------------------------
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
    });

    // profileController -------------------------------------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/monthly-attendance', [ProfileController::class, 'monthlyAttendance'])
        ->name('profile.monthlyAttendance')
        ->middleware('auth');

    Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('update.password');
    Route::delete('/profile-delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('department', DepartmentController::class, ['name' => 'department']);
    Route::resource('new-staff', StaffController::class, ['name' => 'staff']);
    Route::get('/generate-staff-id', [StaffController::class, 'generateStaffId']);
    Route::resource('leave-types', LeaveTypeController::class, ['name' => 'leavetypes']);
    Route::resource('leave', LeaveController::class, ['name' => 'leave']);
    Route::get('all-leave', [LeaveController::class, 'Allleave'])->name('allleave');
    Route::post('/leave/update-status/{id}', [LeaveController::class, 'updateStatus'])->name('leave.updateStatus');

    Route::get('salary-report', [SalaryController::class, 'salaryReport'])->name('salary.report');

    Route::resource('attendance', AttendanceController::class, ['name' => 'attendance']);
    Route::get('my-attendance', [AttendanceController::class, 'MyAttendance'])->name('myattendance');
    Route::post('/attendance/status', [AttendanceController::class, 'updateStatus'])->name('attendance.status');
    Route::post('/attendance/clockout', [AttendanceController::class, 'clockOut'])->name('attendance.clockOut');
    Route::post('/attendance/start-session', [AttendanceController::class, 'startSession'])->name('attendance.startSession');
    Route::post('/attendance/pause-session', [AttendanceController::class, 'pauseSession'])->name('attendance.pauseSession');

    Route::resource('holiday', HolidayController::class, ['name' => 'holiday']);
    Route::resource('policy', PolicyController::class, ['name' => 'policy']);
