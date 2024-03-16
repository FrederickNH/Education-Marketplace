<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    public function certificate(){
        return $this->hasMany(Certificate::class,'admin_id','id');
    }
    public function school(){
        return $this->hasMany(School::class,'admin_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
