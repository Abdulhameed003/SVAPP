<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use collection;
class Product extends ConfigureDB
{

    public $table = 'products';
    protected $connection = 'mysql2';
}
