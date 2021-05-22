<?php


namespace App\Listeners\Models\Task;


use App\Events\Models\Task\TaskStatusActiveEvent;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;

class TaskStatusActiveEventListener implements ShouldQueue
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
    public function handle(TaskStatusActiveEvent $event)
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
     * @param TaskStatusActiveEvent $event
     * @return bool
     */
    public function shouldQueue(TaskStatusActiveEvent $event)
    {
        return true;
    }

    /**
     * Handle a job failure.
     *
     * @param TaskStatusActiveEvent $event
     * @param Throwable $exception
     * @return void
     */
    public function failed(TaskStatusActiveEvent $event, Throwable $exception)
    {
        //
    }
}
