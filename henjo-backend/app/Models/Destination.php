<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    //
    public function tours(){
    return $this->hasMany(Tour::class);
}
}
