<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $withCount = ['users'];

    
    public function game() {
        return $this->belongsTo(Game::class);
    }
    
    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function platforms() {
        return $this->hasOne(Platform::class, 'id', 'platform_id');
    }

  
}
