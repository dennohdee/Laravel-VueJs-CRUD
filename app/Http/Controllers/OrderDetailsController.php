<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Exports\OrdersExport;
use Log;
use Auth;

class OrderDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //return orders view
    public function index($id,$order)
    {
        return view('orders.details',compact('id','order'));
    }
    //get orders
    public function getOrderDetails($id)
    {
        try {
            $order_details = OrderDetail::where('order_id',$id)->with('orderDetailProduct.productSupplierProducts.supplierproductSupplier')->orderByDesc('id')->paginate(10);
            return $order_details;
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to load data, Try again later.',500);
        }
    }

    //orders export excel
    public function OrdersExport(Request $request)
    {
        return new OrdersExport();
    }
    //add Order
    public function addOrderDetails(Request $request)
    {
        $request->validate([
            'product' => 'required',
        ],
        [
            'product.required' => 'Please select a product',
        ]);
        try {
            foreach($request->product as $product){
                $order = new OrderDetail();
                $order->order_id = $request->order_id;
                $order->product_id = $product['id'];
                $order->save();
            }
            return 'success';
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to add Order product, Try again later.',400);
        }
    }
    //edit Order
    public function editOrderDetails(Request $request)
    {
        $request->validate([
            'product' => 'required',
        ],
        [
            'product.required' => 'Please select a product',
        ]);
        try {
            $order = OrderDetail::findOrFail($request->id);
            $order->product_id = $request->product['id'];
            $order->save();
            return 'success';
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to add Order product, Try again later.',400);
        }
    }
    //delete Order
    public function destroy($id)
    {
        try {
            $order = OrderDetail::findOrFail($id);
            $order->delete();
            return response()->json('success',200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to delete order product, Try again later.',400);
        }
    }
}
