<?php


namespace App\Listeners\Models\TaskAttachment;


use App\Events\Models\TaskAttachment\TaskAttachmentDeletedEvent;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;

class TaskAttachmentDeletedEventListener implements ShouldQueue
{

    use InteractsWithQueue;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle(TaskAttachmentDeletedEvent $event)
    {
        if ($event->taskAttachment) {
            try {
            } catch (Exception $e) {
            }
        }
    }

    /**
     * Determine whether the listener should be queued.
     *
     * @param TaskAttachmentDeletedEvent $event
     * @return bool
     */
    public function shouldQueue(TaskAttachmentDeletedEvent $event)
    {
        return true;
    }

    /**
     * Handle a job failure.
     *
     * @param TaskAttachmentDeletedEvent $event
     * @param Throwable $exception
     * @return void
     */
    public function failed(TaskAttachmentDeletedEvent $event, Throwable $exception)
    {
        //
    }
}
