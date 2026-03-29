<?php

use App\Http\Controllers\API\ProductController;
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

