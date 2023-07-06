<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    public function product_warehouses()
    {
        return $this->hasMany(ProductWarehouse::class);
    }
}
