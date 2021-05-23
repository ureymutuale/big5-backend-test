<?php


namespace Tests\Feature\Tasks;

use App\Models\Task;
use Tests\TestCase;

class TaskListingApiTests extends TestCase
{
    public function test_getTaskListing()
    {
        $tasks = factory(Task::class, 10)->create();
        $data = [
            'page' => 1,
            'per_page' => 10,
        ];

        $this->get("api/guest/tasks", $data)
            ->assertStatus(200);
    }

    public function test_getSingleTask()
    {
        $task = factory(Task::class)->create();
        $this->get("api/guest/tasks/{$task->id}")
            ->assertStatus(200);
    }
}
