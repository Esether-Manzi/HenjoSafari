<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model implements HasMedia
{
    use SoftDeletes, Sluggable, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'hero_title',
        'hero_subtitle',
        'hero_cta_text',
        'hero_cta_href',
        'content',
        'sections',
        'meta_title',
        'meta_description',
        'is_active'
    ];

    protected $casts = [
        'sections' => 'array',
        'is_active' => 'boolean',
    ];

    protected $appends = ['hero_image_url', 'featured_image_url'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getHeroImageUrlAttribute(): ?string
    {
        return $this->hasMedia('hero_image') ? $this->getFirstMediaUrl('hero_image') : null;
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->hasMedia('featured_image') ? $this->getFirstMediaUrl('featured_image') : null;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->useDisk(config('filesystems.media_disk'))->singleFile();
        $this->addMediaCollection('hero_image')->useDisk(config('filesystems.media_disk'))->singleFile();
    }
}
