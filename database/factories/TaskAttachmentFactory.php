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

$factory->define(TaskAttachment::class, function (Faker $faker) {
    $file= $faker->filePath();
    $type= 'image';
    return [
        'file_type' => $type,
        'name' => $faker->name,
        'uri' => $file,
//        'task_id',
    ];
});
