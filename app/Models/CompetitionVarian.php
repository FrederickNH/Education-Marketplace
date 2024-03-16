<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionVarian extends Model
{
    use HasFactory;
    public function competition(){
        return $this->belongsTo(Competition::class,'competition_id','id');
    }
    public function user()
    {
        return $this->belongsToMany(user::class)->withPivot('team_name', 'participant_name','participant_phone','school_origin','student_card','registration_date','payment_date','status');
    }
    public function prize(){
        return $this->hasMany(CompetitionPrize::class,'varian_id','id');
    }
}
