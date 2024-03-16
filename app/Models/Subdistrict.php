<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    use HasFactory;
    
    public function school(){
        return $this->hasMany(School::class,'subdistrict_id','id');
    }
    public function schoolshuttle(){
        return $this->hasMany(SchoolShuttle::class,'subdistrict_id','id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }
}
