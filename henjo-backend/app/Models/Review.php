<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    public function tours(){
    return $this->hasMany(Tour::class);
    }

    public function user(){
    return $this->hasMany(User::class);
    }
}
