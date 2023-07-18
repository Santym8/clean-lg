<?php

namespace App\Models\inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\inventory\ProductMovement;
use App\Models\inventory\Product;
use App\Models\inventory\Warehouse;

class ProductWarehouse extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
    public function productMovement()
    {
        return $this->hasMany(ProductMovement::class);
    }
}
