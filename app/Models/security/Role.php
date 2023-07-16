<?php

namespace App\Models\security;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable=['name','status'];

    public function moduleActions()
    {
        return $this->belongsToMany(ModuleAction::class);
    }
}
