<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;

    // attribute of table for mass-assignment.
    protected $fillable = [
        'name',
    ];
    
    // ***** relationship instances ********//
    // Supplier <> SupplierProduct relationship
    public function supplierProducts()
    {
        return $this->hasMany(SupplierProduct::class, 'supply_id');
    }
}
