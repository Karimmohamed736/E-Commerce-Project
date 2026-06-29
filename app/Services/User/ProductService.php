<?php

namespace App\Services\User;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    private const CACHE_TTL = 3600; // Cache time in seconds
    private const CACHE_ALL_PRODUCTS = 'all_products';
    private const CACHE_PRODUCT_PREFIX = 'product_';

    public function getAllProducts()
    {
        return cache()->remember(self::CACHE_ALL_PRODUCTS, self::CACHE_TTL, function () {
            return Product::all();
        });
    }

    public function findProduct(int $id)
    {
        return cache()->remember(self::CACHE_PRODUCT_PREFIX . $id, self::CACHE_TTL, function () use ($id) {
            return Product::findOrFail($id);
        });
    }

    public function getCart(): array
    {
        return session()->get('cart', []);
    }

    public function addToCart(Product $product, $quantity)
    {
        if ($quantity > $product->quantity) {
            throw new \Exception('Quantity must be less than or equal to product quantity!');
        }

        $cart = $this->getCart();

        if (isset($cart[$product->id])) {
            // المنتج موجود — update الـ quantity والـ total_price بس
            $cart[$product->id]['quantity'] += $quantity;
            $cart[$product->id]['total_price'] = $cart[$product->id]['price'] * $cart[$product->id]['quantity'];
        } else {
            // منتج جديد
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
                'total_price' => $product->price * $quantity,
            ];
        }

        session()->put('cart', $cart);
        // $product->decrement('quantity', $quantity); //if you want to decrease the product quantity immediately after adding to cart, uncomment this line
        return true;
    }

    public function clearCache(?int $productId = null): void{

        Cache::forget(self::CACHE_ALL_PRODUCTS);
        if ($productId) {
            Cache::forget(self::CACHE_PRODUCT_PREFIX . $productId);
        }
    }

}
