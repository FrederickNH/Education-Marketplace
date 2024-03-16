<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    // public function academichistory(){
    //     return $this->hasMany(AcademicHistory::class,'certificate_id','id');
    // } for phase 2
    public function subjectteaches(){
        return $this->hasMany(SubjectTeaches::class,'certificate_id','id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id','id');
    }
    public function tutor(){
        return $this->belongsTo(Tutor::class,'tutor_id','id');
    }
}
