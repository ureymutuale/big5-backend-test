<?php


namespace App\Services\Task;


use App\Constants\TaskStatus;
use App\Events\Models\Task\TaskCreatedEvent;
use App\Events\Models\Task\TaskDeletedEvent;
use App\Events\Models\Task\TaskStatusActiveEvent;
use App\Events\Models\Task\TaskStatusDoneEvent;
use App\Events\Models\Task\TaskStatusPendingEvent;
use App\Events\Models\Task\TaskUpdatedEvent;
use App\Models\Task;
use Exception;
use Illuminate\Support\Arr;
use Schema;

class TaskService implements ITaskService
{

    public function getTasksWith(int $perPage, $sortBy = null, string $order = null, $filters = null, int $byUserId = null)
    {
        $query = Task::query()
            ->with(['attachments']);

        //Keyword filtering
        if (Arr::get($filters, 'search') !== null) {
            $keyword = Arr::get($filters, 'search');
            $term = "%$keyword%";
            $query = $query->where(function ($q) use ($term) {
                return $q->where('title', 'like', $term);
            });
        }

        //Status
        if (Arr::get($filters, 'status') !== null) {
            $status = Arr::get($filters, 'status');
            $query = $query->where('status', $status);
        }

        //Sort
        if ($sortBy !== null) {
            $validValues = array("asc", "desc");
            $order = in_array(strtolower($order), $validValues) ? $order : 'asc';
            if (is_array($sortBy)) {
                foreach ($sortBy as $by) {
                    if (in_array(strtolower($by), Schema::getColumnListing('tasks'))) {
                        $query = $query->orderBy($by, $order);
                    }
                }
            } else {
                if (in_array(strtolower($sortBy), Schema::getColumnListing('tasks'))) {
                    $query = $query->orderBy($sortBy, $order);
                }
            }
        }

        if ($perPage > 0) {
            $query = $query->paginate($perPage);
        } else {
            $query = $query->get();
        }

        return $query;
    }

    public function findTaskWithId($id, $filters = null, int $byUserId = null)
    {
        $query = Task::query()
            ->where('id', $id)
            ->with(['attachments']);

        $query = $query->first();

        return $query;
    }

    public function createTaskWith($taskDetails, $filters = null, int $byUserId = null)
    {
        $status = TaskStatus::Pending;
        if (Arr::get($taskDetails, 'status') !== null) {
            $status = Arr::get($taskDetails, 'status');
        }
        $data = [
            'title' => Arr::get($taskDetails, 'title'),
            'description' => Arr::get($taskDetails, 'description'),
            'status' => $status
        ];

        $entity = null;
        try {
            $entity = Task::create($data);
        } catch (Exception $e) {
        }

        if ($entity !== null) {
            $entity = $entity->fresh();
            $entity = $entity->load(['attachments']);
            event(new TaskCreatedEvent($entity, $byUserId));
        }

        return $entity;
    }

    public function updateTaskWithId($id, $updatedDetails, $filters = null, int $byUserId = null)
    {
        $entity = $this->findTaskWithId($id, $filters, $byUserId);
        $oldStatus = null;
        if ($entity !== null) {
            try {
                $oldStatus = $entity->status;
                $status = null;
                if (Arr::get($updatedDetails, 'status') !== null) {
                    $status = Arr::get($updatedDetails, 'status');
                }
                $data = [
                    'title' => Arr::get($updatedDetails, 'title'),
                    'description' => Arr::get($updatedDetails, 'description'),
                ];
                if ($status !== null) {
                    $data['status'] = $status;
                }

                $entity = $entity->fill($data);
                $entity->save();

                $entity = $entity->fresh();
                $entity = $entity->load(['attachments']);
            } catch (Exception $e) {
            }
        }

        if ($entity !== null) {
            event(new TaskUpdatedEvent($entity, $byUserId));
            if (isset($status) && $status != $oldStatus) {
                $this->hasUpdatedStatusForTask($entity, $byUserId);
            }
        }

        return $entity;
    }

    public function deleteTaskWithId($id, $filters = null, int $byUserId = null)
    {
        $entity = $this->findTaskWithId($id, $filters, $byUserId);

        if ($entity !== null) {
            try {
                event(new TaskDeletedEvent($entity, $byUserId));
                $entity->delete();
                if (Arr::get($filters, 'force') === true) {
                    $entity->forceDelete();
                }
            } catch (Exception $e) {
            }
        }

        return $entity;
    }

    protected function hasUpdatedStatusForTask($task, int $byUserId = null)
    {
        $status = $task->status;
        if (isset($status)) {
            try {
                switch ($status) {
                    case TaskStatus::Pending:
                        event(new TaskStatusPendingEvent($task, $byUserId));
                        break;
                    case TaskStatus::Active:
                        event(new TaskStatusActiveEvent($task, $byUserId));
                        break;
                    case TaskStatus::Done:
                        event(new TaskStatusDoneEvent($task, $byUserId));
                        break;
                }
            } catch (Exception $e) {
            }
        }
    }
}
