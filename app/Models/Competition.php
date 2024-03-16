<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    public function competitionorganiser(){
        return $this->belongsTo(CompetitionOrganiser::class,'organiser_id','id');
    }
    public function varian(){
        return $this->hasMany(CompetitionVarian::class,'competition_id','id');
    }
    public function rating(){
        return $this->hasMany(Rating::class,'competition_id','id');
    }
}
