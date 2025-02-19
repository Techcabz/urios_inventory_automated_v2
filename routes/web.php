<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ErrorsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Auth\CustomRegistrationController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::get('register', [CustomRegistrationController::class, 'index'])->name('register.custom');
Route::get('login', [CustomLoginController::class, 'index'])->name('login.custom');
Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::prefix('myaccount')->middleware(['auth'])->group(function () {
    Route::get('dashboard', [AccountController::class, 'dashboard'])->name('myaccount.dashboard');
    Route::get('profile', [AccountController::class, 'profile'])->name('myaccount.profile');
    Route::get('security', [AccountController::class, 'security'])->name('myaccount.security');
});

Route::middleware(['auth'])->group(function () {
// 
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->group(function () {
        Route::get('pending', [UsersController::class, 'pending'])->name('users.pending');
        Route::get('management', [UsersController::class, 'management'])->name('users.management');
        Route::get('myaccount', [UsersController::class, 'myaccount'])->name('users.myaccount');
    });
   
    Route::fallback([ErrorsController::class, 'index']);
});
