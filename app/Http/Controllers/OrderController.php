<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Log;
use Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //return orders view
    public function index()
    {
        return view('orders.index');
    }
    //get orders
    public function getOrders()
    {
        try {
            $orders = Order::with('ordersOrderDetail')->orderByDesc('id')->paginate(10);
            return $orders;
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to load data, Try again later.',500);
        }
    }
    //get unpaginated orders
    public function getAllOrders()
    {
        try {
            $orders = Order::with('ordersOrderDetail')->orderByDesc('id')->get();
            return $orders;
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to load data, Try again later.',500);
        }
    }
    
    //add Order
    public function addOrder(Request $request)
    {
        try {
            $order = new Order();
            $order->order_number = str_replace( array("-", ":", " "), '',now());
            $order->save();
            return 'success';
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to add Order, Try again later.',400);
        }
    }
    //delete Order
    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();
            return response()->json('success',200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to delete order, Try again later.',400);
        }
    }
}
