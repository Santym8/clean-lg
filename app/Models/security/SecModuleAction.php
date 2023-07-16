<?php

namespace App\Models\security;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecModuleAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'route',
        'displayable_menu',
        'icon_name',
        'status',
        'module_id',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
