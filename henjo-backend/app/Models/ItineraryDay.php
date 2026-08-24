<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'dinner',
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
