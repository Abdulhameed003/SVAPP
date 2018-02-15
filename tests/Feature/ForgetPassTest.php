<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Test\Testsetup;

class ForgetPassTest extends TestCase
{
   public function setUp(){
       parent::setUp();
   }
    
    public function test_forgot_pass()
    {
        $createdUser = factory(\App\User::class)->create([
           'email'=>'solidman003@gmail.com'
        ]);

        $data = ['email'=>$createdUser->email];

        $response =  $this->post('/password/email',$data);
        var_dump($response->getContent());
        
    }
}
