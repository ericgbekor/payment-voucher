<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','firstname','lastname','usertype','status','permission'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function creator(){

        return $this->hasMany('App\Payment','creator');
        }

        public function approver(){

        return $this->hasMany('App\Payment','approver');
        }

        public function reviewer(){

        return $this->hasMany('App\Payment','reviewer');
        }
}
