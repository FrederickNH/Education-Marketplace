<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function parent(){
        return $this->belongsTo(User::class,'parent_id','id');
    }
    public function child(){
        return $this->hasOne(User::class,'parent_id','id');
    }
    public function shuttle(){
        return $this->hasMany(SchoolShuttle::class,'user_id','id');
    }
    public function tutor(){
        return $this->hasMany(Tutor::class,'user_id','id');
    }
    public function school(){
        return $this->hasMany(school::class,'user_id','id');
    }
    public function organiser(){
        return $this->hasMany(CompetitionOrganiser::class,'user_id','id');
    }
    public function admin(){
        return $this->hasMany(Admin::class,'user_id','id');
    }
    public function tutoringrequest(){
        return $this->hasMany(TutoringRequest::class,'user_id','id');
    }
    public function booking(){
        return $this->hasMany(Booking::class,'user_id','id');
    }
    public function seekingtutor(){
        return $this->hasMany(SeekingTutors::class,'user_id','id');
    }
    public function msgsender(){
        return $this->hasMany(User::class,'sender_id','id');
    }
    public function msgreceive(){
        return $this->hasMany(User::class,'receiver_id','id');
    }
    public function varian()
    {
        return $this->belongsToMany(CompetitionVarian::class)->withPivot('team_name', 'participant_name','participant_phone','school_origin','registration_date','payment_date');
    }
    public function hasRole($role)
    {
        
        if($role == 'tutor'){
            if($this->tutor->isNotEmpty()){
                return $this->tutor();
            }
        }
        if($role == 'school'){
            if(!$this->school->isEmpty()){
                return $this->school();
            }
        }
        if($role == 'shuttle'){
            if(!$this->shuttle->isEmpty()){
                return $this->shuttle();
            }
        }
        if($role == 'organiser'){
            if(!$this->organiser->isEmpty()){
                return $this->organiser();
            }
        }
        if($role == 'admin'){
            if(!$this->admin->isEmpty()){
                return $this->admin();
            }
        }
        if($role == 'institution'){
            if(!$this->tutor->isEmpty()){
                foreach($this->tutor as $t){
                    if($t->institution == 1){
                        return $this->tutor();
                    }
                }
            }
        }
        // return $this->roles->contains('name', $role);
    }

}
