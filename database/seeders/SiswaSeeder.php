<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('siswa')->insert([
            'nama'=>"Ani",
            'nip'=> '1000',
            'alamat'=> 'Malang',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('siswa')->insert([
            'nama'=>"Ina",
            'nip'=> '1001',
            'alamat'=> 'Bantul',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('siswa')->insert([
            'nama'=>"Budi",
            'nip'=> '1002',
            'alamat'=> 'Jember',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
