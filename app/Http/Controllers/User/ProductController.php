<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('User.products.index')->with('products', $products);
    }

    public function show($id){
        $product = Product::findOrFail($id);
        return view('User.products.show')->with('product', $product);
    }
}
