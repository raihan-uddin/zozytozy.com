<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Root categories (Menu)
        $menu1 = DB::table('categories')->insertGetId([
            'name' => 'Natural Products',
            'slug' => Str::slug('Natural Products'),
            'order_column' => 1,
            'is_menu' => true,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $menu2 = DB::table('categories')->insertGetId([
            'name' => 'Bath',
            'slug' => Str::slug('Bath'),
            'order_column' => 2,
            'is_menu' => true,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $menu3 = DB::table('categories')->insertGetId([
            'name' => 'Body Products',
            'slug' => Str::slug('Body Products'),
            'order_column' => 3,
            'is_menu' => true,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $menu4 = DB::table('categories')->insertGetId([
            'name' => 'Hair Products',
            'slug' => Str::slug('Hair Products'),
            'order_column' => 4,
            'is_menu' => true,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $menu5 = DB::table('categories')->insertGetId([
            'name' => 'Aroma',
            'slug' => Str::slug('Aroma'),
            'order_column' => 5,
            'is_menu' => true,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $menu6 = DB::table('categories')->insertGetId([
            'name' => 'Fragrance Oils',
            'slug' => Str::slug('Fragrance Oils'),
            'order_column' => 6,
            'is_menu' => true,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $menu7 = DB::table('categories')->insertGetId([
            'name' => 'Essential Oils',
            'slug' => Str::slug('Essential Oils'),
            'order_column' => 7,
            'is_menu' => true,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $menu8 = DB::table('categories')->insertGetId([
            'name' => 'Latest Products',
            'slug' => Str::slug('Latest Products'),
            'order_column' => 8,
            'is_menu' => false,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu1 = DB::table('categories')->insertGetId([
            'name' => 'African Shea Butter',
            'slug' => Str::slug('African Shea Butter'),
            'order_column' => 8,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu2 = DB::table('categories')->insertGetId([
            'name' => 'African Raw Black Soap',
            'slug' => Str::slug('African Raw Black Soap'),
            'order_column' => 9,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu3 = DB::table('categories')->insertGetId([
            'name' => 'Bath Salt',
            'slug' => Str::slug('Bath Salt'),
            'order_column' => 10,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu4 = DB::table('categories')->insertGetId([
            'name' => 'Body Wash',
            'slug' => Str::slug('Body Wash'),
            'order_column' => 11,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu5 = DB::table('categories')->insertGetId([
            'name' => 'Body Scrubs',
            'slug' => Str::slug('Body Scrubs'),
            'order_column' => 12,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu6 = DB::table('categories')->insertGetId([
            'name' => 'Liquid Black Soap',
            'slug' => Str::slug('Liquid Black Soap'),
            'order_column' => 13,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu7 = DB::table('categories')->insertGetId([
            'name' => 'Massage Oil',
            'slug' => Str::slug('Massage Oil'),
            'order_column' => 14,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu8 = DB::table('categories')->insertGetId([
            'name' => 'Shampoo',
            'slug' => Str::slug('Shampoo'),
            'order_column' => 15,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu9 = DB::table('categories')->insertGetId([
            'name' => 'Shower Gel',
            'slug' => Str::slug('Shower Gel'),
            'order_column' => 16,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu10 = DB::table('categories')->insertGetId([
            'name' => 'Handmade Soap',
            'slug' => Str::slug('Handmade Soap'),
            'order_column' => 17,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu11 = DB::table('categories')->insertGetId([
            'name' => 'Bar Soap',
            'slug' => Str::slug('Bar Soap'),
            'order_column' => 18,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu12 = DB::table('categories')->insertGetId([
            'name' => 'Whipped Shea Butter',
            'slug' => Str::slug('Whipped Shea Butter'),
            'order_column' => 19,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu13 = DB::table('categories')->insertGetId([
            'name' => 'Ultra Premium Whipped Butter',
            'slug' => Str::slug('Ultra Premium Whipped Butter'),
            'order_column' => 20,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu14 = DB::table('categories')->insertGetId([
            'name' => 'Infused Butter',
            'slug' => Str::slug('Infused Butter'),
            'order_column' => 21,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu15 = DB::table('categories')->insertGetId([
            'name' => 'Body Lotion',
            'slug' => Str::slug('Body Lotion'),
            'order_column' => 22,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu16 = DB::table('categories')->insertGetId([
            'name' => 'Liquid Shea Butter',
            'slug' => Str::slug('Liquid Shea Butter'),
            'order_column' => 23,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu17 = DB::table('categories')->insertGetId([
            'name' => 'Deodorant',
            'slug' => Str::slug('Deodorant'),
            'order_column' => 24,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu18 = DB::table('categories')->insertGetId([
            'name' => 'Lip Balm',
            'slug' => Str::slug('Lip Balm'),
            'order_column' => 25,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu19 = DB::table('categories')->insertGetId([
            'name' => 'Conditioner',
            'slug' => Str::slug('Conditioner'),
            'order_column' => 26,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu20 = DB::table('categories')->insertGetId([
            'name' => 'Hair Pomade',
            'slug' => Str::slug('Hair Pomade'),
            'order_column' => 27,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu21 = DB::table('categories')->insertGetId([
            'name' => 'Beard Products',
            'slug' => Str::slug('Beard Products'),
            'order_column' => 28,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu22 = DB::table('categories')->insertGetId([
            'name' => 'Hair & Scalp Oil',
            'slug' => Str::slug('Hair & Scalp Oil'),
            'order_column' => 29,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu23 = DB::table('categories')->insertGetId([
            'name' => 'Aroma Therapy',
            'slug' => Str::slug('Aroma Therapy'),
            'order_column' => 30,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu24 = DB::table('categories')->insertGetId([
            'name' => 'Incense',
            'slug' => Str::slug('Incense'),
            'order_column' => 31,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu25 = DB::table('categories')->insertGetId([
            'name' => 'Fragrance Candles',
            'slug' => Str::slug('Fragrance Candles'),
            'order_column' => 32,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu27 = DB::table('categories')->insertGetId([
            'name' => 'Burning Oil',
            'slug' => Str::slug('Burning Oil'),
            'order_column' => 34,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu28 = DB::table('categories')->insertGetId([
            'name' => 'Perfume Oils',
            'slug' => Str::slug('Perfume Oils'),
            'order_column' => 35,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $submenu29 = DB::table('categories')->insertGetId([
            'name' => 'Attar Oils',
            'slug' => Str::slug('Attar Oils'),
            'order_column' => 36,
            'is_active' => true,
            'is_menu' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        // Menu-Submenu relationship

        DB::table('category_menus')->insert([
            ['menu_id' => $menu1, 'submenu_id' => $submenu1],
            ['menu_id' => $menu1, 'submenu_id' => $submenu2],

            ['menu_id' => $menu2, 'sub_menu_id' => $submenu3],
            ['menu_id' => $menu2, 'sub_menu_id' => $submenu4],
            ['menu_id' => $menu2, 'sub_menu_id' => $submenu5],
            ['menu_id' => $menu2, 'sub_menu_id' => $submenu6],
            ['menu_id' => $menu2, 'sub_menu_id' => $submenu7],
            ['menu_id' => $menu2, 'sub_menu_id' => $submenu8],
            ['menu_id' => $menu2, 'sub_menu_id' => $submenu9],
            ['menu_id' => $menu2, 'sub_menu_id' => $submenu10],
            ['menu_id' => $menu2, 'sub_menu_id' => $submenu11],

            ['menu_id' => $menu3, 'sub_menu_id' => $submenu12],
            ['menu_id' => $menu3, 'sub_menu_id' => $submenu13],
            ['menu_id' => $menu3, 'sub_menu_id' => $submenu14],
            ['menu_id' => $menu3, 'sub_menu_id' => $submenu15],
            ['menu_id' => $menu3, 'sub_menu_id' => $submenu16],
            ['menu_id' => $menu3, 'sub_menu_id' => $submenu17],
            ['menu_id' => $menu3, 'sub_menu_id' => $submenu18],

            ['menu_id' => $menu4, 'sub_menu_id' => $submenu8],
            ['menu_id' => $menu4, 'sub_menu_id' => $submenu19],
            ['menu_id' => $menu4, 'sub_menu_id' => $submenu20],
            ['menu_id' => $menu4, 'sub_menu_id' => $submenu21],

            ['menu_id' => $menu5, 'sub_menu_id' => $submenu22],
            ['menu_id' => $menu5, 'sub_menu_id' => $submenu23],
            ['menu_id' => $menu5, 'sub_menu_id' => $submenu24],
            ['menu_id' => $menu5, 'sub_menu_id' => $submenu25],
            ['menu_id' => $menu5, 'sub_menu_id' => $submenu27],

            ['menu_id' => $menu6, 'sub_menu_id' => $submenu28],
            ['menu_id' => $menu6, 'sub_menu_id' => $submenu29],

        ]);
    }
}
