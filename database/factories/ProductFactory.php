<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) { 
    $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
    $title = $slug = $faker->foodName();

    return [
        'title' => $title,
        'slug' => $slug . '-' . rand(1001, 9999),
        'image_path' => $faker->imageUrl(100, 100),
        'description' => $faker->paragraph(),
        'in_stock' => rand(50, 100),
        'unit_price' => rand(20, 100),
    ];
});
