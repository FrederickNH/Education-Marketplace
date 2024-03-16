<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTeaches extends Model
{
    use HasFactory;
    public function certificate(){
        return $this->belongsTo(Certificate::class,'certifacte_id','id');
    }
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
    public function tutors(){
        return $this->belongsTo(Tutors::class,'tutor_id','id');
    }
    public function tutorings(){
        return $this->hasMany(Tutorings::class,'subject_id','id');
    }



}
