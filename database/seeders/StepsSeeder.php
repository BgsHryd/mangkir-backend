<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StepsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 
        DB::table('step_recipes')->insert([
            'stepID'=>1,
            'recipeID'=> 1,
            'urutan'=> 1,
            'deskripsi' => "Blend olive oil shallots chile pepper garlic shrimp paste lemon grass ginger root and turmeric together in the bowl of a food processor until smooth paste forms 30 seconds to 1 minute."
        ]);

        DB::table('step_recipes')->insert([
            'stepID'=>2,
            'recipeID'=> 1,
            'urutan'=> 2,
            'deskripsi' => "Heat paste in a large saucepan over medium heat until very fragrant about 3 minutes. Add coconut milk palm sugar kaffir lime leaves cinnamon cloves sea salt and white pepper. Bring mixture to a boil and cook until thickened slightly about 10 minutes. Stir in beef reduce heat to gentle simmer. Cook mixture until beef is tender and sauce is thick stirring occasionally about 20 minutes. Remove kaffir lime leaves to serve."
        ]);
    }
}
