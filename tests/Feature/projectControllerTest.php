<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\ProjectController;
use RegisterUserTest;
use Config;

class projectControllerTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        
        $this->user = factory(\App\User::class)->create([
            'company_id'=>'83978555'
        ]); 
    }

    public function test_project_page_display(){
        //$response = $this->get('/project');

        $response = $this->actingAs($this->user)->withSession(['token'=>'testing12345'])->get('/project');
        $response->assertViewIs('pages.project');
       
    }

    public function test_load_variables_for_project_creation()
    {
        $response = $this->actingAs($this->user)->withSession(['token'=>'testing12345'])->get('/project/create');
        $this->assertContains('company',$response->getContent());
        $this->assertContains('industry',$response->getContent());
        $this->assertContains('product',$response->getContent());
    }

    public function test_project_created_invalid(){

    }

    public function test_project_is_stored(){

    }

    public function test_project_is_not_stored(){

    }
}
