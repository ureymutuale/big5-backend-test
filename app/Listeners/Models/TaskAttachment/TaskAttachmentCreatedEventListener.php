<?php


namespace App\Listeners\Models\TaskAttachment;


use App\Events\Models\TaskAttachment\TaskAttachmentCreatedEvent;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;

class TaskAttachmentCreatedEventListener implements ShouldQueue
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
    public function handle(TaskAttachmentCreatedEvent $event)
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
     * @param TaskAttachmentCreatedEvent $event
     * @return bool
     */
    public function shouldQueue(TaskAttachmentCreatedEvent $event)
    {
        return true;
    }

    /**
     * Handle a job failure.
     *
     * @param TaskAttachmentCreatedEvent $event
     * @param Throwable $exception
     * @return void
     */
    public function failed(TaskAttachmentCreatedEvent $event, Throwable $exception)
    {
        //
    }
}
