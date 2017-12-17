<?php
namespace Tests\Feature;

//use AspectMock\Test;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use App;



class RegisterUserTest extends TestCase
{

   
    public function setUp(){
        parent::setUp();
        $this->company =factory(\App\Tenant::class)->make();
        $this->user = factory(\App\User::class)->make();
        $this->DBname = 'db_'.$this->company->company_id;
    }
 
    public function tearDown(){
       //DB::statement("DROP DATABASE {$this->DBname}");
    }

    public function test_registration_display(){
        $response = $this->get('/register');
        $response->assertStatus(200);
    }


    public function test_Register_for_valid_registration(){
      
        $data =['first_name' =>'abduldhd',
                'last_name' =>'dxdsdssd',
                'email' => $this->user->email,
                'password' =>'qwerty',
                'password_confirmation' =>'qwerty',
                'company_id' => $this->company->company_id,
                'company_name' => 'qwderf',
                'company_phone' => '323223',
        ];  

        $response = $this->post('/register',$data);
        $this->assertEquals('success',$response->getContent());
        $this->assertDatabaseHas('tenants',['company_id'=>$this->company->company_id],'mysql');
        $this->assertDatabaseHas('users',['email'=>$this->user->email],'mysql');
        
    }


    /* This test test checks for when an existing company_id is reegisteredr*/    
    public function test_register_for_invalid_registration(){
        $company = factory(\App\Tenant::class)->create(['company_id'=>$this->company->company_id]);
        $data =['first_name' =>'abduldhd',
                'last_name' =>'dxdsdssd',
                'email' => $this->user->email,
                'password' => 'qwerty',
                'password_confirmation' => 'qwerty',
                'company_id' => $company->company_id,
                'company_name' => 'qwderf',
                'company_phone' => '323223',
         ]; 

         $response = $this->call('POST','/register',$data);
         var_dump($response->getContent());
         $errors = session('errors')->getBag('default')->getMessages();
         $response->assertSessionHasErrors();
         $this->assertEquals(array_shift($errors['company_id']),'The company id has already been taken.');

    }

}
