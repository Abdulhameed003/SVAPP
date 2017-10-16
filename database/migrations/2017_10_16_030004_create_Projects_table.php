<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *php
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('project_category');
            $table->string('company_id');
            $table->integer('salesperson_id');
            $table->integer('product');
            $table->integer('value');
            $table->string('project_type');
            $table->integer('sales_stage');
            $table->string('status');
            $table->string('tender');
            $table->string('remarks');
            $table->date('close_at');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
