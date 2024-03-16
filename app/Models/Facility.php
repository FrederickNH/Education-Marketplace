<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    public function school()
    {
        return $this->belongsToMany(School::class)->withPivot('facility_detail', 'picture');
    }
}
