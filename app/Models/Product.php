<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    // attribute of table for mass-assignment.
    protected $fillable = [
        'name',
        'description',
        'quantity',
    ];

    // ***** relationship instances ********//
    // Product <> SupplierProduct relationship
    public function productSupplierProducts()
    {
        return $this->hasMany(SupplierProduct::class, 'product_id');
    }

    // Product <> OrderDetail relationship
    public function productOrderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
}
