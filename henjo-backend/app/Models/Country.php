<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'name',
        'code',
        'currency',
    ];

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
}
