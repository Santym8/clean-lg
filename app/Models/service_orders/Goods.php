<?php

namespace App\Models\service_orders;

use App\Models\service_orders\Services;
use App\Models\service_orders\ServiceOrders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Goods extends Model
{
    use HasFactory;

    public function services() :BelongsTo
    {
        return $this->belongsTo(Services::class,'service_id');

    }

    public function service_orders() :BelongsTo
    {
        return $this->belongsTo(ServiceOrders::class,'service_order_id');

    }
}
