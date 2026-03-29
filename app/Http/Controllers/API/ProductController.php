<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //Crud

    //All
    public function index(){
        $products = Product::all();
        //collection
        if ($products) {
        return new ProductResource($products);
        }else {
            return response()->json([
                "success"=>false,
                'message'=>'Data Not found'
            ],'404');
        }
    }

    public function show($id){
        $product = Product::find($id);
        if ($product) {
            return new ProductResource($product);
        }else {
            return response()->json([
                "success"=>false,
                'message'=>'Data Not found'
            ],'404');
        }
    }


    public function store(Request    $request){

        $data = $request->validate([
            'name'=> 'required|min:4|string',
            'price'=>'required|numeric',
            'desc'=> 'required|min:10|string',
            'quantity'=>'required|numeric',
            'image'=>'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $data['image']= Storage::putFile('products',$request->image);

        Product::create($data);

    }



    public function update(Request $request, $id){
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name'=> 'required|min:4|string',
            'price'=>'required|numeric',
            'desc'=> 'required|min:10|string',
            'quantity'=>'required|numeric',
            'image'=>'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->has('image')) {
            Storage::delete("$product->image");
            $data['image']= Storage::putFile('products',$request->image);
        }else {
            $data['image']= $product->image;
        }

        $product->update($data);

    }

    public function delete($id){
        $prodcut = Product::findOrFail($id);
        Storage::delete($prodcut->image);
        $prodcut->delete();

    }
}
