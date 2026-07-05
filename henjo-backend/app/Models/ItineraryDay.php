<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ItineraryDay extends Model
{
    protected $table = 'itinerary_days';

    protected $fillable = [
        'package_id',
        'day_number',
        'title',
        'description',
        'breakfast',
        'lunch',
        'dinner'
    ];

    protected $casts = [
        'breakfast' => 'boolean',
        'lunch' => 'boolean',
        'dinner' => 'boolean',
    ];

    // public function safariPackage()
    // {
    //     return $this->belongsTo(SafariPackage::class, 'package_id');
    // }

    public function package()
    {
       return $this->belongsTo(SafariPackage::class, 'package_id');
     }
}
