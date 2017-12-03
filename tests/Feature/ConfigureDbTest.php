<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use App\ConfigureDB;
use Config;

class ConfigureDbTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        $this->ConfigDB = new ConfigureDB;

    }

    public function tearDown(){
        \Mockery::close();
    }
   
    public function test_CreateSchema()
    {
        DB::shouldReceive('statement')
            ->once()                
            ->with('CREATE DATABASE NewDB')
            ->andReturn(true);
        $result = $this->ConfigDB->CreateSchema('NewDB');
        $this->assertTrue($result);
        
    }
     
    public function test_ConfigureDBConnection(){
        $tenantDB = config('database.connections.mysql2');
        $this->assertEquals('',$tenantDB['database']);
        $tenantDB['database'] = 'NewDB';
        config(['database.connections.mysql2'=>$tenantDB]);
        $this->assertEquals('NewDB',$tenantDB['database']);
    }
}
