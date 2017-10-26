<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends ConfigureDB
{
    public $table = 'industry';
    protected $fillable = ['industy'];

    //relationship
    public function companies(){
        return $this->hasMany('App\Company');
    }

    public function projects(){
        return $this->hasManyThrough('App\Project','App\Company','id','company_id','id');
    }
}
