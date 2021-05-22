<?php


namespace App\Listeners\Models\Task;


use App\Events\Models\Task\TaskCreatedEvent;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;

class TaskCreatedEventListener implements ShouldQueue
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
    public function handle(TaskCreatedEvent $event)
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
     * @param TaskCreatedEvent $event
     * @return bool
     */
    public function shouldQueue(TaskCreatedEvent $event)
    {
        return true;
    }

    /**
     * Handle a job failure.
     *
     * @param TaskCreatedEvent $event
     * @param Throwable $exception
     * @return void
     */
    public function failed(TaskCreatedEvent $event, Throwable $exception)
    {
        //
    }
}
