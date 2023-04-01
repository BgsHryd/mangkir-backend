<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class step_recipe extends Model
{
    public function recipe(){
        return $this->belongsTo(recipe::class);
    }
    use HasFactory;
}
