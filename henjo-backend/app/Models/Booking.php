<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Booking extends Model
{
    protected $fillable = [
        'booking_number',
        'customer_id',
        'package_id',
        'travel_date',
        'adults',
        'children',
        'total_people',
        'quoted_price',
        'currency',
        'special_requests',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function safariPackage()
    {
        return $this->belongsTo(SafariPackage::class, 'package_id');
    }

    public function travelers()
    {
        return $this->hasMany(Traveler::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
