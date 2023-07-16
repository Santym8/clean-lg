<?php

namespace App\Models\inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\inventory\ProductWarehouse;
use App\Models\inventory\Category;


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
