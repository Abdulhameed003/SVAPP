<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends ConfigureDB
{
   public $table = 'projects';
   protected $primaryKey = 'id';
   protected $fillable = ['project_category','company_id','salesperson_id',
                        'product','value','project_type','sales_stage','status','tender'];


    //relationships

    public function company(){
        return $this->belongsTo('App\Company','company_id','company_id');
    }

    public function deal(){
        return $this->hasOne('App\deal','id','project_id');
    }

    public function salesperson(){
        return $this->belongsTo('App\Salesperson','salesperson_id','salesperson_id');
    }

}
