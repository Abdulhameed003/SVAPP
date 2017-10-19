<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table ='tenants';
    protected $fillable = ['company_id','company_name','company_phone',''];
    public $timestamps = true;


    //relationships
    public function users(){
        return $this->hasMany('App\User');
    }
}

