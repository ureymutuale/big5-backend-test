<?php


namespace Database\Seeders\Task;

use App\Events\Models\Task\TaskCreatedEvent;
use App\Models\Task;
use App\Services\Task\TaskService;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taskService = new TaskService();
        $tasks = [];
        try {
            $tasks = factory(Task::class, 10)->create();
        } catch (\Exception $exception) {

        }

        foreach ($tasks as $task) {
            event(new TaskCreatedEvent($task, null));
        }
    }
}


