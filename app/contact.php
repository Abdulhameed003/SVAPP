<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends configureDB
{
    public $table = 'contacts';
    protected $fillable = ['company_id','contact_name','contact_number','email','designation'];
    //protected $primaryKey = 'contact_id';
    protected $connection = 'mysql2';
    //Relationships

    public function company(){
        return $this->belongsTo('App\Company','company_id','company_id');
    }
}
