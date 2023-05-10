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


Route::get('login', [\App\Http\Controllers\Web\AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [\App\Http\Controllers\Web\AuthController::class, 'login'])->name('login.post');


Route::get('/', [\App\Http\Controllers\Web\HomeController::class, 'index'])->name('index');

Route::get('product/{id}', [\App\Http\Controllers\Web\ProductController::class, 'detail'])->name('detail');


