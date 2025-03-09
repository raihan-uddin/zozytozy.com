<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class CacheController extends Controller
{
    public function clearCache()
    {
        // Clear cache
        Artisan::call('optimize:clear');

        // Clear config cache
        Artisan::call('config:clear');

        // Clear route cache
        Artisan::call('route:clear');

        // Clear view cache
        Artisan::call('view:clear');

        // Create storage link
        Artisan::call('storage:link');

        try {
            symlink('/home/binboxcom/laravel/storage/app/public', '/home/binboxcom/public_html/storage');
        } catch (\Exception $e) {
            // do nothing
        }

        // Return a view with a success message
        return view('cache.clear', [
            'message' => 'Cache has been cleared successfully!',
        ]);
    }
}
