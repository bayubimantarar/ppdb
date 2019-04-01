<?php

use App\Models\Pengguna;
use Faker\Generator as Faker;

$factory->define(Pengguna::class, function (Faker $faker) {
    return [
        'email' => 'admin@ppdb.example.com',
        'password' => bcrypt('secret')
    ];
});
