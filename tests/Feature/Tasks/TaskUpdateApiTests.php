<?php


namespace Tests\Feature\Tasks;

use App\Constants\TaskStatus;
use App\Models\Task;
use Tests\TestCase;

class TaskUpdateApiTests extends TestCase
{
    public function test_updateValidTask()
    {
        $task = factory(Task::class)->create();
        $data = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->realText(),
            'status' => TaskStatus::Active,
        ];

        $this->put("api/guest/tasks/{$task->id}", $data)
            ->assertStatus(200);
    }

    public function test_updateInvalidTask()
    {
        $task = factory(Task::class)->create();
        $data = [
            'description' => $this->faker->realText(),
            'status' => TaskStatus::Active,
        ];

        $this->put("api/guest/tasks/{$task->id}", $data)
            ->assertStatus(422);
    }
}
