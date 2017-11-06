<?php

namespace Tests\Feature;

use AspectMock\Test;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterUserTest extends TestCase
{
    public function setUp(){
        parent::setUp();
       
    }


    public function teardown(){
        
    }

    public function test_register_with_no_credentials(){

        $response = $this->post('/register',[]);
        
    }


    public function test_Register_With_Valid_Credentials(){

    }
}
