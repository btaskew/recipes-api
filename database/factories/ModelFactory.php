<?php

use App\Ingredient;
use App\Recipe;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Faker\Factory $factory */

$factory->define(Recipe::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(Ingredient::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'recipe_id' => function () {
            return factory(Recipe::class)->create()->id;
        }
    ];
});
