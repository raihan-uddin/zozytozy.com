<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            ['key' => 'site_name', 'value' => 'BinBox', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_email', 'value' => 'info@binbox.com.bd', 'type' => 'email', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_phone', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_address', 'value' => '234 E 47th street, Chicago iI 60653', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            // google map
            ['key' => 'latitude', 'value' => '41.8094254', 'type' => 'number', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'longitude', 'value' => '87.622386917', 'type' => 'number', 'created_at' => now(), 'updated_at' => now()],
            // google map location iframe/link
            ['key' => 'google_map',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2968.073013013073!2d-87.622386917!3d41.8094254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880e2c6f7b3f3b6d%3A0x1f3b1b1b1b1b1b1b!2s234%20E%2047th%20St%2C%20Chicago%2C%20IL%2060653%2C%20USA!5e0!3m2!1sen!2sng!4v1626826820004!5m2!1sen!2sng',
                'type' => 'textarea', 'created_at' => now(), 'updated_at' => now()],

            // ['key' => 'site_logo', 'value' => 'logo.png', 'type' => 'file', 'created_at' => now(), 'updated_at' => now()],
            // ['key' => 'site_favicon', 'value' => 'logo.png', 'type' => 'file', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'currency', 'value' => 'USD', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'currency_symbol', 'value' => '$', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'currency_position', 'value' => 'left', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'shipping_rate', 'value' => '0', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'tax_rate', 'value' => '0', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_description', 'value' => 'Health & Beauty Products', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_keywords', 'value' => 'BinBox, Health  & Beauty Products', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_author', 'value' => 'BinBox', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_google_analytics', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_facebook', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_instagram', 'value' => 'https://www.instagram.com/binbox2024', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_linkedin', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_youtube', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_whatsapp', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_telegram', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_snapchat', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_twitter', 'value' => 'https://twitter.com/BinBox', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_tiktok', 'value' => 'https://www.tiktok.com/@binbox', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            // Google ReCapcha *
            ['key' => 'capcha', 'value' => 0, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'recaptcha_site_key', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'recaptcha_secret_key', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],

            // Cookie
            ['key' => 'cookie', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'cookie_message',
                'value' => 'We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.',
                'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'cookie_button', 'value' => 'Accept', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'cookie_policy', 'value' => 'Privacy Policy', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'cookie_link', 'value' => 'privacy-policy', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'cookie_position', 'value' => 'bottom', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'cookie_expire', 'value' => 365, 'type' => 'number', 'created_at' => now(), 'updated_at' => now()],

            // Control Home Page
            // show slider
            ['key' => 'show_slider', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            // show featured products
            ['key' => 'show_featured_products', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            // show latest products
            ['key' => 'show_latest_products', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            // show popular products
            ['key' => 'show_popular_products', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            // show best selling products
            ['key' => 'show_best_selling_products', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            // show blog
            ['key' => 'show_blog', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            // show featured categories
            ['key' => 'show_featured_categories', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            // show testimonials
            ['key' => 'show_testimonials', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],

            // show newslaetter
            ['key' => 'show_newsletter', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],

            // meta tags
            ['key' => 'home_page_meta_description', 'value' => 'BinBox is your go-to source for natural and herbal beauty products. Embrace your wellness journey with our carefully curated selection.', 'type' => 'textarea', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'home_page_meta_keywords', 'value' => 'BinBox, natural beauty products, herbal beauty products, wellness products', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'home_page_meta_author', 'value' => 'BinBox', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'home_page_meta_title', 'value' => 'BinBox - Natural & Herbal Beauty Products', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'meta_twitter_handle', 'value' => '@BinBox', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],

            ['key' => 'show_tools_bar', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_search_bar', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_cart', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_wishlist', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_compare', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_currency', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_language', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_account', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_contact', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_social', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_top_bar', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_header', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_navbar', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_footer', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_footer_top', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_footer_bottom', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_footer_bottom_menu', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_footer_bottom_social', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_footer_bottom_payment', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'show_footer_bottom_copy', 'value' => 1, 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
