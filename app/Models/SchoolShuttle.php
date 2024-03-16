<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolShuttle extends Model
{
    use HasFactory;


    public function shuttledest(){
        return $this->hasMany(SchoolDestination::class,'school_id','id');
    }
    public function subdistrict(){
        return $this->belongsTo(Subdistrict::class,'subdistrict_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function shuttleDestination()
    {
        return $this->belongsToMany(School::class, 'school_school_shuttle', 'shuttle_id', 'school_id');
    }
}
