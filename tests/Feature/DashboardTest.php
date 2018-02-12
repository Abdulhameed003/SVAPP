<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestSetup;
use App;

class DashboardTest extends TestCase
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

    public function test_dashboard_return_data(){
        $project = factory(App\Project::class,30)->create(['project_type'=>'New Sales','project_category'=>'Deal']);
        $project = factory(App\Project::class,20)->create(['project_type'=>'Renewals','project_category'=>'Lost Case']);
        $product2 = factory(App\Product::class,10)->create();

        $response = $this->actingAs($this->user)->get('api/dashboard');
        var_dump($response->getContent());
        $response->assertJsonStructure(['totalWonCase'=>["New Sales"=>[],"Renewals"=>[]],
        'totalRenewals'=>['category'=>[],'data'=>[]],
        'totalNewsales'=>['category'=>[],'data'=>[]],
        'wonOpp'=>['category'=>[],'data'=>['totalOpp'=>[],'wonOpp'=>[]]],
        'quarterWonLost'=>['category'=>[],'data'=>['won'=>[],'lost'=>[]]],
        'salesByProduct'=>['category'=>[],'data'=>[]],
        'salesByIndustry'=>['category'=>[],'data'=>[]],
        'totalCloseOpp'=>['category'=>[],'data'=>['deal'=>[],'lead'=>[]]]]);

    }

}
