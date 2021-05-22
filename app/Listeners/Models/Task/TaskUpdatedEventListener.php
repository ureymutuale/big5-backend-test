<?php


namespace App\Listeners\Models\Task;


use App\Events\Models\Task\TaskUpdatedEvent;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;

class TaskUpdatedEventListener implements ShouldQueue
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
    public function handle(TaskUpdatedEvent $event)
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
     * @param TaskUpdatedEvent $event
     * @return bool
     */
    public function shouldQueue(TaskUpdatedEvent $event)
    {
        return true;
    }

    /**
     * Handle a job failure.
     *
     * @param TaskUpdatedEvent $event
     * @param Throwable $exception
     * @return void
     */
    public function failed(TaskUpdatedEvent $event, Throwable $exception)
    {
        //
    }
}
