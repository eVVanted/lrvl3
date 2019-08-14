<?php

namespace Corp;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function articles(){
        return $this->hasMany('Corp\Article');
    }

    public function comments(){
        return $this->hasMany('Corp\Comment');
    }

    public function roles(){
        return $this->belongsToMany('Corp\Role', 'role_user');
    }

    public function canDo($permission, $required = false){
        if(is_array($permission)){

        } else{
//            $this->roles()->get();
            foreach($this->roles as $role){
                foreach($role->permissions as $perm){
                    if(str_is($permission,$perm->name)){
                        return 
                    }
                }

            }
        }
    }
}
