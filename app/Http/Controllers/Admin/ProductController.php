<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ProductService;
use App\Http\Requests\Admin\AdminProductRequest;
use App\Http\Requests\Admin\AdminUpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getProducts();
        return view('Admin.Product.index', compact('products'));
    }

    public function create()
    {
        // $categories = $this->productService->getCategories();
        return view('Admin.Product.create');
    }

    public function store(AdminProductRequest $request)
    {
        $this->productService->store(
            $request->validated(),
            $request->file('image')
        );

        return redirect()
            ->route('admin.products.all')
            ->with('success', 'Created Successfully');
    }

    public function editForm(Product $product)
    {
        return view('Admin.Product.editForm', compact('product'));
    }

    public function update(AdminUpdateProductRequest $request, Product $product)
    {
        $this->productService->update(
            $product,
            $request->validated(),
            $request->file('image')
        );

        return redirect()
            ->route('admin.products.all')
            ->with('success', 'Updated Successfully');
    }

    public function delete(Product $product)
    {
        $this->productService->delete($product);

        return redirect()
            ->route('admin.products.all')
            ->with('success', 'Deleted Successfully');
    }
}
