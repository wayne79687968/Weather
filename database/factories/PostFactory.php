<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $users = App\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($users),
        'title' => $faker->sentence,
        'post_image' => $faker->imageUrl('900', '300'),
        'content' =>$faker->paragraph,
    ];
});
