<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function subdistrict(){
        return $this->hasMany(Subdistrict::class,'city_id','id');
    }
    public function school(){
        return $this->hasMany(School::class,'city_id','id');
    }
}
