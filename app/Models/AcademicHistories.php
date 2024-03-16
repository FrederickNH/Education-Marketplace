<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicHistories extends Model
{
    use HasFactory;
    public function tutor(){
        return $this->belongsTo(Tutor::class,'tutor_id','id');
    }
    public function school(){
        return $this->belongsTo(School::class,'school_id','id');
    }
    public function certificate(){
        return $this->belongsTo(Certificate::class,'certificate_id','id');
    }
}
