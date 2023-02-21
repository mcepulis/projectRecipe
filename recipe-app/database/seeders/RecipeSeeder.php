<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = [
            [
                'name' => 'Saltibarsciai',
                'category_id' => 1,
                'description' => 'Lietuviska sriuba',
                'is_active' => 1,
            ],
            [
                'name' => 'Cepelinai',
                'category_id' => 2,
                'description' => 'Lietuviskas patiekalas',
                'is_active' => 1,
            ],
            [
                'name' => 'Charcho',
                'category_id' => 1,
                'description' => 'Sriuba Gruziniskai',
                'is_active' => 1,
            ],
            [
                'name' => 'Kebabas',
                'category_id' => 3,
                'description' => 'Turkiska virtuve',
                'is_active' => 1,
            ],
            [
                'name' => 'Ledai',
                'category_id' => 4,
                'description' => 'Saldumynai',
                'is_active' => 1,
            ],
            [
                'name' => 'Sangria',
                'category_id' => 5,
                'description' => 'Ispaniskas kokteilis',
                'is_active' => 1,
            ],
            [
                'name' => 'Pyragas',
                'category_id' => 4,
                'description' => 'Saldumynai',
                'is_active' => 1,
            ],
 
        ];
 
        foreach ($recipes as $recipe) {
            Recipe::create([
                'name' => $recipe['name'],
                'category_id' => $recipe['category_id'],
                'description' => $recipe['description'],
                'is_active' => $recipe['is_active'],
            ]);
        }
    }
}
