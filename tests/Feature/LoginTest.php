<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
Use App\Tenent;
class LoginTest extends TestCase
{
    public function setUp(){
        parent::setUp();
       // $this->user = factory(\App\User::class)->make();
       $this->user = factory(\App\User::class)->make();
       $createdUser = factory(\App\User::class)->create([
        'first_name' =>  $this->user->first_name,
        'last_name' =>  $this->user->last_name,
        'email' =>  $this->user->email,
        'password' =>  bcrypt('qwerty'),
        'company_id' => $this->user->company_id,
        'user_role' =>  $this->user->user_role,
        'remember_token' => $this->user->remeber_token
    ]);
    }

    public function test_login_page_displays()
    {
        $response =  $this->get('/login');
        $response->assertViewIs('auth.login');

    }

    public function test_user_login_successfully()
    {
        
        $data = ['company_id'=> $this->user->company_id,
                'email'=> $this->user->email,
                'password'=> 'qwerty'];

        $response = $this->call('POST','/login',$data);
        $response->assertRedirect('/dashboard');
    }

    public function test_login_failed()
    {
        $data = ['company_id'=> $this->user->company_id,
        'email'=> $this->user->email,
        'password'=> 'wrongpassword'];
        
        $response = $this->call('POST','/login',$data);
        $response->assertStatus(302);
    }

}
