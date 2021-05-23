<?php


namespace Tests\Unit\Tasks;

use App\Models\Task;
use App\Services\Task\TaskService;
use Tests\TestCase;

class TaskListingTests extends TestCase
{
    public function test_getTaskListing()
    {
        $tasks = factory(Task::class, 10)->create();
        $filters = [
        ];
        $taskService = new TaskService();
        $newTasks = $taskService->getTasksWith(10, null, null, $filters, null);
        $this->assertTrue(count($newTasks) > 0);
    }

    public function test_getSingleTask()
    {
        $task = factory(Task::class)->create();
        $filters = [
        ];
        $taskService = new TaskService();
        $newTask = $taskService->findTaskWithId($task->id, $filters, null);
        $this->assertNotNull($newTask);
    }
}
