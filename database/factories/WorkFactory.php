<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use App\Work;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Work::class, function (Faker $faker) {
    $type = ['FullTime', 'PartTime'];
    return [
        'company_id' => Company::where('active', 'ACTIVE')->get()->random()->id,
        'category_id' => rand(1, 2),
        'title' => $name = $faker->sentence,
        'slug' => Str::slug($name),
        'description' => $faker->paragraph(rand(4, 8)),
        'require' =>  $faker->paragraph(rand(4, 8)),
        'benefit' =>  $faker->paragraph(rand(4, 8)),
        'contact_name' => $faker->name,
        'contact_phone' => $faker->tollFreePhoneNumber,
        'contact_email' => $faker->safeEmail,
        'position' => $faker->jobTitle,
        'salary_min' => $faker->numberBetween(5000000, 6000000),
        'salary_max' =>  $faker->numberBetween(7000000, 15000000),
        'type' => $type[rand(0, 1)],
        'status' => false,
        'last_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+30 days'),
        'hot' => rand(0, 1)
    ];
});
