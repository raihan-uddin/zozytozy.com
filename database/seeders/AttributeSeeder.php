<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            ['name' => 'Size'], // ex: Small, Medium, Large
            ['name' => 'Color'], // ex: Red, Blue, Green
            ['name' => 'Weight'], // ex: 1kg, 2kg, 5kg
        ];

        Attribute::insert($attributes);
    }
}
