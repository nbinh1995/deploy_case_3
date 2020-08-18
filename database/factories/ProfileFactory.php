<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    $gender = ['Nam', 'Nữ'];
    return [
        'address' => $faker->address,
        'gender' => $gender[rand(0, 1)],
        'birth' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-20years'),
        'exp' => $faker->paragraph(rand(4, 6)),
        'bio' =>  $faker->paragraph(rand(4, 6)),
        'cover_letter' => '/images/letter.pdf',
        'resume' => '/images/resume.pdf',
        'avatar' => '/images/avatar.png'
    ];
});
