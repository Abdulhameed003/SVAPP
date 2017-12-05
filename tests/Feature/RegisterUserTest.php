<?php
namespace Tests\Feature;

//use AspectMock\Test;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\MessageBag;
use Mockery;


class RegisterUserTest extends TestCase
{
   //use  WithoutMiddleware;

    private $register;
    private $user;
    private $company;
   
    public function setUp(){
        parent::setUp();
        $this->register = new RegisterController();
        $this->user = factory(\App\User::class)->make();
        $this->company =factory(\App\Tenant::class)->make();
    }
 
    public function tearDown(){
        Mockery::close();
    }

    public function test_registration_display(){
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    /**@test */
    public function test_Register_for_valid_registration(){
      
        $data =['first_name' =>'abduldhd',
                'last_name' =>'dxdsdssd',
                'email' => $this->user->email,
                'password' => 'qwerty',
                'password_confirmation' => 'qwerty',
                'company_id' => $this->company->company_id,
                'company_name' => 'qwderf',
                'company_phone' => '323223',
        ];  

       $response = $this->call('POST','/register',$data);
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('tenants',['company_id'=>$this->company->company_id],'mysql');
        $this->assertDatabaseHas('users',['email'=>$this->user->email],'mysql');

        return $this->company->company_id;
    }


    /* This test test checks for when an existing company_id is reegisteredr*/    
    public function test_register_for_invalid_registration(){
        $data =['first_name' =>'abduldhd',
                'last_name' =>'dxdsdssd',
                'email' => $this->user->email,
                'password' => 'qwerty',
                'password_confirmation' => 'qwerty',
                'company_id' => '61219021',
                'company_name' => 'qwderf',
                'company_phone' => '323223',
         ]; 

         $response = $this->call('POST','/register',$data);
         $errors = session('errors')->getBag('default')->getMessages();
         $response->assertSessionHasErrors();
         $this->assertEquals(array_shift($errors['company_id']),'The company id has already been taken.');

    }



}
