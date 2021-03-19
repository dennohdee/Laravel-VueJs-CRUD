<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    // attribute of table for mass-assignment.
    protected $fillable = [
        'supply_id',//suppliers foreign key
        'product_id',//products foreign key
    ];

    // ***** relationship instances ********//
    // SupplierProduct <> Supplier relationship
    public function supplierproductSupplier()
    {
        return $this->belongsTo(Supplier::class, 'supply_id','id');
    }

    // SupplierProduct <> Product relationship
    public function supplierproductProduct()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }
}
