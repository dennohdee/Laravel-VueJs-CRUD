<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    // attribute of table for mass-assignment.
    protected $fillable = [
        'order_number',
    ];

    // ***** relationship instances ********//
    // Order <> OrderDetail relationship
    public function ordersOrderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
