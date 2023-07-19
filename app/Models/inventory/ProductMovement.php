<?php

namespace App\Models\inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\inventory\ProductWarehouse;

class ProductMovement extends Model
{
    use HasFactory;
    public function productWarehouse()
    {
        return $this->belongsTo(ProductWarehouse::class, 'product_warehouse_id');
    }
}
