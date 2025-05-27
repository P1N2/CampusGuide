<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = ['name', 'description', 'image'];

    public function universities()
    {
        return $this->belongsToMany(University::class, 'propose')
            ->withPivot('tuition_fee');
    }
}
