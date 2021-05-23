<?php


namespace Tests\Feature\Tasks;

use App\Models\Task;
use Tests\TestCase;

class TaskDeletionApiTests extends TestCase
{
    public function test_softDeleteTask()
    {
        $task = factory(Task::class)->create();
        $data = [
            'force' => 0,
        ];

        $this->delete("api/guest/tasks/{$task->id}", $data)
            ->assertStatus(200);
    }

    public function test_hardDeleteTask()
    {
        $task = factory(Task::class)->create();
        $data = [
            'force' => 1,
        ];

        $this->delete("api/guest/tasks/{$task->id}", $data)
            ->assertStatus(200);
    }
}

