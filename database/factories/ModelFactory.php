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
    static $user_role;
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'company_id' => $faker->ean8, 
        'user_role' => $user_role ?: $user_role = $faker->jobTitle,
        'remember_token' => str_random(10)
    ];
});


$factory->define(App\Tenant::class, function (Faker\Generator $faker) {
    static $company_id;
    return [ 
        'company_id' =>$faker->ean8,
        'company_name' => $faker->company,
        'company_phone' => $faker->e164PhoneNumber  
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {
    static $close_at;
    return [
        'project_category'=>$faker->word,
        'product'=>$faker->randomDigit,
        'value'=>$faker->randomDigit,
        'project_type'=>$faker->word,
        'sales_stage'=>$faker->randomDigit,
        'status'=>$faker->randomDigit,
        'tender'=>$faker->word,
        'remarks'=>$faker->text($max = 50),
        'company_id'=>$faker->ean8,
        'salesperson_id'=>$faker->ean8
    ];
});

$factory->define(App\SalesPerson::class, function (Faker\Generator $faker) {
    static $password;
    return [ 
        'salesperson_id' =>$faker->ean8,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone_num'=> $faker->e164PhoneNumber ,
        'position'=> $faker->jobTitle
    ];
});

$factory->define(App\Industry::class, function (Faker\Generator $faker) {
    
    return [ 
        'industry' =>$faker->creditCardType,
    ];
});

$factory->define(App\Company::class, function (Faker\Generator $faker) {

    return [ 
        'company_id' =>$faker->ean8,
        'company_name' => $faker->company,
        'industry_id'=>$faker->randomDigit,
        'website'=>$faker->url,
        'office_num' => $faker->e164PhoneNumber  
    ];
});

$factory->define(App\Contact::class, function (Faker\Generator $faker) {
    
        return [
            'company_id'=>$faker->ean8,
            'contact_name' => $faker->name,
            'contact_number'=>$faker->e164PhoneNumber,
            'email'=>$faker->unique()->safeEmail,
            'designation' => $faker->jobTitle  
        ];
    });

$factory->define(App\Product::class, function(faker\Generator $faker){

    return [
        'product_name' => $faker->word,
    ];
});

$factory->define(App\Deal::class, function(faker\Generator $faker){
    
        return [
            'project_id'=>$faker->randomDigit,
            'po_num' => $faker->ean8,
            'po_date'=>$faker->date($format ='d-m-Y', $max ='now'),
        ];
    });