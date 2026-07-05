<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PackageInclusion extends Model
{
    protected $table = 'package_inclusions';

    protected $fillable = [
        'package_id',
        'item',
        'display_order'
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
