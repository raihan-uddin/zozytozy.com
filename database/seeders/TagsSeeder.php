<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Organic',
            'Herbal',
            'Natural',
            'Skincare',
            'Haircare',
            'Wellness',
            'Essential Oils',
            'Aromatherapy',
            'Vegan',
            'Cruelty-Free',
            'Sustainable',
            'Handmade',
            'Beauty',
            'Health Supplements',
            'Eco-Friendly',
            'Zero Waste',
            'Plastic-Free',
            'Recyclable',
            'Reusable',
            'Biodegradable',
            'Fair Trade',
            'Ethical',
            'Non-Toxic',
            'Paraben-Free',
            'Sulfate-Free',
            'Gluten-Free',
            'Dairy-Free',
            'Nut-Free',
            'Soy-Free',
            'GMO-Free',
            'Alcohol-Free',
            'Fragrance-Free',
            'Hypoallergenic',
            'Dermatologist-Tested',
            'Cleansing',
            'Moisturizing',
            'Exfoliating',
            'Toning',
            'Brightening',
            'Anti-Aging',
            'Anti-Wrinkle',
            'Anti-Acne',
            'Anti-Dandruff',
            'Anti-Cellulite',
            'Anti-Stretch Marks',
            'Anti-Scars',
            'Anti-Spots',
            'Anti-Puffiness',
            'Anti-Dark Circles',
            'Anti-Redness',
            'Anti-Inflammation',
            'Anti-Irritation',
            'Anti-Itch',
            'Anti-Blemish',
            'Anti-Blackhead',
            'Anti-Whitehead',
            'Natural Products',
            'Organic Products',
            'Bath',
            'Body Products',
            'Hair Products',
            'Face Products',
            'Aroma',
            'Fragrance Oils',
            'African Shea Butter',
            'African Raw Black Soap',
            'Bath Salt',
            'Body Wash',
            'Body Scrubs',
            'Liquid Black Soap',
            'Massage Oil',
            'Shampoo',
            'Shower Gel',
            'Handmade Soap',
            'Bar Soap',
            'Whipped Shea Butter',
            'Ultra Premium Whipped Butter',
            'Infused Butter',
            'Body Lotion',
            'Liquid Shea Butter',
            'Deodorant',
            'Lip Balm',
            'Conditioner',
            'Hair Pomade',
            'Beard Products',
            'Hair & Scalp Oil',
            'Aroma Therapy',
            'Incense',
            'Fragrance Candles',
            'Burning Oil',
            'Perfume Oils',
            'Attar Oils',
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag),
            ]);
        }
    }
}
