<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\University;
use App\Models\Avis;

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
        'is_admin', 
        'bac_type',
        'favorite_subject',
        'interest_area',
        'last_visited_at', 
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
        'last_visited_at' => 'datetime',
    ];
 public function favorites()
{
    return $this->hasMany(Favorite::class);
}
 public function universities()
{
    return $this->belongsToMany(University::class, 'favorites', 'user_id', 'university_id');
}
public function avis()
{
    return $this->hasMany(Avis::class);
}

}
