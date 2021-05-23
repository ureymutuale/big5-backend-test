<?php


namespace Tests\Unit\TaskAttachments;

use App\Models\Task;
use App\Services\TaskAttachment\TaskAttachmentService;
use Tests\TestCase;

class TaskAttachmentListingTests extends TestCase
{
    public function test_getTaskAttachmentListing()
    {
        $task = factory(Task::class)->create();
        $filters = [
            'task_id' => $task->id
        ];
        $taskAttachmentService = new TaskAttachmentService();
        $newTaskAttachments = $taskAttachmentService->getTaskAttachmentsWith(10, null, null, $filters, null);
        $this->assertTrue(count($newTaskAttachments) > 0);
    }

    public function test_getSingleTaskAttachment()
    {
        $task = factory(Task::class)->create();
        $filters = [
            'task_id' => $task->id
        ];
        $attachment = $task->attachments[0];
        $taskAttachmentService = new TaskAttachmentService();
        $newTaskAttachment = $taskAttachmentService->findTaskAttachmentWithId($attachment->id, $filters, null);
        $this->assertNotNull($newTaskAttachment);
    }
}

