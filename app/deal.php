<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends ConfigureDB
{
    public $table = 'deals';
    protected $fillable=['project_id','po_num','po_date'];
    protected $connection = 'mysql2';
    public $timestamps = false;
    //relationships 

    public function project() {
        return $this->belongsTo('App\Project');
    }
}
