<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Country extends Model
{
    protected $table = 'countries';
    
    protected $fillable = [
        'name',
        'code',
        'currency'
    ];

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
}
