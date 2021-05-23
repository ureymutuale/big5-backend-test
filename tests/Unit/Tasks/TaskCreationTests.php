<?php


namespace Tests\Unit\Tasks;

use App\Constants\TaskStatus;
use App\Services\Task\TaskService;
use Tests\TestCase;

class TaskCreationTests extends TestCase
{
    public function test_createValidTask()
    {
        $data = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->realText(),
            'status' => TaskStatus::Pending,
        ];
        $taskService = new TaskService();
        $newTask = $taskService->createTaskWith($data, null, null);
        $this->assertNotNull($newTask);
    }

    public function test_createInvalidTask()
    {
        $data = [
            'description' => $this->faker->realText(),
        ];
        $taskService = new TaskService();
        $newTask = $taskService->createTaskWith($data, null, null);
        $this->assertNull($newTask);
    }
}
