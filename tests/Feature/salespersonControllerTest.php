<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestSetup;

class salespersonControllerTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        $this->configEnv = new TestSetup;
        $this->configEnv->setUpDB();
        $this->user = $this->configEnv->getUser();
    }

    public function tearDown(){
        $this->configEnv->dropDB();
    }
    
    public function test_salesperson_index_is_displayed()
    {
        $response = $this->actingAs($this->user)->get('/salesperson');
        $response->assertViewIs('pages.salesperson');

    }

    public function test_if_salesperson_is_stored(){
        
    }
}
