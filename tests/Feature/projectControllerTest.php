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
        $this->project= factory(\App\Project::class)->make();   
        $this->company= factory(\App\Company::class)->make();
        $this->industry= factory(\App\Industry::class)->make();
        $this->sales =factory(App\Salesperson::class)->make();
        $this->contact = factory(App\Contact::class)->make();
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


    public function test_project_is_stored_with_new_company(){
        //seed the data to be stored
        $data= ['company_name'=>$this->company->company_name,
                //'company_id'=>$this->company->company_id,
                'industry'=>$this->industry->name,
                'website'=>$this->company->website,
                'office_number'=>$this->company->office_num,
                'contact_name'=>$this->contact->contact_name,
                'contact_number'=>$this->contact->contact_number,
                'contact_email'=>$this->contact->email,
                'contact_designation'=>$this->contact->designation,
                'salesperson_name'=>$this->sales->name,
                'project_category'=>$this->project->project_category,
                'product'=>$this->project->product,
                'value'=>$this->project->value,
                'project_type'=>$this->project->project_type,
                'sales_stage'=>$this->project->sales_stage,
                'Status'=>$this->project->status,
                'tender'=>$this->project->tender,
                'remark'=>$this->project->remark
        ]; 
        //post to url 'project/store'
        $response =$this->call('POST','/project/store',$data);
        $this->assertDatabaseHas('projects',['company_id'=>$this->company->company_id],'mysql2');
        $this->assertDatabaseHas('companies',['company_id'=>$this->company->company_id],'mysql2');
        $this->assertDatabaseHas('Industires',['name'=>$this->industry->],'mysql2');
        //assert data record exist in database

    }

    public function test_project_is_not_stored_with_existing_company(){

    }
}
