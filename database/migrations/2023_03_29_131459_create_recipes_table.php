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
        //
        Schema::create('recipes', function (Blueprint $table) {
            $table->id('recipeID');
            $table->string('emailAuthor');
            $table->string('judul');
            $table->text('backstory');
            $table->string('asalDaerah');
            $table->integer('servings');
            $table->integer('durasi_menit');
            $table->timestamps();

            $table->foreign('emailAuthor')->references('email')->on('users');
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
