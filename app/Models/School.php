<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;


    
    public function rating(){
        return $this->hasMany(Rating::class,'school_id','id');
    }
    public function promo(){
        return $this->hasMany(Promo::class,'school_id','id');
    }
    // public function academichistory(){
    //     return $this->hasMany(AcademicHistory::class,'school_id','id');
    // }
    public function facility()
    {
        return $this->belongsToMany(Facility::class)->withPivot('facility_detail', 'picture');
    }
    public function shuttleDestination()
    {
        return $this->belongsToMany(SchoolShuttle::class, 'school_school_shuttle', 'school_id', 'shuttle_id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function subdistrict(){
        return $this->belongsTo(Subdistrict::class,'subdistrict_id','id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }


}
