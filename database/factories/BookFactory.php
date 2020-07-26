<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        Book::TITLE=>$faker->sentence(5),
        Book::AUTHOR=>$faker->name,
        Book::DESCRIPTION=>$faker->text,
        Book::IMAGE=>$faker->imageUrl(),
        Book::GENRE=>$faker->name
    ];
});


