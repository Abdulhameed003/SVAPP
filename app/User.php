<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\ConfigureDB;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password','company_id','user_role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $connection = 'mysql';

    //Relationships 
    public function tenant(){
        return $this->belongsTo('App\Tenant');
    }

    public function salesperson(){
        return $this->hasOne('App\Salesperson','email','email');
    }
}
