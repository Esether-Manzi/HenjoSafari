<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PackageExclusion extends Model
{
    protected $table = 'package_exclusions';

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
