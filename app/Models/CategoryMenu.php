<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMenu extends Model
{
    use HasFactory;

    public function menu()
    {
        return $this->belongsTo(Category::class, 'menu_id');
    }

    public function submenu()
    {
        return $this->belongsTo(Category::class, 'submenu_id');
    }

    public function scopeMenu($query, $menuId)
    {
        return $query->where('menu_id', $menuId);
    }

    public function scopeSubmenu($query, $submenuId)
    {
        return $query->where('submenu_id', $submenuId);
    }

    public function scopeMenuSubmenu($query, $menuId, $submenuId)
    {
        return $query->where('menu_id', $menuId)->where('submenu_id', $submenuId);
    }
}
