<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeekingTutors extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function offer(){
        return $this->hasMany(Offers::class,'seeking_tutor_id','id');
    }
}
