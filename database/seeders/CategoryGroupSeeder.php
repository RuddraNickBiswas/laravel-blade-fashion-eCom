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
         
         $manGroup = CategoryGroup::create(['name' => 'Man', 'slug' => 'man']);
         $womenGroup = CategoryGroup::create(['name' => 'Women', 'slug' => 'women']);
 
         
         $categoriesMan = Category::inRandomOrder()->limit(10)->get(); // Adjust the limit as needed
         $categoriesWomen = Category::inRandomOrder()->limit(10)->get(); // Adjust the limit as needed
 
        
         $this->attachRandomCategories($manGroup, $categoriesMan);
 
         
         $this->attachRandomCategories($womenGroup, $categoriesWomen);
     }
 
     private function attachRandomCategories(CategoryGroup $group, $categories)
     {
         $randomSubset = $categories->random(5); 
 
         $group->categories()->attach(
             $randomSubset->pluck('id')->merge($randomSubset->flatMap(function ($category) {
                 return $category->children->pluck('id');
             }))
         );
    }
}
