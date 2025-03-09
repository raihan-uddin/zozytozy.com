<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vendors')->insert([
            'name' => 'Mine Botanicals',
            'slug' => Str::slug('Mine Botanicals'),
            'description' => 'Premium natural skincare products by Mine Botanicals.',
            'email' => 'info@minebotanicals.com',
            'phone' => '123-456-7890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
