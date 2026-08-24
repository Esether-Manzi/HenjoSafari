<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'package_id',
        'subject',
        'message',
        'status',
    ];

    public function safariPackage()
    {
        return $this->belongsTo(SafariPackage::class, 'package_id');
    }
}
