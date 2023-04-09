<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    public function recipe(){
        return $this->belongsTo(recipe::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
    
    protected $fillable = ['id', 'recipeID', 'email', 'created_at', 'updated_at'];

    use HasFactory;
}
