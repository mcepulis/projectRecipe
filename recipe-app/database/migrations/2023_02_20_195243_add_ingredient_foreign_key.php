<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('recipes', function(Blueprint $table) {
            $table->unsignedBigInteger('ingredient_id')->nullable()->after('name');
            $table->foreign('ingredient_id')->on('ingredients')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
