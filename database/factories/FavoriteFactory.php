<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Favorite;
use App\User;
use App\Work;
use Faker\Generator as Faker;

$factory->define(Favorite::class, function (Faker $faker) {
    return [
        'work_id' => Work::all()->random()->id,
        'user_id' => User::all()->random()->id
    ];
});
