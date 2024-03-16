<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function subjectteaches(){
        return $this->hasMany(Subjecteaches::class,'subject_id','id');
    }
    public function subjectseeking(){
        return $this->hasMany(SubjectSeeking::class,'subject_id','id');
    }
}
