<?php

use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name('male'),
        'email' => $faker->email,
        'phone_number' => $faker->phoneNumber,
        'password'  => bcrypt('secret'),
        'email_varified_at' =>Carbon::now(),
    ];
});
