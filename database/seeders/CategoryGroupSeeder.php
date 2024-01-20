<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create two category groups
         $manGroup = CategoryGroup::create(['name' => 'Man', 'slug' => 'man']);
         $womenGroup = CategoryGroup::create(['name' => 'Women', 'slug' => 'women']);
 
         // Retrieve some categories (you can adjust the logic based on your needs)
         $categoriesMan = Category::inRandomOrder()->limit(10)->get(); // Adjust the limit as needed
         $categoriesWomen = Category::inRandomOrder()->limit(10)->get(); // Adjust the limit as needed
 
         // Attach random categories and their subcategories to the "Man" group
         $this->attachRandomCategories($manGroup, $categoriesMan);
 
         // Attach random categories and their subcategories to the "Women" group
         $this->attachRandomCategories($womenGroup, $categoriesWomen);
     }
 
     private function attachRandomCategories(CategoryGroup $group, $categories)
     {
         $randomSubset = $categories->random(5); // Adjust the number as needed
 
         $group->categories()->attach(
             $randomSubset->pluck('id')->merge($randomSubset->flatMap(function ($category) {
                 return $category->children->pluck('id');
             }))
         );
    }
}
