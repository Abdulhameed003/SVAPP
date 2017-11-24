<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends ConfigureDB
{
    public $table = 'industries';
    protected $fillable = ['industy'];
    protected $connection = 'mysql2';
    //relationship
    public function companies(){
        return $this->hasMany('App\Company','id','industry_id');
    }

    public function projects(){
        return $this->hasManyThrough('App\Project','App\Company','industry_id','company_id','id');
    }
}
