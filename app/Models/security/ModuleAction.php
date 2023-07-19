<?php

namespace App\Models\security;

use App\Models\security\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'route',
        'displayable_menu',
        'icon_name',
        'menu_text',
        'status',
        'module_id',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

}
