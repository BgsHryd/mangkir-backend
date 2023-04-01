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
        Schema::create('step_recipes', function (Blueprint $table) {
            $table->id('stepID');
            $table->unsignedbigInteger('recipeID');
            $table->integer('urutan');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('recipeID')->references('recipeID')->on('recipes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('step_recipes');
    }
};
