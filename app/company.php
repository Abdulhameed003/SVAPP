<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends ConfigureDB
{
    public $table= 'companies';
    protected $fillable = ['company_name','website','office_num','industry_id'];
    protected $connection = 'mysql2';
    //relationships

    public function projects(){
        return $this->hasMany('App\Project','company_id','id');

    }

    public function industry(){
        return $this->belongsTo('App\Industry','industry_id','id');
    }

    public function contacts(){
        return $this->hasMany('App\Contact','id','company_id');
    }

    //Static Calls
    public static function loadCompanyNames(){
        $product = static::all('id','company_name');
        return $product;
    } 
}
