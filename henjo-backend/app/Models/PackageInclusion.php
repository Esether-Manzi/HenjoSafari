<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageInclusion extends Model
{
    protected $table = 'package_inclusions';

    protected $fillable = [
        'package_id',
        'item',
        'display_order',
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
