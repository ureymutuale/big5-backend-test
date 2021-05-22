<?php


namespace App\Listeners\Models\Task;


use App\Events\Models\Task\TaskStatusDoneEvent;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;

class TaskStatusDoneEventListener implements ShouldQueue
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
    public function handle(TaskStatusDoneEvent $event)
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
     * @param TaskStatusDoneEvent $event
     * @return bool
     */
    public function shouldQueue(TaskStatusDoneEvent $event)
    {
        return true;
    }

    /**
     * Handle a job failure.
     *
     * @param TaskStatusDoneEvent $event
     * @param Throwable $exception
     * @return void
     */
    public function failed(TaskStatusDoneEvent $event, Throwable $exception)
    {
        //
    }
}
