<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\xmlapi;
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
        $newConnection['username']= env('DB_USERNAME');
        $newConnection['password']= env('DB_PASSWORD');
     
        App::make('config')->set('database.connections.mysql2', $newConnection);
        
        return 'mysql2';
    }


   public static function CreateSchema($schemaName)
   {
       if (App::environmen('production','staging')){
           $cpanelUser = 'crm';
           $cpanelPass = '@aI9q-otL,2c';
           $db_host = 'crm.exitra';      
            
           $cpanelXml = new xmlapi($db_host);

            $cpanelXml->password_auth($cpanelUser,$cpanelPass);    
            $cpanelXml->set_port(2082);
            $cpanelXml->set_debug(1);  
            $cpanelXml->set_output('array');

            //create database    
            $createdb = $cpanelXml->api1_query($cpanelUser, "Mysql", "adddb", array($schemaName));   
            //create user 
            //$usr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduser", array($databaseuser, $databasepass));   
            //add user 
            $addusr = $cpanelXml->api1_query($cpanelUser, "Mysql", "adduserdb", array($schemaName, env('DB_USERNAME'), 'all'));

           
       }else if (App::isLocal()){
            return DB::statement('CREATE DATABASE '.$schemaName);
       } 
       
       
   }
   
}
