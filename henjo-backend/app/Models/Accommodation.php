<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Accommodation extends Model
{
    use SoftDeletes, Sluggable;

    protected $table = 'accommodations';

    protected $fillable = [
        'name',
        'slug',
        'type',
        'star_rating',
        'location',
        'description',
        'website',
        'phone'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public function packages()
    {
        return $this->belongsToMany(
            SafariPackage::class,
            'package_accommodation',
            'accommodation_id',
            'package_id'
        )->withPivot('package_level');
    }
}