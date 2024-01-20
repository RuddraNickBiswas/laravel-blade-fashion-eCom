<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        $categories = [
            'Footwear' => ['Casual Shoes', 'Formal Shoes', 'Sports Shoes'],
            'Clothing' => ['Casual Shirt', 'T-Shirt', 'Jeans', 'Shorts', 'Formal Wear'],
            'Sportswear' => ['Running Shoes', 'Sports Apparel', 'Fitness Accessories'],
            'Innerwears' => ['Underwear', 'Socks'],
            'Bags' => ['Backpacks', 'Handbags', 'Travel Bags'],
            // Add more parent categories and their child categories as needed
        ];

        foreach ($categories as $parentName => $childNames) {
            $parentCategory = Category::create(['name' => $parentName, 'slug' => Str::slug($parentName)]);

            foreach ($childNames as $childName) {
                $parentCategory->children()->create(['name' => $childName, 'slug' => Str::slug($childName)]);
            }
        }

    }
}
