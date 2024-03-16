<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    use HasFactory;
    public function tutor(){
        return $this->belongsTo(Tutor::class,'tutor_id','id');
    }
    public function seekingtutor(){
        return $this->belongsTo(SeekingTutors::class,'seeking_tutor_id','id');
    }
}
