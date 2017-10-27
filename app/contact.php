<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $table = 'contacts';
    protected $fillable = [''];
    protected $primaryKey = 'contact_id';
    //Relationships

    public function company(){
        return $this->belongsTo('App\Company','company_id','company_id');
    }
}
