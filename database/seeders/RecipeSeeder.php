<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('recipes')->insert([
            'recipeID'=>0,
            'emailAuthor'=> 'ivy@mail.com',
            'judul'=> 'Rendang Sapi Josss',
            'backstory' => "Pada suatu hari di peternakan sapi",
            'asalDaerah'=> 'Padang',
            'servings'=> 4,
            'durasi_menit'=> 120,
            'kategori' => 'daging',
            'numReviews' => 0
        ]);
    }
}
