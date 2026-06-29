<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'));

Route::get('change/{lang}', function ($lang) {
    session()->put('lang', in_array($lang, ['en', 'ar']) ? $lang : 'en');

    return redirect()->back();
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Jetstream)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'change_lang', config('jetstream.auth_session'), 'verified'])
    ->group(function () {
        Route::get('dashboard', [HomeController::class, 'Home'])->name('home');
    });

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin', 'change_lang'])
    ->controller(ProductController::class)
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('products', 'index')->name('products.all');
        Route::get('products/create', 'create')->name('products.create');
        Route::post('products', 'store')->name('products.store');
        Route::get('products/{product}/edit', 'editForm')->name('products.editForm');
        Route::put('products/{product}', 'update')->name('products.update');
        Route::delete('products/{product}', 'delete')->name('products.delete');
    });

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::name('user.')->group(function () {

    // Public — no auth required
    Route::controller(UserProductController::class)->group(function () {
        Route::get('products', 'index')->name('products.all');
        Route::get('products/{product}', 'show')->name('products.show');
    });

    // Protected — auth required
    Route::middleware(['auth', 'change_lang'])->group(function () {

        // Cart
        Route::controller(UserProductController::class)->group(function () {
            Route::get('cart', 'cart')->name('cart');
            Route::post('cart/{product}', 'addToCart')->name('addToCart');
        });

        // Orders
        Route::controller(OrderController::class)
            ->prefix('orders')
            ->name('orders.')
            ->group(function () {
                Route::get('/', 'index')->name('all');
                Route::get('{order}', 'show')->name('show');
                Route::delete('{order}', 'delete')->name('delete');
                Route::post('/', 'makeOrder')->name('make');
            });

        // Wishlist
        Route::controller(WishlistController::class)
            ->prefix('wishlist')
            ->name('wishlist.')
            ->group(function () {
                Route::get('/', 'index')->name('all');
                Route::post('{productId}', 'create')->name('create');
                Route::delete('{wishlist}', 'destroy')->name('destroy');
            });
    });
});
