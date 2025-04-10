<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\MedicalInfoController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\QRCodeController;

// Default home route
Route::get('/', function () {
    return view('welcome');
});

// Registration routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Email verification routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


// Email verification with QR code generation
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// Resend verification email
Route::post('/email/resend', function () {
    request()->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


// Privacy Policy & Terms of Service
Route::view('/privacy-policy', 'privacy')->name('privacy');
Route::view('/terms-of-service', 'terms')->name('terms');

/**
 * Login and Logout Routes
 */

// Show the login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

// Handle the login form submission
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Handle the logout action
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/home', fn() => view('home'))->name('home');

    Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');

    Route::get('/medical-info', [MedicalInfoController::class, 'index'])->name('medical.info');
    Route::post('/medical-info', [MedicalInfoController::class, 'update'])->name('medical.info.update');

    Route::get('/logs', [LogController::class, 'index'])->name('logs');
});

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset Password
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


//route that captures the QR code key and directs the user to the correct page.
Route::get('/scan/{qr_code_key}', [QRCodeController::class, 'show'])->name('qr.view');

