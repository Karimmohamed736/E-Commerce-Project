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

    public function cart(){
        $cart = session()->get('cart');
        return view('User.products.cart.index')->with('cart', $cart);
    }
    public function addToCart($id, Request $request){
        $product = Product::findOrFail($id);
        $quantity = $request->quantity;
        $cart = session()->get('cart');
        if ($quantity <= $product->quantity) {
            //if cart is empty then this the first product to be added to cart
            if (!$cart) {
                $cart = [
                    $id=> [
                        "name" => $product->name,
                        "price" => $product->price,
                        "quantity" => $quantity,
                        "image" => $product->image,
                        'total_price' => $product->price * $quantity
                    ]
                ];
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product added to cart successfully!');
            }else {
                //product already exists in cart so we will update the quantity and total price
                if(isset($cart[$id])){
                    $cart[$id]['quantity'] += $quantity;
                    $cart[$id]['total_price'] += $product->price * $cart[$id]['quantity'];
                    session()->put('cart', $cart);
                    return redirect()->back()->with('success', 'Product added to cart successfully!');
                }else {

                    //new product added to cart
                    $cart[$id] = [
                        "name" => $product->name,
                        "price" => $product->price,
                        "quantity" => $quantity,
                        "image" => $product->image,
                        'total_price' => $product->price * $quantity
                    ];
                    session()->put('cart', $cart);
                    return redirect()->back()->with('success', 'Product added to cart successfully!');
                }
            }

            }else {
                return redirect()->back()->with('error', 'Quantity must be less than or equal to product quantity!');
            }
        }
}
