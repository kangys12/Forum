<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        //
        'title'=>$faker->sentence(rand(4,6)),
        'content'=>$faker->paragraph(rand(10,16)),

        'created_at'=>$faker->dateTimeBetween('-10 years','-3 years'),
        'updated_at'=>$faker->dateTimeBetween('-3 years','now'),

    ];
});
