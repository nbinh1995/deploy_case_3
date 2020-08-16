<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Company::class, function (Faker $faker) {
    $active = ['ACTIVE', 'NO_ACTIVE'];
    return [
        'c_name' => $title = $faker->company,
        'slug' => Str::slug($title),
        'address' => $faker->address,
        'phone' => $faker->tollFreePhoneNumber,
        'website' => $faker->domainName,
        'logo' => '/images/noimage.png',
        'cover_photo' => '/images/default-banner.jpg',
        'slogan' => 'No Pain, No Gain',
        'description' => $faker->paragraph(rand(4, 8)),
        'active' =>  $active[rand(0, 1)],
        'hot' => rand(0, 1)
    ];
});
