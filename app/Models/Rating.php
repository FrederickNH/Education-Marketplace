<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    public function school(){
        return $this->belongsTo(School::class,'school_id','id');
    }
    public function tutoring(){
        return $this->belongsTo(Tutoring::class,'tutoring_id','id');
    }
    public function competition(){
        return $this->belongsTo(Competition::class,'competition_id','id');
    }
}
