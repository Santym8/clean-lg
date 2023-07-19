<?php

namespace App\Models\security;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'menu_text',
        'icon_name',
        'color',
    ];

    public function moduleActions()
    {
        return $this->hasMany(ModuleAction::class);
    }

    public function firstDisplayableAction(){
        return $this->moduleActions()->where('displayable_menu', true)->first();
    }
}
