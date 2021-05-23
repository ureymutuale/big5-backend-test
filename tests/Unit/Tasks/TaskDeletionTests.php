<?php


namespace Tests\Unit\Tasks;

use App\Models\Task;
use App\Services\Task\TaskService;
use Tests\TestCase;

class TaskDeletionTests extends TestCase
{
    public function test_softDeleteTask()
    {
        $task = factory(Task::class)->create();
        $filters = [
            'force' => 0,
        ];
        $taskService = new TaskService();
        $newTask = $taskService->deleteTaskWithId($task->id, $filters, null);
        $this->assertNotNull($newTask);
    }

    public function test_hardDeleteTask()
    {
        $task = factory(Task::class)->create();
        $filters = [
            'force' => 1,
        ];
        $taskService = new TaskService();
        $newTask = $taskService->deleteTaskWithId($task->id, $filters, null);
        $this->assertNotNull($newTask);
    }
}

