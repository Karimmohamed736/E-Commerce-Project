<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\SmsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::controller(ProductController::class)->group(function(){
Route::get('allProducts','index');
Route::get('product/show/{id}','show');
Route::post('storeProduct','store');
Route::put('update/{id}','update');
Route::delete('delete/{id}','delete');
});



Route::controller(AuthController::class)->group(function(){
    Route::post('register','register');
    Route::post('login','login');
    Route::delete('logout','logout')->middleware('auth:sanctum');

});

Route::get('send-sms', [SmsController::class, 'send'])->name('send.sms');

