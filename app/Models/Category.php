<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'order_column',
        'icon',
        'image',
        'is_menu',
        'is_active',
        'show_on_home',
        'show_on_menu',
        'show_on_footer',
        'show_on_sidebar',
        'show_on_header',
        'show_on_slider',
        'show_on_top',
        'show_on_bottom',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    // For menus linked to submenus
    public function submenus()
    {
        return $this->belongsToMany(Category::class, 'category_menus', 'menu_id', 'submenu_id');
    }

    // For submenus linked to menus
    public function menus()
    {
        return $this->belongsToMany(Category::class, 'category_menus', 'submenu_id', 'menu_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function scopeMenu($query)
    {
        return $query->where('is_menu', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeShowOnHome($query)
    {
        return $query->where('show_on_home', true);
    }

    public function scopeShowOnMenu($query)
    {
        return $query->where('show_on_menu', true);
    }

    public function scopeShowOnFooter($query)
    {
        return $query->where('show_on_footer', true);
    }

    public function scopeShowOnSidebar($query)
    {
        return $query->where('show_on_sidebar', true);
    }

    public function scopeShowOnHeader($query)
    {
        return $query->where('show_on_header', true);
    }

    public function scopeShowOnSlider($query)
    {
        return $query->where('show_on_slider', true);
    }

    public function scopeShowOnTop($query)
    {
        return $query->where('show_on_top', true);
    }

    public function scopeShowOnBottom($query)
    {
        return $query->where('show_on_bottom', true);
    }

    public function scopeCreatedBy($query, $userId)
    {
        return $query->where('created_by', $userId);
    }

    public function scopeUpdatedBy($query, $userId)
    {
        return $query->where('updated_by', $userId);
    }

    public function scopeDeletedBy($query, $userId)
    {
        return $query->where('deleted_by', $userId);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%")
            ->orWhere('slug', 'like', "%$search%");
    }

    public function scopeOrder($query, $order)
    {
        return $query->orderBy('order_column', $order);
    }

    public function scopeMenuSubmenu($query, $menuId, $submenuId)
    {
        return $query->where('menu_id', $menuId)->where('submenu_id', $submenuId);
    }
}
