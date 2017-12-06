<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestSetup;
use App;

class ContactControllerTest extends TestCase
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

    public function test_contact_page_is_displayed(){
        $response = $this->actingAs($this->user)->get('/contact');
        $response->assertViewIs('pages.contact');
    }

    /*public function test_contact_create_returns_companies(){

        $response = $this->actingAs($this->user)->get('/contact/create');
        $this->assertContains('company',$response->getContent());
    }

    public function test_if_contact_is_stored()
    {
        $contact = factory(App\Contact::class)->make();    
        $data = ['company_id'=>$contact->contact_id,
                'contact_name' =>$contact->contact_name,
                'contact_number'=>$contact->contact_number,
                'contact_email' => $contact->email,
                'contact_designation'=>$contact->designation
        ];

        $response = $this->actingAs($this->user)->post('/contact',$data);
        
        $this->assertDatabaseHas('contacts',['company_id'=>$contact->company_id],'mysql2');
        $this->assertEquals('success',$response->getContent(),'Expected to return success');
    }
    */
    public function test_if_edit_contact_returns_contacts(){
        $company = factory(App\Company::class)->create();
        $contact = factory(App\Contact::class)->create(['company_id'=>$company->company_id]);

        $response=$this->actingAs($this->user)->get("/contact/{$contact->id}/edit");
        $this->assertContains('contact',$response->getContent());
    }

    public function test_if_contact_update_successfully(){
        $contact = factory(App\Contact::class)->create();
        $data= ['company_id'=>$contact->company_id,
                'contact_name' =>'John Doe',
                'contact_number'=>'1234567',
                'contact_email' => $contact->email,
                'contact_designation'=>$contact->designation
        ];

        $response=$this->actingAs($this->user)->put("/contact/{$contact->id}",$data);
        $this->assertDatabaseHas('contacts',['contact_name'=>'John Doe'],'mysql2');
        $this->assertDatabaseHas('contacts',['contact_number'=>'1234567'],'mysql2');
        $this->assertContains('success',$response->getContent());

    }

    public function test_if_contact_is_deleted(){
        $contact = factory(App\Contact::class)->create();

        $response=$this->actingAs($this->user)->delete("/contact/{$contact->id}");
        $this->assertDatabaseMissing('contacts',['company_id'=>$contact->company_id],'mysql2');
        $this->assertEquals('success',$response->getContent(),'Expected to return success');

    }
}
