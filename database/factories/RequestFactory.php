<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Finance;
use Faker\Generator as Faker;

$factory->define(Finance::class, function (Faker $faker) {
    return [
        'line_manager_id' => 1,
        'due_date' => now(),
        'request' => $faker->sentence,
        'amount' => "200000",
        'user_id' => 1,
        'priority' => "High",
        'vendor_name' => $faker->name,
        'email_addresses' => $faker->email,
        'status' => 1,
        'currency' => "₦",
        'name' => $faker->name,
    ];
});
