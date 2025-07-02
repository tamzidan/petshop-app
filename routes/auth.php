<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\WhatsappAuthController;
use App\Http\Controllers\WhatsappPasswordResetController;
use Illuminate\Support\Facades\Route;



// --- RUTE REGISTRASI VIA WHATSAPP ---
Route::middleware('guest')->group(function () {
    // Show register form (Step 1: Input phone number, password, referral)
    Route::get('register', [WhatsappAuthController::class, 'showRegisterForm'])->name('register');
    // Send OTP for registration
    Route::post('register/send-otp', [WhatsappAuthController::class, 'registerSendOtp'])->name('register.send-otp');
    // Show OTP verification form for registration
    Route::get('register/verify-otp', [WhatsappAuthController::class, 'showRegisterVerifyForm'])->name('register.verify');
    // Verify OTP and complete registration
    Route::post('register/verify-otp', [WhatsappAuthController::class, 'registerVerifyOtp'])->name('register.verify-otp');
});

// --- RUTE LOGIN VIA WHATSAPP DENGAN PASSWORD ---
Route::middleware('guest')->group(function () {
    Route::get('login', [WhatsappAuthController::class, 'showLoginForm'])->name('login'); // Ganti name menjadi 'login'
    Route::post('login', [WhatsappAuthController::class, 'authenticate']); // Ganti ke authenticate
});

// --- RUTE RESET PASSWORD VIA WHATSAPP OTP ---
Route::middleware('guest')->group(function () {
    // Show request form (input phone number)
    Route::get('forgot-password', [WhatsappPasswordResetController::class, 'showRequestForm'])->name('password.request');
    // Send OTP
    Route::post('forgot-password', [WhatsappPasswordResetController::class, 'sendResetOtp'])->name('password.email'); // Menggunakan nama 'password.email' agar link di login-whatsapp tidak perlu diubah

    // Show OTP verification form
    Route::get('reset-password/verify-otp', [WhatsappPasswordResetController::class, 'showVerifyForm'])->name('password.verify.whatsapp');
    // Verify OTP
    Route::post('reset-password/verify-otp', [WhatsappPasswordResetController::class, 'verifyOtp'])->name('password.verify.otp.whatsapp');

    // Show new password form
    Route::get('reset-password', [WhatsappPasswordResetController::class, 'showResetForm'])->name('password.reset.whatsapp');
    // Set new password
    Route::post('reset-password', [WhatsappPasswordResetController::class, 'resetPassword'])->name('password.store.whatsapp');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
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
