<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //Crud

    //All
    public function index(){
        $products = Product::all();
        return view('Admin.Product.index')->with('products',$products);
    }

    public function create(){
        $products = Product::all();
        return view('Admin.Product.create')->with('products',$products);
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

        return redirect()->route('admin.prodcuts.all')->with('sucess','Created Successfully');

    }

    public function editForm($id){
        $products = Product::findOrFail($id);
        return view('Admin.Product.editForm')->with('products', $products);
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

        return redirect()->route('admin.prodcuts.all')->with('success','Updated Successfully');
    }

    public function delete($id){
        $product = Product::findOrFail($id);
        Storage::delete($product->image);
        $product->delete();

        return redirect()->route('admin.prodcuts.all')->with('success', 'Deleted');
    }
}
