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
        'comapny' => str_random(6),
        'user_role' => $faker->word,
       // 'remember_token' => str_random(10),
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'comapny' => $company_id ?: $company_id = str_random(6),
        'user_role' => $faker->word,
    ];
});

$factory->define(App\Tenant::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'company_name' => $faker->word,
        'company_id' =>str_random(6),
        'company_phone' => $faker->phoneNumber 
    ];
});