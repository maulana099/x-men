<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SuperHero;

class Skill extends Model
{
    // use HasFactory;
    protected $table = 'm_skill';

    public function superhero(){
        return $this->belongsTo(SuperHero::class);
    }
}
