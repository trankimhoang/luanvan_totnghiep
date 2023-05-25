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

    Route::get('forget-password', [\App\Http\Controllers\Admin\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [\App\Http\Controllers\Admin\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [\App\Http\Controllers\Admin\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [\App\Http\Controllers\Admin\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

});

Route::middleware(['auth:admin'])->group(function (){
    Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    Route::get('index', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('index');

    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::get('render-product-child-new-row',
        [\App\Http\Controllers\Admin\ProductController::class, 'renderProductChildNewRow']
    )->name('products.render-product-child-new-row');

    Route::get('render_image_review', [\App\Http\Controllers\Admin\ProductController::class, 'renderImageReview'])->name('products.render_image_review');

    Route::resource('admins', \App\Http\Controllers\Admin\AdminController::class);

    Route::resource('attributes', \App\Http\Controllers\Admin\AttributeController::class);

    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

    Route::get('render-attribute', [\App\Http\Controllers\Admin\ProductController::class, 'renderAttribute'])->name('renderAttribute');
    Route::get('render-attribute-product-child', [\App\Http\Controllers\Admin\ProductController::class, 'renderAttributeListProductChild'])
        ->name('renderAttributeProductChild');

    Route::resource('banners', \App\Http\Controllers\Admin\BannerController::class);

    Route::get('order', [\App\Http\Controllers\Admin\OrderController::class, 'order'])->name('order');
});

