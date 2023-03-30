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
            $table->string('takaran');
            $table->string('nama_bahan');
            $table->timestamps();

            $table->foreign('recipeID')->references('recipeID')->on('recipes');
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
