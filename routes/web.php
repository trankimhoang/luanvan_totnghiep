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

// login with social
Route::get('/redirect/{social}', [\App\Http\Controllers\Web\SocialAuthController::class, 'redirect'])->name('social.redirect');
Route::get('/callback/{social}', [\App\Http\Controllers\Web\SocialAuthController::class, 'callback'])->name('social.callback');
// end login with social

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
Route::group(['middleware' => ['checkStatusUser']], function () {
    Route::get('/', [\App\Http\Controllers\Web\HomeController::class, 'index'])->name('index');

    Route::get('product/{id}', [\App\Http\Controllers\Web\ProductController::class, 'detail'])->name('detail');

    Route::get('logout', [\App\Http\Controllers\Web\AuthController::class, 'logout'])->name('logout');

    Route::get('category/{id}/detail', [\App\Http\Controllers\Web\CategoryController::class, 'categoryDetail'])->name('detail.category');

    Route::get('search', [\App\Http\Controllers\Web\HomeController::class, 'search'])->name('search');

    Route::get('about', [\App\Http\Controllers\Web\HomeController::class, 'about'])->name('about');

    Route::get('contact', [\App\Http\Controllers\Web\HomeController::class, 'contact'])->name('contact');

    Route::get('add-cart', [\App\Http\Controllers\Web\CartController::class, 'addCart'])
        ->name('cart.add')
        ->middleware('isLoginWebAjax');
});

Route::group(['middleware' => ['auth:web', 'checkStatusUser']], function () {
    Route::get('cart', [\App\Http\Controllers\Web\CartController::class, 'listProductInCart'])->name('list.product.cart');

    Route::get('delete', [\App\Http\Controllers\Web\CartController::class, 'deleteProductCart'])->name('delete.product.cart');

    Route::post('create-order', [\App\Http\Controllers\Web\OrderController::class, 'createOrder'])->name('create.order');
    Route::get('checkout', [\App\Http\Controllers\Web\OrderController::class, 'checkOut'])->name('checkout.order');
    Route::get('order-success', [\App\Http\Controllers\Web\OrderController::class, 'success'])->name('success.order');
    Route::get('order-error', [\App\Http\Controllers\Web\OrderController::class, 'error'])->name('error.order');

    Route::get('profile', [\App\Http\Controllers\Web\ProfileController::class, 'showFormProfile'])->name('profile');
    Route::post('profile/{id}', [\App\Http\Controllers\Web\ProfileController::class, 'profile'])->name('profile.post');
    Route::get('momo-return', [\App\Http\Controllers\Web\OrderController::class, 'momoReturn'])->name('momo_return');

    Route::get('list-order', [\App\Http\Controllers\Web\OrderController::class, 'listOrderOfUser'])->name('list_order_of_user');
    Route::get('order/{id}', [\App\Http\Controllers\Web\OrderController::class, 'orderDetail'])->name('order_detail');
    Route::post('order/{id}', [\App\Http\Controllers\Web\OrderController::class, 'updateStatusOrder'])->name('order_update_status');
});
