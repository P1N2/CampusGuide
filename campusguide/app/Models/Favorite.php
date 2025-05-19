<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    // Indiquer la table associée
    protected $table = 'favorites';

    // Protéger les colonnes contre l'attribution en masse
    protected $fillable = ['user_id', 'university_id'];
    
    public $timestamps = false;
      public $incrementing = false;
    protected $primaryKey = null;
    // Définir les relations si besoin
   public function user()
{
    return $this->belongsTo(User::class);
}

public function university()
{
    return $this->belongsTo(University::class);
}

}
