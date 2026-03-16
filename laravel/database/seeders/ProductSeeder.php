<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skincare    = Category::where('name', 'Skincare')->first()->id;
        $makeup      = Category::where('name', 'Makeup')->first()->id;
        $haircare    = Category::where('name', 'Haircare')->first()->id;
        $perfumes    = Category::where('name', 'Perfumes')->first()->id;
        $bodycare    = Category::where('name', 'Body Care')->first()->id;

        $products = [
            ['name' => 'Hydrating Face Cream',   'slug' => 'hydrating-face-cream',   'description' => 'Deep moisturizing cream for all skin types.',  'price' => 29.99, 'stock' => 50, 'category_id' => $skincare],
            ['name' => 'Vitamin C Serum',         'slug' => 'vitamin-c-serum',         'description' => 'Brightening serum with 20% Vitamin C.',         'price' => 45.00, 'stock' => 30, 'category_id' => $skincare],
            ['name' => 'SPF 50 Sunscreen',        'slug' => 'spf-50-sunscreen',        'description' => 'Lightweight daily sunscreen protection.',        'price' => 19.99, 'stock' => 80, 'category_id' => $skincare],

            ['name' => 'Matte Foundation',        'slug' => 'matte-foundation',        'description' => 'Full coverage matte finish foundation.',         'price' => 35.00, 'stock' => 60, 'category_id' => $makeup],
            ['name' => 'Red Lipstick',            'slug' => 'red-lipstick',            'description' => 'Long-lasting classic red lipstick.',             'price' => 15.00, 'stock' => 100,'category_id' => $makeup],
            ['name' => 'Volumizing Mascara',      'slug' => 'volumizing-mascara',      'description' => 'Builds volume and length.',                      'price' => 18.00, 'stock' => 75, 'category_id' => $makeup],

            ['name' => 'Argan Oil Shampoo',       'slug' => 'argan-oil-shampoo',       'description' => 'Nourishing shampoo with argan oil.',             'price' => 22.00, 'stock' => 40, 'category_id' => $haircare],
            ['name' => 'Deep Repair Mask',        'slug' => 'deep-repair-mask',        'description' => 'Intensive hair mask for damaged hair.',          'price' => 27.00, 'stock' => 35, 'category_id' => $haircare],

            ['name' => 'Rose Eau de Parfum',      'slug' => 'rose-eau-de-parfum',      'description' => 'Elegant floral fragrance with rose notes.',      'price' => 89.00, 'stock' => 20, 'category_id' => $perfumes],
            ['name' => 'Oud Night',               'slug' => 'oud-night',               'description' => 'Rich and woody oriental fragrance.',             'price' => 120.00,'stock' => 15, 'category_id' => $perfumes],

            ['name' => 'Shea Butter Body Lotion', 'slug' => 'shea-butter-body-lotion', 'description' => 'Ultra-rich lotion for dry skin.',                'price' => 16.00, 'stock' => 90, 'category_id' => $bodycare],
            ['name' => 'Exfoliating Body Scrub',  'slug' => 'exfoliating-body-scrub',  'description' => 'Sugar scrub to remove dead skin cells.',         'price' => 21.00, 'stock' => 55, 'category_id' => $bodycare],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
