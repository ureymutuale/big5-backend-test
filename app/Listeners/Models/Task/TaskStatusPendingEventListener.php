<?php


namespace App\Listeners\Models\Task;


use App\Events\Models\Task\TaskStatusPendingEvent;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;

class TaskStatusPendingEventListener implements ShouldQueue
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
    public function handle(TaskStatusPendingEvent $event)
    {
        if ($event->task) {
            try {
            } catch (Exception $e) {
            }
        }
    }

    /**
     * Determine whether the listener should be queued.
     *
     * @param TaskStatusPendingEvent $event
     * @return bool
     */
    public function shouldQueue(TaskStatusPendingEvent $event)
    {
        return true;
    }

    /**
     * Handle a job failure.
     *
     * @param TaskStatusPendingEvent $event
     * @param Throwable $exception
     * @return void
     */
    public function failed(TaskStatusPendingEvent $event, Throwable $exception)
    {
        //
    }
}
