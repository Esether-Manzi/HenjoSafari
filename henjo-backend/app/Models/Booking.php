<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    public function user(){
    return $this->belongsTo(User::class);
    }

    public function tour(){
    return $this->belongsTo(Tour::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }
}
