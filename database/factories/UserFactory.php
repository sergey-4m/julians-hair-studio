<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
	$status = $faker->randomElement(['open', 'locked']);
	$ip = $status == 'locked'?$faker->ipv4:null;
    return [
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber(),
        'mobile' => $faker->phoneNumber(),
        'status' => $status,
        'ip' => $ip,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
