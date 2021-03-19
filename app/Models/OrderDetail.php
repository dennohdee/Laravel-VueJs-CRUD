<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    // attribute of table for mass-assignment.
    protected $fillable = [
        'order_id',//orders foreign key
        'product_id',//products foreign key
    ];

    // ***** relationship instances ********//
    // OrderDetail <> Product relationship
    public function orderDetailProduct()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }

    // OrderDetail <> Order relationship
    public function orderDetailsOrder()
    {
        return $this->belongsTo(Order::class, 'order_id','id');
    }
}
