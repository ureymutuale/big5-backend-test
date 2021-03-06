<?php

namespace Database\Factories;

/** @var Factory $factory */

use App\Models\Task;
use App\Models\TaskAttachment;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Task::class, function (Faker $faker) {
    $name = "{$faker->sentence(4)}";
    return [
        'title' => "{$name}",
        'description' => $faker->realText(),
        'status' => 'PENDING',
    ];
});
$factory->afterCreating(Task::class, function ($task, $faker) {
    $task->attachments()->createMany(factory(TaskAttachment::class, 3)->make()->toArray());
});
