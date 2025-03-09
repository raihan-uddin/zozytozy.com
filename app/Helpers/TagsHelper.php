<?php

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

if (! function_exists('getAllTags')) {
    function getAllTags()
    {
        $data = Cache::rememberForever('tags', function () {
            return Tag::where('is_active', 1)->orderBy('name')->get();
        });

        return $data;
    }
}