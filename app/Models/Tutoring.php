<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutoring extends Model
{
    // protected $casts = [
    //     'price' => 'int ', // Adjust the casting based on your field type and precision
    // ];
    use HasFactory;
    public function tutor(){
        return $this->belongsTo(Tutor::class,'tutor_id','id');
    }

    public function booking(){
        return $this->hasMany(Booking::class,'tutoring_id','id');
    }
    public function rating(){
        return $this->hasMany(Rating::class,'tutoring_id','id');
    }
}
