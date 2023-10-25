<?php

Factory::define(App\User::class, fn ($faker) => [
    'first_name' => $faker->firstName,
    'last_name' => $faker->lastName,
    'email' => $faker->unique()->email,
    'password_hash' => sha1('secret'),
]);

