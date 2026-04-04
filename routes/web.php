<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\ProductController as UserProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
Route::get('dashboard', [HomeController::class, 'Home'])->name('home');

});

//Crud Admin
Route::middleware('auth','is_admin', 'change_lang')->group(function (){
Route::controller(ProductController::class)->group(function(){
Route::get('allProducts','index')->name('admin.products.all');
Route::get('createProduct','create')->name('admin.products.create');
Route::post('storeProduct','store')->name('admin.products.store');
Route::get('editForm/{id}','editForm')->name('admin.products.editForm');
Route::put('update/{id}','update')->name('admin.products.update');
Route::delete('delete/{id}','delete')->name('admin.products.delete');
});
});


//USer
Route::controller(UserProductController::class)->group(function(){
    Route::get('all-products', 'index')->name('user.products.all');
});


Route::controller(UserProductController::class)->group(function(){
    Route::get('all-products', 'index')->name('user.products.all');
    Route::get('show/{id}','show')->name('user.products.show');
});

Route::get('change/{id}',function($lang){
    if ($lang == 'en') {
        session()->put('lang','en');
    }else {
        session()->put('lang', 'ar');
    }

    return redirect()->back();
});

Route::get('change/{id}',function($lang){
    if ($lang == 'en') {
        session()->put('lang','en');
    }else {
        session()->put('lang', 'ar');
    }

    return redirect()->back();
});


