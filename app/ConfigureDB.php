<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App;

class ConfigureDB extends Model 
{
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        // Set the database connection name.
        $dbName = !Auth::guest() ? 'db_'.Auth::user()->company_id : '' ;
        $connName = ConfigureDB::configureDBConnection($dbName);
        $this->setConnection($connName);
    }



    public static  function ConfigureDBConnection($database)
    {
      
        $config = App::make('config'); // Dependency inversion/resolution
        $connections = $config->get('database.connections');
        $tenantConnection = $connections['mysql2'];
        $newConnection = $tenantConnection;
        $newConnection['database'] = $database;
     
        App::make('config')->set('database.connections.mysql2', $newConnection);
        
        return 'mysql2';
    }


   public static function CreateSchema($schemaName)
   {
       
       return DB::statement('CREATE DATABASE '.$schemaName);
   }
   
}
