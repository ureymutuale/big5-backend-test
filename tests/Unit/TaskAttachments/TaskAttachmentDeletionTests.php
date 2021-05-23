<?php


namespace Tests\Unit\TaskAttachments;

use App\Models\Task;
use App\Services\TaskAttachment\TaskAttachmentService;
use Tests\TestCase;

class TaskAttachmentDeletionTests extends TestCase
{
    public function test_softDeleteTaskAttachment()
    {
        $task = factory(Task::class)->create();
        $filters = [
            'task_id' => $task->id,
            'force' => 0,
        ];
        $attachment = $task->attachments[0];
        $taskAttachmentService = new TaskAttachmentService();
        $newTaskAttachment = $taskAttachmentService->deleteTaskAttachmentWithId($attachment->id, $filters, null);
        $this->assertNotNull($newTaskAttachment);
    }

    public function test_hardDeleteTaskAttachment()
    {
        $task = factory(Task::class)->create();
        $filters = [
            'task_id' => $task->id,
            'force' => 1,
        ];
        $attachment = $task->attachments[0];
        $taskAttachmentService = new TaskAttachmentService();
        $newTaskAttachment = $taskAttachmentService->deleteTaskAttachmentWithId($attachment->id, $filters, null);
        $this->assertNotNull($newTaskAttachment);
    }
}

