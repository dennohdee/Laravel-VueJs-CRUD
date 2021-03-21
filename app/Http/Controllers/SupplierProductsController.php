<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\SupplierProduct;
use Log;
use Auth;

class SupplierProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //return suppliers products view
    public function index($id,$name)
    {
        return view('suppliers.products',compact('id','name'));
    }
    //get supplier products
    public function getSupplierProducts($id)
    {
        try {
            $supplier_products = SupplierProduct::where('supply_id',$id)->with('supplierproductProduct')->orderByDesc('id')->paginate(10);
            return $supplier_products;
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to load data, Try again later.',500);
        }
    }
    //add Order
    public function addSupplierProducts(Request $request)
    {
        $request->validate([
            'product' => 'required',
        ],
        [
            'product.required' => 'Please select a product',
        ]);
        try {
            foreach($request->product as $product){
                $order = new SupplierProduct();
                $order->supply_id = $request->supplier_id;
                $order->product_id = $product['id'];
                $order->save();
            }
            return 'success';
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to add product, Try again later.',400);
        }
    }
    
    //delete Order
    public function destroy($id)
    {
        try {
            $order = SupplierProduct::findOrFail($id);
            $order->delete();
            return response()->json('success',200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to delete supplier product, Try again later.',400);
        }
    }
}
