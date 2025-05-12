<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = 'universities'; // Le nom exact de ta table

    protected $fillable = [
        'name',
        'description',
        'history',
        'location',
        'tuition_fee',
        'note',
        'media_url',
        'application_link',
        'pdf_url',
    ];
    public function images()
{
    return $this->hasMany(UniversityImage::class);
}

public function bannerImages()
{
    return $this->images()->where('type', 'banner');
}

public function galleryImages()
{
    return $this->images()->where('type', 'gallery');
}
public function fields()
{
    return $this->belongsToMany(Field::class, 'propose');
}
}
