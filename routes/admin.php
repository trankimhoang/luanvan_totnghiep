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
Route::middleware(['guest:admin'])->group(function (){
    Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'showFormLogin'])->name('login');
    Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');

});

Route::middleware(['auth:admin'])->group(function (){
    Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    Route::get('index', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('index');

    Route::resource('products', \App\Http\Controllers\Admin\Product\ProductController::class);
});

