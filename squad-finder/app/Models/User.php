<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function groups() {
        return $this->belongsToMany(Group::class);
    }

    //Relacion con juego no está hecha

    public function imfriend() {
        return $this->belongsToMany(User::class, 'user_user', 'user_id', 'user_id_amigo');
    }

    public function myfriends() {
        return $this->belongsToMany(User::class, 'user_user', 'user_id_amigo', 'user_id');
    }
    

    public function platforms() {
        return $this->hasMany(Platform::class);
    }

    public function games(){
        return $this->belongsToMany(Game::class);
    }

}
