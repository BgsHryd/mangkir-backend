<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id('ingredientID');
            $table->unsignedBigInteger('recipeID');
            $table->string('unit');
            $table->string('ingredient_name');
            $table->float('quantity');
            $table->timestamps();

            $table->foreign('recipeID')->references('recipeID')->on('recipes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient');
    }
};
