<?php

namespace App\Models\service_orders;

use App\Models\customer\Customer;
use App\Models\security\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceOrders extends Model
{
    use HasFactory;
    public function customers() :BelongsTo
    {
        return $this->belongsTo(Customer::class,'customer_id');

    }

    public function users() :BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');

    }
}
