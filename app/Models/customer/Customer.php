<?php

namespace App\Models\customer;

use App\Models\customer\Job;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;
    public function job() :BelongsTo
    {
        return $this->belongsTo(Job::class,'job_id');

    }
}
