<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recipe extends Model
{
    public function ingredients(){
        return $this->hasMany(ingredient::class);
    }
    public function step_recipes(){
        return $this->hasMany(step_recipe::class);
    }
    public function tools(){
        return $this->hasMany(tool::class);
    }
    protected $fillable = ['recipeID', 'emailAuthor','judul', 'backstory', 'asalDaerah', 'servings', 'durasi_menit'];
    use HasFactory;
}