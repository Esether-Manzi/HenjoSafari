<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SiteSetting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'site_name',
        'tagline',
        'email',
        'phone',
        'address',
        'working_hours_weekday',
        'working_hours_saturday',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'tiktok_url',
        'youtube_url',
        'years_experience',
        'happy_travelers_count',
        'average_rating',
        'footer_tagline',
    ];

    protected $appends = ['logo_url', 'homepage_hero_url'];

    public static function current(): self
    {
        return static::query()->firstOrCreate(['id' => 1]);
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->hasMedia('logo') ? $this->getFirstMediaUrl('logo') : null;
    }

    public function getHomepageHeroUrlAttribute(): ?string
    {
        return $this->hasMedia('homepage_hero') ? $this->getFirstMediaUrl('homepage_hero') : null;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->useDisk(config('filesystems.media_disk'))->singleFile();
        $this->addMediaCollection('homepage_hero')->useDisk(config('filesystems.media_disk'))->singleFile();
    }
}
