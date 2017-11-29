<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use App;

class projectControllerTest extends TestCase
{ 
  
   
    public function setUp(){
        parent::setUp();
        
        $this->user = factory(\App\User::class)->create(['company_id'=>"12345"]); 
        $this->database = 'db_'.$this->user->company_id;

        $config = App::make('config'); // Dependency inversion/resolution
        $connections = $config->get('database.connections');
        $tenantConnection = $connections['mysql2'];
        $newConnection = $tenantConnection;
        $newConnection['database'] = $this->database;
     
        App::make('config')->set('database.connections.mysql2', $newConnection);
        $this->createDB($this->database);
        $this->project= factory(\App\Project::class)->make();   
        $this->company= factory(\App\Company::class)->make(['company_id'=>'22222']);
        $this->industry= factory(\App\Industry::class)->make();
        $this->sales =factory(App\Salesperson::class)->create(['name'=>'danny']);
        $this->contact = factory(App\Contact::class)->make();
        $this->product= factory(App\Product::class)->create(['product_name'=>'VPS']); 
    }
    
    public function tearDown(){
      // DB::statement('DROP DATABASE '.$this->database);
    }

    public function test_project_page_display(){

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


    public function test_project_is_stored_with_new_company_entry(){
       
        //seed the data to be stored
      
        $data= ['company_name'=>$this->company->company_name,
                'company_id'=>$this->company->company_id,
                'website'=>$this->company->website,
                'office_number'=>$this->company->office_num,
                'industry'=>$this->industry->industry,
                'contact_name'=>$this->contact->contact_name,
                'contact_number'=>$this->contact->contact_number,
                'contact_email'=>$this->contact->email,
                'contact_designation'=>$this->contact->designation,
                'salesperson_name'=>'danny',
                'project_category'=>$this->project->project_category,
                'product'=>'VPS',
                'value'=>$this->project->value,
                'project_type'=>$this->project->project_type,
                'sales_stage'=>$this->project->sales_stage,
                'status'=>$this->project->status,
                'tender'=>$this->project->tender,
                'remark'=>$this->project->remarks
        ]; 
          $response = $this->actingAs($this->user)->post('/project',$data);
          var_dump($response->getContent());
      
        $this->assertDatabaseHas('projects',['company_id'=>$this->company->company_id],'mysql2');
        // $this->assertDatabaseHas('companies',['company_id'=>$this->company->company_id],'mysql2');
        // $this->assertDatabaseHas('industries',['industry'=>$this->industry->industry],'mysql2');
        $this->assertEquals('success',$response->getContent(),'Expected to return success');
      

    }

    public function test_project_is_stored_with_existing_company(){
       
        $data= [//'company_name'=>$this->company->company_name,
        'company_id'=>$this->company->company_id,
        // 'website'=>$this->company->website,
        // 'office_number'=>$this->company->office_num,
         //'industry'=>$this->industry->industry,
        // 'contact_name'=>$this->contact->contact_name,
        // 'contact_number'=>$this->contact->contact_number,
        // 'contact_email'=>$this->contact->email,
        // 'contact_designation'=>$this->contact->designation,
        'salesperson_name'=>'danny',
        'project_category'=>$this->project->project_category,
        'product'=>'brodbrand',
        'value'=>$this->project->value,
        'project_type'=>$this->project->project_type,
        'sales_stage'=>$this->project->sales_stage,
        'status'=>$this->project->status,
        'tender'=>'Dis is a new tender',
        'remark'=>$this->project->remarks
        ];  
        $response = $this->actingAs($this->user)->post('/project',$data);
        var_dump($response->getContent());
    
      $this->assertDatabaseHas('projects',['tender'=>'Dis is a new tender'],'mysql2');
    //   $this->assertDatabaseHas('companies',['company_id'=>$this->company->company_id],'mysql2');
    //   $this->assertDatabaseHas('industries',['industry'=>$this->industry->industry],'mysql2');
      $response->assertEquals('success',$response->getContent(),'Expected to return success');
    }

    private function createDB($database){
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
        $db = DB::select($query, [$this->database]);
        if(empty($db)){
            DB::statement('CREATE DATABASE '.$this->database );
           // Artisan::call('migrate', ['--database' => 'mysql2','--path' => 'database/migrations','--force' => true]);
        }
        Artisan::call('migrate', ['--database' => 'mysql2','--path' => 'database/migrations','--force' => true]);
    }

    private function seeddata(){
        $this->project= factory(\App\Project::class)->make();   
        $this->company= factory(\App\Company::class)->make(['company_id'=>'22222']);
        $this->industry= factory(\App\Industry::class)->make();
        $this->sales =factory(App\Salesperson::class)->create(['name'=>'danny']);
        $this->contact = factory(App\Contact::class)->make();
        $this->product= factory(App\Product::class)->create(['product_name'=>'VPS']); 
    }
}
