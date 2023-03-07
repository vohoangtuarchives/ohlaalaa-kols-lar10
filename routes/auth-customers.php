<?php

use App\Http\Controllers\Index\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Index\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Index\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Index\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Index\Auth\NewPasswordController;
use App\Http\Controllers\Index\Auth\PasswordController;
use App\Http\Controllers\Index\Auth\PasswordResetLinkController;
use App\Http\Controllers\Index\Auth\RegisteredUserController;
use App\Http\Controllers\Index\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:customers')->group(function () {
    Route::get('dang-ky', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('dang-ky', [RegisteredUserController::class, 'store']);

    Route::get('dang-nhap', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('dang-nhap', [AuthenticatedSessionController::class, 'store']);

    Route::get('quen-mat-khau', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('quen-mat-khau', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('dat-lai-mat-khau/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('dat-lai-mat-khau', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth:customers')->group(function () {
    Route::get('xac-nhan-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('xac-nhan-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

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
