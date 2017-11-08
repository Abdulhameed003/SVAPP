<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'comapny_id' => str_random(6) ?: function(){ 
                return factory(App\Tenant::class)->make()->company_id;
            },
        'user_role' => $faker->word,
       // 'remember_token' => str_random(10),
    ];
});


$factory->define(App\Tenant::class, function (Faker\Generator $faker) {
    return [ 
        'company_id' =>$faker->ean8,
        'company_name' => $faker->company,
        'company_phone' => $faker->phoneNumber 
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'project_category'=>$faker->word,
        'product'=>$faker->randomDigit,
        'value'=>$faker->randomDigit,
        'project_type'=>$faker->word,
        'sales_stage'=>$faker->sales_stage,
        'status'=>$request->status,
        'tender'=>$request->tender,
        'remark'=>$request->remark,
        'company_id'=>$company->company_id,
        'salesperson_id'=>$salesPerson->salesperson_id
    ];
});