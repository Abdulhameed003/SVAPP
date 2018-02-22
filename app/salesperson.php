<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesperson extends ConfigureDB
{
    public $table = 'salespersons';
    protected $fillable = ['salesperson_id','name','email','phone_num','position'];
    protected $connection = 'mysql2';
    public $timestamps = false;
   
    //relationships

    public function projects(){
        return $this->hasMany('App\Project','salesperson_id','salesperson_id');
    }

    public function user(){
        
        return $this->belongsTo('App\User','email','email');
    }

    public static function getRecentUpdated($id) {
        return static::withCount('projects')->where('id',$id)->get();
    }
}
