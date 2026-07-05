<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Destination extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Sluggable;

    protected $table = 'destinations';

    protected $fillable = [
        'country_id',
        'name',
        'slug',
        'description',
        'best_time_to_visit',
        'featured',
        'is_active'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function packages()
    {
        return $this->hasMany(SafariPackage::class);
    }

    // public function safariPackages()
    // {
    //     return $this->hasMany(SafariPackage::class);
    // }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('hero')
            ->singleFile();

        $this
            ->addMediaCollection('gallery');
    }
}