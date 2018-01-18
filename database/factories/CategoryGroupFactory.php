<?php

use App\CategoryGroup;
use App\Discipline;
use Faker\Generator as Faker;

$factory->define(CategoryGroup::class, function (Faker $faker) {
    return [
        'competition_id' => function () {
            return factory(\App\Competition::class)->create()->id;
        },
        'discipline_id' => function () {
            return factory(Discipline::class)->create()->id;
        },
        'discipline_short' => function ($group) {
            return Discipline::find($group['discipline_id'])->short;
        },
        'discipline_title' => function ($group) {
            return Discipline::find($group['discipline_id'])->title;
        },
        'title' => $faker->company,
        'short' => $faker->companySuffix,
    ];
});