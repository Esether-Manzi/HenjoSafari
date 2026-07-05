<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SafariPackage extends Model implements HasMedia
{
    use SoftDeletes, Sluggable, InteractsWithMedia;

    protected $table = 'safari_packages';

    protected $fillable = [
        'destination_id',
        'title',
        'slug',
        'summary',
        'description',
        'duration_days',
        'duration_nights',
        'base_price',
        'currency',
        'min_people',
        'max_people',
        'featured',
        'popular',
        'status'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'popular' => 'boolean',
        'base_price' => 'decimal:2',
        'duration_days' => 'integer',
        'duration_nights' => 'integer',
        'min_people' => 'integer',
        'max_people' => 'integer',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function bookings()
    {
        return $this->hasMany(Booking::class, 'package_id');
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class)->where('status', 'published');
    }

    // ========================================
    // RELATIONSHIPS - FIXED COLUMN NAMES
    // ========================================

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

        // public function destination()
    // {
    //     return $this->belongsTo(Destination::class);
    // }

    public function categories()
    {
        // ✅ Use the correct pivot table and column names
        return $this->belongsToMany(
            SafariCategory::class,
            'package_category',          // pivot table
            'package_id',                // foreign key on pivot table
            'category_id'                // related key on pivot table
        );
    }


    // public function categories()
    // {
    //     return $this->belongsToMany(
    //         SafariCategory::class,
    //         'package_category',
    //         'package_id',
    //         'category_id'
    //     );
    // }


    public function activities()
    {
        // ✅ Use the correct pivot table and column names
        return $this->belongsToMany(
            Activity::class,
            'package_activity',          // pivot table
            'package_id',                // foreign key on pivot table
            'activity_id'                // related key on pivot table
        );
    }


    // public function activities()
    // {
    //     return $this->belongsToMany(
    //         Activity::class,
    //         'package_activity'
    //     );
    // }


    public function accommodations()
    {
        // ✅ Use the correct pivot table and column names
        return $this->belongsToMany(
            Accommodation::class,
            'package_accommodation',      // pivot table
            'package_id',                // foreign key on pivot table
            'accommodation_id'            // related key on pivot table
        )->withPivot('package_level')     // Include the package_level column
         ->withTimestamps();
    }


    // public function accommodations()
    // {
    //     return $this->belongsToMany(
    //         Accommodation::class,
    //         'package_accommodation'
    //     );
    // }



    public function itineraryDays()
    {
        return $this->hasMany(ItineraryDay::class, 'package_id');
    }

        // public function itineraryDays()
    // {
    //     return $this->hasMany(ItineraryDay::class)->orderBy('day');
    // }



    public function inclusions()
    {
        return $this->hasMany(PackageInclusion::class, 'package_id');
    }

        // public function inclusions()
    // {
    //     return $this->hasMany(PackageInclusion::class);
    // }



    public function exclusions()
    {
        return $this->hasMany(PackageExclusion::class, 'package_id');
    }

        // public function exclusions()
    // {
    //     return $this->hasMany(PackageExclusion::class);
    // }



    public function relatedPackages()
    {
        return $this->belongsToMany(SafariPackage::class, 'related_packages', 'package_id', 'related_package_id')
            ->where('status', 'published')
            ->limit(4);
    }


    // Register media collections
    // public function registerMediaCollections(): void
    // {
    //     // Cover image - single file
    //     $this->addMediaCollection('cover')
    //         ->singleFile()
    //         ->registerMediaConversions(function (Media $media) {
    //             $this->addMediaConversion('thumb')
    //                 ->width(400)
    //                 ->height(300)
    //                 ->sharpen(10);
                
    //             $this->addMediaConversion('large')
    //                 ->width(1200)
    //                 ->height(800)
    //                 ->sharpen(10);
    //         });

    //     // Gallery images - multiple files
    //     $this->addMediaCollection('gallery')
    //         ->registerMediaConversions(function (Media $media) {
    //             $this->addMediaConversion('thumb')
    //                 ->width(300)
    //                 ->height(300)
    //                 ->sharpen(10);
                
    //             $this->addMediaConversion('medium')
    //                 ->width(800)
    //                 ->height(600)
    //                 ->sharpen(10);
    //         });
    // }

    // Simplified media collections (no conversions for now)
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
        $this->addMediaCollection('gallery');
    }

}