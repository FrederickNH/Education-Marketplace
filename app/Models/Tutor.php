<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;
    
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function offer(){
        return $this->hasMany(SeekingTutors::class, 'tutor_id', 'id');
    }
    public function tutoring(){
        return $this->hasMany(Tutoring::class,'tutor_id','id');
    }
    public function tutorholiday(){
        return $this->hasMany(TutorHoliday::class,'tutor_id','id');
    }
    public function rating(){
        return $this->hasMany(Rating::class,'tutor_id','id');
    }
    public function subjectteaches(){
        return $this->hasMany(SubjectTeaches::class,'tutor_id','id');
    }
    public function experience(){
        return $this->hasMany(Experience::class,'tutor_id','id');
    }
    public function schedule(){
        return $this->hasMany(Schedule::class,'tutor_id','id');
    }
    public function academichistories(){
        return $this->hasMany(AcademicHistories::class,'tutor_id','id');
    }
}
