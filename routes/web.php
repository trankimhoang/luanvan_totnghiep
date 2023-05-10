<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest:web'])->group(function () {
    Route::get('login', [\App\Http\Controllers\Web\AuthController::class, 'showFormLogin'])->name('login');
    Route::post('login', [\App\Http\Controllers\Web\AuthController::class, 'login'])->name('login.post');

    Route::get('register', [\App\Http\Controllers\Web\AuthController::class, 'showFormRegister'])->name('register');
    Route::post('register', [\App\Http\Controllers\Web\AuthController::class, 'register'])->name('register.post');

    Route::get('forget-password', [\App\Http\Controllers\Web\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [\App\Http\Controllers\Web\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [\App\Http\Controllers\Web\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [\App\Http\Controllers\Web\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

});

Route::get('/', [\App\Http\Controllers\Web\HomeController::class, 'index'])->name('index');

Route::get('product/{id}', [\App\Http\Controllers\Web\ProductController::class, 'detail'])->name('detail');

Route::get('logout', [\App\Http\Controllers\Web\AuthController::class, 'logout'])->name('logout');


