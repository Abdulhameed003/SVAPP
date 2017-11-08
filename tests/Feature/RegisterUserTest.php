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
   

    public function test_registration_display(){
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    /**@test */
    public function test_Register_With_Valid_Credentials(){
        $user = factory(\App\User::class)->make();
        $company =factory(\App\Tenant::class)->make();
      $data =['first_name' => $user->first_name,
                'last_name' =>$user->last_name,
                'email' => $user->email,
                'password' => $user->password,
                'company_id' => $company->company_id,
                'company_name' => $company->company_name,
                'company_phone' => $company->company_phone,
                'user_role' => $user->user_role,
            ];  
     // $validator = $this->app['validator']->make($data, $rules);
      //$this->assertTrue($v->passes());
      $response = $this->call('POST','/register',$data);
      $this->assertTrue(['email'=>$user->email]);

        
    }
}
