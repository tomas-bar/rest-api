<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->name;
    $sku = strtoupper(substr($name, 0, 2)) . '-' . $faker->randomNumber($nbDigits = 3);

    return [
        'sku' => $sku,
        'slug' => Str::slug($name),
        'name' => $name,
        'price' => $faker->numerify("##.##"),
    ];
});
