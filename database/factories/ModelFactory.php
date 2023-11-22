<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use jeremykenedy\LaravelRoles\Models\Role;

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

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;
    $userRole = Role::whereName('User')->first();

    return [
        'uuid'                           => $faker->unique()->userName,
        'name'                           => $faker->name,
        'company'                        => $faker->company,
        'address'                        => $faker->address,
        'phone'                          => $faker->phone,
        'email'                          => $faker->unique()->safeEmail,
        'password'                       => $password ?: $password = bcrypt('secret'),
        'token'                          => str_random(32),
        'activated'                      => true,
        'remember_token'                 => Str::random(10),
        'signup_ip_address'              => $faker->ipv4,
        'signup_confirmation_ip_address' => $faker->ipv4,
    ];
});

$factory->define(App\Models\Term::class, function (Faker\Generator $faker) {
    return [
        'user_id'                        => factory(App\Models\User::class)->create()->id,
        'deadline'                       => $faker->deadline,
        'comment'                        => $faker->paragraph(2, true),
    ];
});

$factory->define(App\Models\Bank::class, function (Faker\Generator $faker) {
    return [
        'user_id'                        => factory(App\Models\User::class)->create()->id,
        'name'                           => $faker->name,
        'branch'                         => $faker->branch,
        'kind'                           => $faker->kind,
        'number'                         => $faker->number,
        'holder'                         => $faker->holder,
        'comment'                        => $faker->paragraph(2, true),
    ];
});
