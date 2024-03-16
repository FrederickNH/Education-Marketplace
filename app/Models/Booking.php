<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['tutoring_id', 'user_id', 'promo_id', 'final_price', 'status'];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function promo(){
        return $this->belongsTo(Promo::class,'promo_id','id');
    }
    public function tutoring(){
        return $this->belongsTo(Tutoring::class,'tutoring_id','id');
    }
    public function rating(){
        return $this->hasMany(Rating::class,'booking_id','id');
    }
}
