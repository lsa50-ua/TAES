<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    public function users() {
        return $this->belongsToMany(User::class);
    }
    
    public function games() {
        return $this->belongsToMany(Game::class);
    }

    public function groups() {
        return $this->belongsToMany(Group::class);
    }
}
