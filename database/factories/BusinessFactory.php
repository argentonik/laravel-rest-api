<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Business::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'owner_id' => 1,
        'description' => $faker->text('512'),
        'category_id' => $faker->numberBetween(1, CategorySeeder::getCountOfCategories()),
        'raiting' => $faker->numberBetween(1, 100),
        'phone' => $faker->numerify("+1 (###) ###-####"),
        'email' => $faker->email,
        'website' => $faker->url
    ];
});
