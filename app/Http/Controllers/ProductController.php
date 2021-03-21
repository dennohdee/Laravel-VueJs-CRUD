<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Log;
use Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //return products view
    public function index()
    {
        return view('products.index');
    }
    //get products
    public function getProducts()
    {
        try {
            $products = Product::orderByDesc('id')->paginate(10);
            return $products;
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to load data, Try again later.',400);
        }
    }
    //get all unpaginated products
    public function getAllProducts()
    {
        try {
            $products = Product::orderByDesc('id')->get();
            return $products;
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to load data, Try again later.',400);
        }
    }
    //add product
    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'quantity' => 'required|string|max:45',
            'description' => 'required|string|max:45',
        ]);
        try {
            $product = new Product();
            $product->name = $request->name;
            $product->quantity = $request->quantity;
            $product->description = $request->description;
            $product->save();
            return 'success';
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to add product, Try again later.',400);
        }
    }
    //edit product
    public function editProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'quantity' => 'required|string|max:45',
            'description' => 'required|string|max:45',
        ]);
        try {
            $product = Product::findOrFail($request->id);
            $product->name = $request->name;
            $product->quantity = $request->quantity;
            $product->description = $request->description;
            $product->save();
            return 'success';
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to update product, Try again later.',400);
        }
    }
    //delete product
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json('success',200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to delete product, Try again later.',400);
        }
    }
}
