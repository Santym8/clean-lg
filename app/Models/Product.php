<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductWarehouse;

class Product extends Model
{
    use HasFactory;

    public function product_warehouses()
    {
        return $this->hasMany(ProductWarehouse::class);
    }
}
