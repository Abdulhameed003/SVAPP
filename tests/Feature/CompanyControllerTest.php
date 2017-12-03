<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyControllerTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        $this->user = factory(\App\User::class)->create();
    }

    public function tearDown(){

    }

    public function test_if_company_page_display()
    {
        $response->actingAs($this->user)->get('/company');
        $this->assertContains('company',$response->getContent());
    }

    public function test_if_company_is_returned_for_edit(){
        $company = factory(\App\Company::class)->create();
        $response->actingAs($this->user)->get('/company/{$company->id}/edit');
    }
}
