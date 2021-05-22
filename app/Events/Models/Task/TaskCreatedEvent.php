<?php


namespace App\Events\Models\Task;


use App\Models\Task;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskCreatedEvent
{
    use Queueable, Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var int|null
     */
    public $byUserId;
    /**
     * @var Task
     */
    public $task;

    /**
     * Create a new event instance.
     *
     * @param Task|null $task
     * @param int|null $byUserId
     */
    public function __construct(?Task $task, int $byUserId = null)
    {
        $this->byUserId = $byUserId;
        $this->task = $task;
    }
}
