<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingredient extends Model
{
    public function recipe(){
        return $this->belongsTo(recipe::class);
    }
    protected $fillable = ['ingredientID', 'recipeID','unit', 'ingredient_name', 'quantity', 'created_at', 'updated_at'];
    use HasFactory;
}
