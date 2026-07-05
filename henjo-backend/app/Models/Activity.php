<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Activity extends Model
{
    use SoftDeletes, Sluggable;

    protected $table = 'activities';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon'
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
}
