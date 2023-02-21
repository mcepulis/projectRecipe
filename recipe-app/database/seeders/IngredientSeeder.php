<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = [
            [
                'name' => 'Mesa',
                'is_active' => 1,
            ],
            [
                'name' => 'Darzoves',
                'is_active' => 0,
            ],
            [
                'name' => 'Cukrus',
                'is_active' => 1,
            ],
            [
                'name' => 'Alkoholis',
                'is_active' => 1,
            ],
            [
                'name' => 'Bulves',
                'is_active' => 1,
            ],
        ];
 
        foreach ($ingredients as $ingredient) {
            Ingredient::create([
                'name' => $ingredient['name'],
                'is_active' => $ingredient['is_active'],
            ]);
        }
    }
}
