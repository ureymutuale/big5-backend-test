<?php


namespace Tests\Feature\TaskAttachments;

use App\Models\Task;
use Tests\TestCase;

class TaskAttachmentListingApiTests extends TestCase
{
    public function test_getTaskAttachmentListing()
    {
        $task = factory(Task::class)->create();
        $data = [
            'page' => 1,
            'per_page' => 10,
        ];

        $this->get("api/guest/tasks/{$task->id}/attachments", $data)
            ->assertStatus(200);
    }
}

