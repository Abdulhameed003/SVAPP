<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestSetup;

class CompanyControllerTest extends TestCase
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

    public function test_if_company_returns_comapnylists()
    {   $industry = factory(App\Industry::class)->create(['industry'=>'IT']);
        $company = factory(App\Company::class)->create(['industry_id'=>$industry->id]);
        $response= $this->actingAs($this->user)->get('api/company');
        $response->assertSee("industry_id:{$industry->id}");
    }

    public function test_if_company_is_returned_for_edit(){
        $company = factory(\App\Company::class)->create();
        $response= $this->actingAs($this->user)->get("api/company/{$company->id}/edit");
        $this->assertContains('company',$response->getContent());
    }

    public function test_if_edited_company_is_updated(){
        $company = factory(\App\Company::class)->create();
        $data =['company_name'=>$company->company_name,
                'company_id'=>$company->company_id,
                'industry_id'=>$company->industry_id,
                'website'=>'https://something.com',
                'office_number'=>'234567890'];

        $response= $this->actingAs($this->user)->put("api/company/{$company->id}",$data);
        $this->assertDatabaseHas('companies',['website'=>'https://something.com'],'mysql2');
        $this->assertDatabaseHas('companies',['office_num'=>'234567890'],'mysql2');
    }

    public function test_if_company_is_deleted(){
        $company = factory(\App\Company::class)->create();
        $project = factory(\App\Project::class)->create(['company_id'=>$company->id]);
        $contact = factory(\App\Contact::class)->create(['company_id'=>$company->id]);

        $response = $this->actingAs($this->user)->delete("api/company/{$company->id}");
        $this->assertDatabaseMissing('companies',['id'=>$company->id],'mysql2');
        $this->assertDatabaseMissing('contacts',['company_id'=>$company->id],'mysql2');
        $this->assertDatabaseMissing('projects',['company_id'=>$company->id],'mysql2');
    }
}
