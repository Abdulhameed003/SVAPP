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
        $this->setConnection(ConfigureDB::configureDBConnection('db_'.Auth::user()->company_id));
    }


    public static  function ConfigureDBConnection($database)
    {
        // Just get access to the config. 
        $config = App::make('config');

        // Will contain the array of connections that appear in our database config file.
        $connections = $config->get('database.connections');

        // This line pulls out the default connection by key (by default it's `mysql`)
        $defaultConnection = $connections[$config->get('database.default')];

        // Now we simply copy the default connection information to our new connection.
        $newConnection = $defaultConnection;

        // Override the database name.
        $newConnection['database'] = $database;

       
        // This will add our new connection to the run-time configuration for the duration of the request.
        App::make('config')->set('database.connections.'.$database, $newConnection);
        return $database;
    }


   public static function CreateSchema($schemaName)
   {
       
       return DB::statement('CREATE DATABASE '.$schemaName);
   }
   
}
