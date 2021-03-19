<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
            return response()->json('Failed to load data, Try again later.',500);
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
            return response()->json('Failed to add product, Try again later.',500);
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
            return response()->json('Failed to add product, Try again later.',500);
        }
    }
}
