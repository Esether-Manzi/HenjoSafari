<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SafariCategory extends Model
{
    use SoftDeletes, Sluggable;

    protected $table = 'safari_categories';

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
            'package_category',
            'category_id',
            'package_id'
        );
    }
}