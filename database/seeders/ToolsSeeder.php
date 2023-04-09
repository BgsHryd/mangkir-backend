<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tools')->insert([
            'toolID'=>1,
            'recipeID'=> 1,
            'nama_alat'=> "wajan",
        ]);

        DB::table('tools')->insert([
            'toolID'=>2,
            'recipeID'=> 1,
            'nama_alat'=> "spatula",
        ]);
    }
}
