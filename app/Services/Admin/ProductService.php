<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    private const CACHE_TTL = 3600; // Cache time in seconds
    private const CACHE_ALL_PRODUCTS = 'all_products';
    private const CACHE_PRODUCT_PREFIX = 'product_';

    public function getProducts()
    {
        return Cache::remember(self::CACHE_ALL_PRODUCTS, self::CACHE_TTL, function () {
            return Product::get();
        });
    }

    // public function getCategories()
    // {
    //     return Category::all();
    // }

    public function store(array $data, $image)
    {
        $data['image'] = Storage::putFile('products', $image);
        $product = Product::create($data);
        $this->clearCache();
        return $product;
    }

    public function update(Product $product, array $data, $image = null)
    {
        if ($image) {
            Storage::delete($product->image);
            $data['image'] = Storage::putFile('products', $image);
        }

        $product->update($data);
        $this->clearCache($product->id);
        return $product;
    }

    public function delete(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();
        $this->clearCache($product->id);
    }

    private function clearCache(?int $productId = null): void
    {
        Cache::forget(self::CACHE_ALL_PRODUCTS);
        if ($productId) {
            Cache::forget(self::CACHE_PRODUCT_PREFIX . $productId);
        }
    }
}
