<?php

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

if (! function_exists('getMenuCategories')) {
    function getMenuCategories()
    {
        // products counts
        $data = Cache::rememberForever('menu_categories', function () {
            return Category::with(['submenus' => function ($query) {
                $query->withCount('products');
            }])
                ->withCount('products')
                ->where('is_active', true)
                ->where('is_menu', true)
                ->where('show_on_nav_menu', true)
                ->orderBy('order_column', 'asc')
                ->get();
        });

        return $data;
    }
}

// get all categories with products count
if (! function_exists('getCategoriesWithProductsCount')) {
    function getCategoriesWithProductsCount()
    {
        $data = Cache::rememberForever('categories_with_products_count', function () {
            return Category::withCount('products')
                ->where('is_active', true)
                ->orderBy('order_column', 'asc')
                ->get();
        });

        return $data;
    }
}
