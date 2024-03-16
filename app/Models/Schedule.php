<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_time',
        'end_time',
        'start_break_time',
        'end_brerak_time'
        // Add other fields that you want to allow for mass assignment here
    ];

    public function tutor(){
        return $this->belongsTo(Tutor::class,'tutor_id','id');
    }
}
