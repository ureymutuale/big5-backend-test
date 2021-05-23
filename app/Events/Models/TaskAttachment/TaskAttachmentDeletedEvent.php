<?php


namespace App\Events\Models\TaskAttachment;


use App\Models\TaskAttachment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskAttachmentDeletedEvent
{
    use Queueable, Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var int|null
     */
    public $byUserId;
    /**
     * @var TaskAttachment
     */
    public $taskAttachment;

    /**
     * Create a new event instance.
     *
     * @param TaskAttachment|null $taskAttachment
     * @param int|null $byUserId
     */
    public function __construct(?TaskAttachment $taskAttachment, int $byUserId = null)
    {
        $this->byUserId = $byUserId;
        $this->taskAttachment = $taskAttachment;
    }
}
