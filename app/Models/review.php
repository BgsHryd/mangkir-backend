<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{   
    public function recipe(){
        return $this->belongsTo(recipe::class);
    }

    protected $fillable = ['id', 'email', 'recipeID', 'rating', 'created_at', 'updated_at', 'deskripsi'];
    use HasFactory;
}
