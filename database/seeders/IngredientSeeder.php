<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('ingredients')->insert([
            'ingredientID'=>0,
            'recipeID'=> 1,
            'quantity'=> 0.25,
            'ingredient_name' => "Minyak wijen",
            'unit'=> 'gelas',
        ]);

        DB::table('ingredients')->insert([
            'ingredientID'=>1,
            'recipeID'=> 1,
            'quantity'=> 4,
            'ingredient_name' => "Bawang merah",
            'unit'=> 'pieces',
        ]);

        DB::table('ingredients')->insert([
            'ingredientID'=>2,
            'recipeID'=> 1,
            'quantity'=> 3,
            'ingredient_name' => "Bawang putih",
            'unit'=> 'pieces',
        ]);
    }
}
