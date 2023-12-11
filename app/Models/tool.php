<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tool extends Model
{
    public function recipe(){
        return $this->belongsTo(recipe::class);
    }
    protected $fillable = ['toolID', 'nama_alat','recipeID', 'urutan', 'deskripsi', 'created_at', 'updated_at'];
    use HasFactory;
}
