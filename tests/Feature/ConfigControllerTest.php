<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestSetup;
use App;

class ConfigControllerTest extends TestCase
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

    public function test_show_returns_data_to_displayed(){
        $industry= factory(App\Industry::class)->create();
        $product = factory(App\Product::class)->create();

        $response = $this->actingAs($this->user)->get(route('settings.show'));
        $this->assertContains('industry',$response->getContent());
        $this->assertContains('product',$response->getContent());

    }

    public function test_setting_stores_industry(){
        $industry= factory(App\Industry::class)->make();
        $data=['industry'=>$industry->industry];
        $response= $this->actingAs($this->user)->post("api/settings/add",$data);

        $this->assertDatabaseHas('industries',['industry'=>$industry->industry],'mysql2');
    }

    public function test_setting_stores_product(){
        $product= factory(App\Product::class)->make();
        $data=['product'=>$product->product_name];
        $response= $this->actingAs($this->user)->post("/settings/add",$data);

        $this->assertDatabaseHas('products',['product_name'=>$product->product_name],'mysql2');
    }

    public function test_setting_deletes_industry(){
        $industry= factory(App\Industry::class)->create();
        
         $response= $this->actingAs($this->user)->delete("/settings/{$industry->id}/industry");
 
         $this->assertDatabaseMissing('industries',['industry'=>$industry->industry],'mysql2');
    }

    public function test_setting_deletes_product(){
        $product= factory(App\Product::class)->create();
       
        $response= $this->actingAs($this->user)->delete("/settings/{$product->id}/product");

        $this->assertDatabaseMissing('products',['product_name'=>$product->product_name],'mysql2');
    }
}
