<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //Crud

    //All
    public function index()
    {
        $products = Product::all();
        //collection
        if ($products) {
            return  ProductResource::collection($products);
        } else {
            return response()->json([
                "success" => false,
                'message' => 'Data Not found'
            ], '404');
        }
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return new ProductResource($product);
        } else {
            return response()->json([
                "success" => false,
                'message' => 'Data Not found'
            ], '404');
        }
    }


    public function store(Request    $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|string',
            'price' => 'required|numeric',
            'desc' => 'required|min:10|string',
            'quantity' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 301);
        }

        $image = Storage::putFile('products', $request->image);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'desc' => $request->desc,
            'quantity' => $request->quantity,
            'image' => $image,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'created'
        ], 201);
    }



    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product == null) {
            return response()->json([
                'msg' => 'No data found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|string',
            'price' => 'required|numeric',
            'desc' => 'required|min:10|string',
            'quantity' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 301);
        }


        if ($request->has('image')) {
            Storage::delete("$product->image");
            $image = Storage::putFile('products', $request->image);
        } else {
            $image = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'desc' => $request->desc,
            'quantity' => $request->quantity,
            'image' => $image,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Updated',
            'product' => new ProductResource($product)
        ], 201);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        if ($product == null) {
            return response()->json([
                'msg' => 'No data found'
            ], 404);
        }

        if ($product->image != null) {
            Storage::delete($product->image);
        }
        $product->delete();

        return response()->json([
            'success' => true,
            'msg' => "deleted id $product->id"
        ], 200);
    }
}
