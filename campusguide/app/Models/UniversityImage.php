<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityImage extends Model
{
    protected $fillable = ['university_id', 'image_path', 'type'];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
