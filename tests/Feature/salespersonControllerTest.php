<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestSetup;
use App;

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
        $sales=factory(App\SalesPerson::class)->create();
        $project=factory(App\Project::class)->create(['salesperson_id'=>$sales->salesperson_id]);
        $response = $this->actingAs($this->user)->get('api/salesperson');
        var_dump($response->getContent());
        $response->assertSee('salesperson_id');

    }

    public function test_if_salesperson_is_stored(){
        $sales = factory(\App\SalesPerson::class)->make(['name'=>'john doe','password'=>'qwerty']);
        
        $data = ['salesperson_name'=>$sales->name,
                'salesperson_id'=>$sales->salesperson_id,
                'salesperson_email'=>$sales->email,
                'salesperson_number'=>$sales->phone_num,
                'salesperson_position'=>$sales->position,
                'Salesperson_password'=>$sales->password
        ];

        $response = $this->actingAs($this->user)->post("api/salesperson",$data);
        $this->assertDatabaseHas('salespersons',['name'=>$sales->name],'mysql2');
        $this->assertDatabaseHas('users',['email'=>$sales->email],'mysql');
    }

    public function test_salesperson_is_editable(){
        $sales=  factory(\App\SalesPerson::class)->create(['email'=>$this->user->email]);

        $response = $this->actingAs($this->user)->get("/salesperson/{$sales->id}/edit");
        $this->assertContains('salesperson',$response->getContent());
    }

    public function test_salesperson_is_not_editable(){
        $sales=  factory(\App\SalesPerson::class)->create();
        
            $response = $this->actingAs($this->user)->get("/salesperson/{$sales->id}/edit");
            $this->assertEquals('failed',$response->getContent());
    }

    public function test_if_salesperson_is_deleted_successfully(){
        $Admin = factory(\App\User::class)->create(['user_role'=>'Admin']);
        $sales=  factory(\App\SalesPerson::class)->create(['name'=>'John Doe']);
        $user1 = factory(\App\User::class)->create([
            'email'=>$sales->email,
            'first_name'=>'John',
            'last_name'=>'Doe',
            'user_role'=>$sales->position
        ]);

        $response = $this->actingAs($Admin)->delete("/salesperson/{$sales->id}");

        $this->assertDatabaseMissing('salespersons',['email'=>$sales->email],'mysql2');
        $this->assertDatabaseMissing('users',['email'=>$user1->email],'mysql');
        $this->assertEquals('success',$response->getContent());
    }

    public function test_unauthorized_salesperson_delete(){
       
        $sales=  factory(\App\SalesPerson::class)->create(['name'=>'John Doe']);
        $user1 = factory(\App\User::class)->create([
            'email'=>$sales->email,
            'first_name'=>'John',
            'last_name'=>'Doe',
            'user_role'=>$sales->position
        ]);

        $response = $this->actingAs($this->user)->delete("/salesperson/{$sales->id}");

        $this->assertDatabaseHas('salespersons',['email'=>$sales->email],'mysql2');
        $this->assertDatabaseHas('users',['email'=>$user1->email],'mysql');
        $this->assertEquals('unauthorized',$response->getContent());
    }
}
