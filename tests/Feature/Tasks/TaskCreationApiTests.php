<?php


namespace Tests\Feature\Tasks;

use App\Constants\TaskStatus;
use Tests\TestCase;

class TaskCreationApiTests extends TestCase
{

    public function test_createValidTask()
    {
        $data = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->realText(),
            'status' => TaskStatus::Pending,
        ];

        $this->post("api/guest/tasks", $data)
            ->assertStatus(200);
    }

    public function test_createInvalidTask()
    {
        $data = [
            'description' => $this->faker->realText(),
        ];

        $this->post("api/guest/tasks", $data)
            ->assertStatus(422);
    }
}
