<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Inquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'package_id',
        'subject',
        'message',
        'status'
    ];


    public function safariPackage()
    {
        return $this->belongsTo(SafariPackage::class, 'package_id');
    }
}
