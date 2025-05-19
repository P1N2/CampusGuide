<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'university_id',
        'note',
    ];
    public $timestamps = false;

    // Un avis appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un avis concerne une université
    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
