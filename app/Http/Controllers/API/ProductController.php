<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use OpenApi\Attributes as OA;


//OpenApi (Swagger) Annotations (Tag)
#[OA\Tag(name: "Products", description: "Products management APIs")]

class ProductController extends Controller
{
    //OpenApi (Swagger) Annotations (index)
        #[OA\Get(
        path: "/api/products",
        summary: "Get all products",
        tags: ["Products"],
        responses: [
            new OA\Response(response: 200, description: "Products fetched successfully")
        ]
    )]

    //Crud

    //All
    public function index()
    {
        //collection
        return  ProductResource::collection(Product::all());
    }


    //OpenApi (Swagger) Annotations (show)
        #[OA\Get(
        path: "/api/products/{id}",
        summary: "Get a single product",
        tags: ["Products"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Product ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(response: 200, description: "Product fetched successfully"),
            new OA\Response(response: 404, description: "Product not found")
        ]
    )]


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

    //OpenApi (Swagger) Annotations (store)
         #[OA\Post(
        path: "/api/products",
        summary: "Create a new product",
        tags: ["Products"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["name", "price", "desc", "quantity", "image"],
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Laptop"),
                    new OA\Property(property: "description", type: "string", example: "Dell laptop"),
                    new OA\Property(property: "price", type: "number", format: "float", example: 25000),
                    new OA\Property(property: "desc", type: "string", example: "Dell laptop description"),
                    new OA\Property(property: "quantity", type: "integer", example: 5),
                    new OA\Property(property: "image", type: "string", example: "product.jpg"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Product created successfully"),
            new OA\Response(response: 422, description: "Validation error")
        ]
    )]

    public function store(Request $request)
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
            ], 422);
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

    //OpenApi (Swagger) Annotations (update)
        #[OA\Put(
        path: "/api/products/{id}",
        summary: "Update product",
        tags: ["Products"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Product ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Updated Laptop"),
                    new OA\Property(property: "description", type: "string", example: "Updated description"),
                    new OA\Property(property: "price", type: "number", format: "float", example: 30000),
                    new OA\Property(property: "desc", type: "string", example: "Updated description"),
                    new OA\Property(property: "quantity", type: "integer", example: 8),
                    new OA\Property(property: "image", type: "string", example: "updated_product.jpg"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Product updated successfully"),
            new OA\Response(response: 422, description: "Validation error"),
            new OA\Response(response: 404, description: "Product not found")
        ]
    )]



    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if (!$product) {
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
            ], 422);
        }


        if ($request->hasFile('image')) {
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
        ], 200);
    }

    //OpenApi (Swagger) Annotations (delete)
        #[OA\Delete(
        path: "/api/products/{id}",
        summary: "Delete product",
        tags: ["Products"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Product ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(response: 200, description: "Product deleted successfully"),
            new OA\Response(response: 404, description: "Product not found")
        ]
    )]


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
