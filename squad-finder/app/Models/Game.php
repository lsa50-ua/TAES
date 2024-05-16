<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function platforms()
    {
        return $this->belongsToMany(Platform::class, 'game_platform');
    }

    public function groups() {
        return $this->hasMany(Group::class);
    }

    //belongstomany con user
    public function users(){
        return $this->belongsToMany(User::class);
    }

}
