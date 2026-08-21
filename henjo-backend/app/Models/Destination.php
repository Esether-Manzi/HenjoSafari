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
        'tagline',
        'description',
        'highlights',
        'starting_price',
        'best_time_to_visit',
        'featured',
        'is_active'
    ];

    protected $appends = ['hero_image_url'];

    protected $casts = [
        'featured' => 'boolean',
        'is_active' => 'boolean',
        'highlights' => 'array',
        'starting_price' => 'decimal:2',
    ];

    public function getHeroImageUrlAttribute(): ?string
    {
        if ($this->hasMedia('hero')) {
            return $this->getFirstMediaUrl('hero');
        }
        foreach (['.jpg', '.png', '.jpeg', '.webp'] as $ext) {
            $relPath = 'images/destinations/' . $this->slug . $ext;
            if (file_exists(public_path($relPath))) {
                return asset($relPath);
            }
        }
        return asset('images/placeholder.png');
    }

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
            ->useDisk('public')
            ->singleFile();

        $this
            ->addMediaCollection('gallery')
            ->useDisk('public');
    }
}