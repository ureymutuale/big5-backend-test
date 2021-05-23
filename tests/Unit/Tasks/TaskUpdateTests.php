<?php


namespace Tests\Unit\Tasks;

use App\Constants\TaskStatus;
use App\Models\Task;
use App\Services\Task\TaskService;
use Tests\TestCase;

class TaskUpdateTests extends TestCase
{
    public function test_updateValidTask()
    {
        $task = factory(Task::class)->create();
        $data = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->realText(),
            'status' => TaskStatus::Active,
        ];
        $filters = [
        ];
        $taskService = new TaskService();
        $newTask = $taskService->updateTaskWithId($task->id, $data, $filters, null);
        $this->assertNotNull($newTask);
    }

    public function test_updateInvalidTask()
    {
        $task = factory(Task::class)->create();
        $data = [
            'description' => $this->faker->realText(),
            'status' => TaskStatus::Active,
        ];
        $filters = [
        ];
        $taskService = new TaskService();
        $newTask = $taskService->updateTaskWithId($task->id, $data, $filters, null);
        $this->assertNotEquals($data, $newTask);
    }
}
