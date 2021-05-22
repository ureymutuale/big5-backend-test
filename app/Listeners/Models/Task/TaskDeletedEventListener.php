<?php


namespace App\Listeners\Models\Task;


use App\Events\Models\Task\TaskDeletedEvent;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;

class TaskDeletedEventListener implements ShouldQueue
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
    public function handle(TaskDeletedEvent $event)
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
     * @param TaskDeletedEvent $event
     * @return bool
     */
    public function shouldQueue(TaskDeletedEvent $event)
    {
        return true;
    }

    /**
     * Handle a job failure.
     *
     * @param TaskDeletedEvent $event
     * @param Throwable $exception
     * @return void
     */
    public function failed(TaskDeletedEvent $event, Throwable $exception)
    {
        //
    }
}
