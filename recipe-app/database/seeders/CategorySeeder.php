<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sriuba',
                'is_active' => 1,
            ],
            [
                'name' => 'Lietuviskas',
                'is_active' => 0,
            ],
            [
                'name' => 'Uzsienietiskas',
                'is_active' => 1,
            ],
            [
                'name' => 'Gerimai',
                'is_active' => 1,
            ],
            [
                'name' => 'Saldumynai',
                'is_active' => 1,
            ],
                    
        ];
 
        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'is_active' => $category['is_active'],
            ]);
        }
    }
    
}
