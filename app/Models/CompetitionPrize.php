<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionPrize extends Model
{
    use HasFactory;
    public function varian(){
        return $this->belongsTo(CompetitionVarian::class,'varian_id','id');
    }
}
