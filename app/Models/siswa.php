<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{   
    // secara default table yang diatur adalah nama file + 's'
    protected $table = 'siswa'; // ini buat ngatur tabel siswa
    protected $fillable = ['nip', 'nama', 'alamat'];
    use HasFactory;
}
