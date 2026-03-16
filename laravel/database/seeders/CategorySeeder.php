<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Skincare'],
            ['name' => 'Makeup'],
            ['name' => 'Haircare'],
            ['name' => 'Perfumes'],
            ['name' => 'Body Care'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
