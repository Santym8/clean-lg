<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductWarehouse;
use App\Models\Category;


class Product extends Model
{
    use HasFactory;

    public function product_warehouses()
    {
        return $this->hasMany(ProductWarehouse::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);

    }
}
