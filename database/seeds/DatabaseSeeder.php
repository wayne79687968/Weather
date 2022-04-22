<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        factory(App\User::class, 10)->create()->each(function ($user) {
            $user->posts()->save(factory(App\Post::class)->make());
        });
        // factory('App\Post', 10)->create();
        // factory('App\User', 10)->create();

    }
}
