<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Activity extends Model implements HasMedia
{
    use SoftDeletes, Sluggable, InteractsWithMedia;

    protected $table = 'activities';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
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
            'package_activity',
            'activity_id',
            'package_id'
        );
    }
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image')
            ->useDisk(config('filesystems.media_disk'))
            ->singleFile();
    }

}
