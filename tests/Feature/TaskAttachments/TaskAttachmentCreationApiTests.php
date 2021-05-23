<?php


namespace Tests\Feature\TaskAttachments;

use App\Models\Task;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class TaskAttachmentCreationApiTests extends TestCase
{
    public function test_createValidTaskAttachment()
    {
        $task = factory(Task::class)->create();
        $file = UploadedFile::fake()->image('test.jpg');
        $data = [
            'file' => $file,
        ];

        $this->post("api/guest/tasks/{$task->id}/attachments", $data)
            ->assertStatus(200);
    }

    public function test_createInvalidTaskAttachment()
    {
        $task = factory(Task::class)->create();
        $data = [
        ];

        $this->post("api/guest/tasks/{$task->id}/attachments", $data)
            ->assertStatus(422);
    }
}

