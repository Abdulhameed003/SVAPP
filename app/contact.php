<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends ConfigureDB
{
    public $table = 'contacts';
    protected $fillable = ['company_id','contact_name','contact_number','email','designation'];
    protected $connection = 'mysql2';
    public $timestamps = false;
    //Relationships

    public function company(){
        return $this->belongsTo('App\Company','company_id','id');

    }

    public static function getRecentUpdated($id){
        return static::with('company')->where('id',$id)->get();
    }
}
