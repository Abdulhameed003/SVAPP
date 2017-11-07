<?php

namespace Tests\Feature;

use AspectMock\Test;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App;

class RegisterUserTest extends TestCase
{
    public function setUp(){
        parent::setUp();
       
    }


    public function tearDown(){
        //Test::clean();
    }

    public function test_registration_display(){
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    /**@test */
    public function test_Register_With_Valid_Credentials(){
      $user = factory(\App\User::class)->make();
        $this->post('/register/store',$user->toArray());
        
    }
}
