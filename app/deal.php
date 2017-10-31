<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends ConfigureDB
{
    public $table = 'deals';
    
    //relationships 

    public function project() {
        return $this->belongsTo('App\Project','project_id','id');
    }
}
