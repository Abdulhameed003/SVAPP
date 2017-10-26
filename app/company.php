<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends ConfigureDB
{
    public $table= 'companies';
    protected $fillable = ['company_name','company_id','website','office_number','industry'];

    //relationships

    public function project(){
        return $this->hasMany('App\Project');

    }

    public function industry(){
        return $this->belongsTo('App\Industry');
    }
}
