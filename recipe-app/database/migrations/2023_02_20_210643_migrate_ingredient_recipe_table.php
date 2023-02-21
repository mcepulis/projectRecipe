<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('INSERT INTO ingredient_recipe (`recipe_id`, `ingredient_id`) SELECT `id` as `recipe_id`, `ingredient_id` FROM recipes WHERE ingredient_id IS NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
