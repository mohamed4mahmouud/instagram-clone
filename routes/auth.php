<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\ResetPasswordController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'register'])->name('register');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');

    // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    //             ->name('password.request');

    Route::post('/forgot-password', [ResetPasswordController::class, 'sendEmailToResetPassword'])
                ->name('password.email');

    Route::get('reset-password/{token}', [ResetPasswordController::class, 'verifyResetPassword'])
                ->name('password.reset');

    Route::post('reset-password', [ResetPasswordController::class, 'addNewPassword'])
                ->name('password.store');

    Route::get('/user/signup', [RegisteredUserController::class, 'create'])->name('user.signup');

});

Route::middleware('auth')->group(function () {

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

Route::get('verify-email/notice', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('verify-email/{token}', [VerificationController::class, 'verify'])->name('verification.verify');
