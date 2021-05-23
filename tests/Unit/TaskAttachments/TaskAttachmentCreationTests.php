<?php


namespace Tests\Unit\TaskAttachments;

use App\Models\Task;
use App\Services\TaskAttachment\TaskAttachmentService;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class TaskAttachmentCreationTests extends TestCase
{
    public function test_createValidTaskAttachment()
    {
        $task = factory(Task::class)->create();
        $file = UploadedFile::fake()->image('test.jpg');
        $data = [
            'task_id' => $task->id,
            'file' => $file,
        ];
        $taskAttachmentService = new TaskAttachmentService();
        $newTaskAttachment = $taskAttachmentService->createTaskAttachmentWith($data, null, null);
        $this->assertNotNull($newTaskAttachment);
    }

    public function test_createInvalidTaskAttachment()
    {
        $task = factory(Task::class)->create();
        $data = [
            'task_id' => $task->id,
        ];
        $taskAttachmentService = new TaskAttachmentService();
        $newTaskAttachment = $taskAttachmentService->createTaskAttachmentWith($data, null, null);
        $this->assertNull($newTaskAttachment);
    }
}

