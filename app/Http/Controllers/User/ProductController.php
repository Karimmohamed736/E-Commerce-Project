<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\User\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('User.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('User.products.show', compact('product'));
    }

    public function cart()
    {
        $cart = $this->productService->getCart();
        return view('User.products.cart.index', compact('cart'));
    }

    public function addToCart(Product $product, Request $request)
    {
        try {
            $this->productService->addToCart($product, $request->quantity);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
