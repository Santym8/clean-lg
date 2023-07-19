<?php

namespace App\Models\customer;

use App\Models\customer\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discount extends Model
{
    use HasFactory;
    public function customer() :BelongsTo
    {
        return $this->belongsTo(Customer::class,'customer_id');

    }
}
