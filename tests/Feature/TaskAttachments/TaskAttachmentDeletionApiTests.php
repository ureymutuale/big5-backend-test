<?php


namespace Tests\Feature\TaskAttachments;


use App\Models\Task;
use Tests\TestCase;

class TaskAttachmentDeletionApiTests extends TestCase
{
    public function test_softDeleteTaskAttachment()
    {
        $task = factory(Task::class)->create();
        $attachment = $task->attachments[0];
        $data = [
            'force' => 0,
        ];

        $this->delete("api/guest/tasks/{$task->id}/attachments/{$attachment->id}", $data)
            ->assertStatus(200);
    }

    public function test_hardDeleteTaskAttachment()
    {
        $task = factory(Task::class)->create();
        $attachment = $task->attachments[0];
        $data = [
            'force' => 1,
        ];

        $this->delete("api/guest/tasks/{$task->id}/attachments/{$attachment->id}", $data)
            ->assertStatus(200);
    }
}

