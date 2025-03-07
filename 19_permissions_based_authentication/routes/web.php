<?php

use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\MagicLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocailAuthController;
use App\Http\Controllers\Auth\UpdateProfileController;
use App\Http\Controllers\Auth\VerifyAccountController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index');

// LOGIN ROUTES
Route::view('/login', 'auth.login')->name('login');
Route::post('login', LoginController::class);

// REGISTER ROUTES
Route::view('/register', 'auth.register')->name('register');
Route::post('register', RegisterController::class);

// PASSWORDLESS LOGIN ROUTES
Route::view('/login/magic', 'auth.passwordless-login')->name('login.magic');
Route::post('/login/magic', [MagicLoginController::class, 'sendMagicLink']);
Route::get('/login/magic/{user}', [MagicLoginController::class, 'loginHandler'])
  ->name('login.magic.handler')
  ->middleware('signed');

// SOCIAL AUTH ROUTES
Route::get("/auth/{driver}/redirect", [SocailAuthController::class, 'redirect']);
Route::get("/auth/{driver}/callback", [SocailAuthController::class, 'callback']);

// FORGOT PASSWORD ROUTES
Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
Route::post("/forgot-password", ForgotPasswordController::class)->name('password.email');

// RESET PASSWORD ROUTES
Route::view('/reset-password/{token}', 'auth.reset-password')->name('password.reset');
Route::post("/reset-password", ResetPasswordController::class)->name('password.update');

// VERIFY ACCOUNT ROUTES
Route::view("/verify-account/{identifier}", 'auth.verify-account')->name('account.verify');
Route::post("/verify-account", [VerifyAccountController::class, 'verifyOtp']);
Route::post('/send-verification-otp', [VerifyAccountController::class, 'sendOtp']);

Route::middleware(['auth', 'auth.session'])->group(function(){
 // PROFILE ROUTES
 Route::view('/profile', 'auth.profile');
 Route::put('profile', UpdateProfileController::class);
 Route::post('change-password', ChangePasswordController::class);
 
 // LOGOUT ROUTES
 Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
 Route::post('logout/{session}', [LogoutController::class, 'logoutDevice'])->name('logout-device');
 
 //  PAGE ROUTES 
  Route::view('student', 'pages.student')->middleware('permission:student');
  Route::view('teacher', 'pages.teacher')->middleware('permission:teacher');
  Route::view('admin', 'pages.admin')->middleware('permission:admin');

  // ADMIN ROUTES
  Route::prefix('admin')->group(function(){

    Route::get('users', [UsersController::class, 'index']);
    Route::get('users/{user}/change-role', [UsersController::class, 'changeRole']);
    Route::resource('roles', RolesController::class);
  });
});