<?php
namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class TestSetup{

    public function __construct(){
        $this->user = factory(\App\User::class)->create(['company_id'=>"12345"]);
        $this->database = 'db_'.$this->user->company_id;
    }

    public function getUser(){
        return $this->user; 
    }

    public function setUpDB(){

        $tenantDB = config('database.connections.mysql2');
        $tenantDB['database'] = $this->database;

        config(['database.connections.mysql2'=>$tenantDB]);

        $this->createDB($this->database);
    }

    private function createDB($database){
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
        $db = DB::select($query, [$database]);
        if(empty($db)){
            DB::statement('CREATE DATABASE '.$database );
        }
        Artisan::call('migrate', ['--database' => 'mysql2','--path' => 'database/migrations','--force' => true]);
    }

    public function dropDB(){
        DB::statement('DROP DATABASE '.$this->database);
    }
}

