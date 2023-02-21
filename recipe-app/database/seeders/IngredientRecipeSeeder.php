<?php

namespace Database\Seeders;

use App\Models\IngredientRecipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientRecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients_recipe = [
            [
                'recipe_id' => 1,
                'ingredient_id' => 1,
            ],
            [
                'recipe_id' => 2,
                'ingredient_id' => 5,
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 3,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 3,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 3,
            ],
            [
                'recipe_id' => 5,
                'ingredient_id' => 3,
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 4,
            ],
        ];
 
        foreach ($ingredients_recipe as $item) {
            IngredientRecipe::create([
                'recipe_id' => $item['recipe_id'],
                'ingredient_id' => $item['ingredient_id'],
            ]);
        }
    }
}
