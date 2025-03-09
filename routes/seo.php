<?php

use Illuminate\Support\Facades\Route;

Route::get('/robots.txt', function () {
    $lines = [];

    // Get the sitemap URL from the environment variable
    $sitemapUrl = env('SITEMAP_URL', 'https://yourdomain.com/sitemap.xml');

    // Basic settings
    if (app()->environment('production')) {
        $lines[] = "User-agent: *";
        $lines[] = "Disallow: /admin";
        $lines[] = "Disallow: /login";
        $lines[] = "Allow: /";
        $lines[] = "Sitemap: $sitemapUrl"; // Use the environment variable for the sitemap URL

        // Additional user agents
        $lines[] = "\nUser-agent: Googlebot"; // Specific settings for Googlebot
        $lines[] = "Disallow: /private";

        $lines[] = "\nUser-agent: Bingbot"; // Specific settings for Bingbot
        $lines[] = "Disallow: /sensitive-data";

        // Rules for image crawlers (optional)
        $lines[] = "\nUser-agent: Googlebot-Image";
        $lines[] = "Disallow: /images/private";
    } else {
        // For non-production environments
        $lines[] = "User-agent: *";
        $lines[] = "Disallow: /"; // Prevent indexing of the entire site
    }

    // Convert array to string and return as response
    $content = implode("\n", $lines);
    return response($content, 200, ['Content-Type' => 'text/plain']);
});

