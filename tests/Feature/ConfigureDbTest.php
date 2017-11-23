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
        $connection = Config::get('database.connection.mysql2');
        $this->assertEquals('',$connection['database']);
        $connection['database'] = 'NewDB';
        Config::set('database.connection.mysql2',$connection);
        $this->assertEquals('NewDB',$connection['database']);

    }
}
