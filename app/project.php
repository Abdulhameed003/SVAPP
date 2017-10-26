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
    return $this->belongsTo();
}

}
