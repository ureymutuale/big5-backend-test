<?php

//namespace Database\Seeders;

use Database\Seeders\Task\TasksSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local', 'development')) {
            $this->call(TasksSeeder::class);
        }
    }
}
