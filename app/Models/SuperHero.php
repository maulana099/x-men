<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Skill;

class SuperHero extends Model
{
    // use HasFactory;
    protected $table = 'm_superhero';

    public function skill(){
        return $this->hasMany(Skill::class, 'superhero_id', 'id');
    }
}
