<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    //
    public function category(){
    return $this->belongsTo(Category::class);
    }

    public function destination(){
    return $this->belongsTo(Destination::class);
    }

    public function bookings(){
    return $this->belongsTo(Booking::class);
    }

    public function reviews(){
    return $this->belongsTo(Review::class);
    }
}
