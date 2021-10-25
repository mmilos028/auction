<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {

    //$username = $faker->name;
    $username = $faker->userName;

    return [
        'name' => $username,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make($username), // password
        'origin_password' => $username,
        'remember_token' => Str::random(10),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'address' => $faker->address,
        'address_number' => $faker->numberBetween(1, 100),
        'country' => $faker->country,
        'municipality' => Str::random('20'),
        'mobile_phone' => $faker->phoneNumber,
        'terms_and_conditions_status' => $faker->numberBetween(0, 1),
        'newsletter_status' => $faker->numberBetween(0, 1),
        'account_status' => 1,
        'account_status_date_changed' => null,
        'account_status_user_id_changed' => null,
        'last_activity_at' => now(),
        'user_public_status' => $faker->words(1),
        'favourite_quote' => $faker->words(5),
        'description' => $faker->sentence(6, true)
    ];
});
