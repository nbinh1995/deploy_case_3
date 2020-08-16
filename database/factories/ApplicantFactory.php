<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Applicant;
use App\Profile;
use App\Work;
use Faker\Generator as Faker;

$factory->define(Applicant::class, function (Faker $faker) {
    return [
        'work_id' => Work::all()->random()->id,
        'profile_id' => Profile::all()->random()->id
    ];
});
