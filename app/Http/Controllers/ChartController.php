<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Supplier;
use Log;
use Auth;

class ChartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //get product orders
    public function getProductOrder()
    {
        try {
            $products = Product::with('productOrderDetail')->get();
            $labels = [];
            $data = [];
            foreach($products as $product)
            {
                array_push($labels, $product->name);
                array_push($data, $product->productOrderDetail->count());
            }
            $dataset =[
                'labels' => $labels,
                    'datasets' => [
                        [
                        'label'=> 'Orders Per product',
                        'backgroundColor'=> '#f87979',
                        'data'=> $data
                        ]
                    ],
                   ];
                   return $dataset;
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to load data, Try again later.',400);
        }
    }
}
