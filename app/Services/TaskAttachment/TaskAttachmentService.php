<?php


namespace App\Services\TaskAttachment;


use App\Events\Models\TaskAttachment\TaskAttachmentCreatedEvent;
use App\Events\Models\TaskAttachment\TaskAttachmentDeletedEvent;
use App\Models\TaskAttachment;
use App\Services\Task\TaskService;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Schema;
use Webpatser\Uuid\Uuid;

class TaskAttachmentService extends TaskService implements ITaskAttachmentService
{

    public function getTaskAttachmentsWith(int $perPage, $sortBy = null, string $order = null, $filters = null, int $byUserId = null)
    {
        $taskId = null;
        if (Arr::get($filters, 'task_id') !== null) {
            $taskId = Arr::get($filters, 'task_id');
        }

        //Check if task with id exists
        if ($this->findTaskWithId($taskId, null, $byUserId) == null) {
            return []; //throw error for no task found
        }

        $query = TaskAttachment::query()
            ->where('task_id', $taskId)
            ->with(['task']);

        if (Arr::get($filters, 'file_type') !== null) {
            $fileType = Arr::get($filters, 'file_type');
            $query = $query->where('file_type', $fileType);
        }

        //Sort
        if ($sortBy !== null) {
            $prefix = "";
            $validValues = array("asc", "desc");
            $order = in_array(strtolower($order), $validValues) ? $order : 'asc';
            if (is_array($sortBy)) {
                foreach ($sortBy as $by) {
                    if (in_array(strtolower($by), Schema::getColumnListing('attachments'))) {
                        $query = $query->orderBy("{$prefix}{$by}", $order);
                    }
                }
            } else {
                if (in_array(strtolower($sortBy), Schema::getColumnListing('attachments'))) {
                    $query = $query->orderBy("{$prefix}{$sortBy}", $order);
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

    public function findTaskAttachmentWithId($id, $filters = null, int $byUserId = null)
    {
        $taskId = null;
        if (Arr::get($filters, 'task_id') !== null) {
            $taskId = Arr::get($filters, 'task_id');
        }

        //Check if task with id exists
        if ($this->findTaskWithId($taskId, null, $byUserId) == null) {
            return null; //throw error for no task found
        }

        $query = TaskAttachment::query()
            ->where('id', $id)
            ->where('task_id', $taskId)
            ->with(['task']);

        if (Arr::get($filters, 'file_type') !== null) {
            $fileType = Arr::get($filters, 'file_type');
            $query = $query->where('file_type', $fileType);
        }

        $query = $query->first();

        return $query;
    }

    public function createTaskAttachmentWith($taskAttachmentDetails, $filters = null, int $byUserId = null)
    {
        $taskId = Arr::get($taskAttachmentDetails, 'task_id');
        $file = Arr::get($taskAttachmentDetails, 'file');
        if (!isset($taskId) || !isset($file)) {
            return null;//throw error for no file
        }

        //Check if task with id exists
        if ($this->findTaskWithId($taskId, null, $byUserId) == null) {
            return null; //throw error for no task found
        }

        try {
            $storageDisk = 'local';
            $attachmentFolder = trim("public/task/{$taskId}/attachments", '/');
            $mimeType = $file->getMimeType();
            $extension = $file->getClientOriginalExtension();
//            $filename = $file->getClientOriginalName();
            $filename = strtolower(Uuid::generate(4)->string);
            $filename = "{$filename}.{$extension}";
            $fileUri = Storage::disk($storageDisk)->putFileAs($attachmentFolder, $file, $filename, 'public');

            $fileType = $mimeType;
            $attachmentDetails['uri'] = $fileUri;
        } catch (Exception $e) {
            return null;//throw error for no file
        }

        $data = [
            'file_type' => $fileType,
            'name' => Arr::get($attachmentDetails, 'name'),
            'uri' => Arr::get($attachmentDetails, 'uri'),
            'task_id' => $taskId,
        ];

        $entity = null;
        try {
            $entity = TaskAttachment::create($data);
        } catch (Exception $e) {
        }

        if ($entity !== null) {
            $entity = $entity->fresh();
            $entity = $entity->load(['task']);
            event(new TaskAttachmentCreatedEvent($entity, $byUserId));
        }
        return $entity;
    }

    public function deleteTaskAttachmentWithId($id, $filters = null, int $byUserId = null)
    {
        $entity = $this->findTaskAttachmentWithId($id, $filters, $byUserId);

        if ($entity !== null) {
            try {
                event(new TaskAttachmentDeletedEvent($entity, $byUserId));
                $entity->delete();
                if (Arr::get($filters, 'force') === true) {
                    $entity->forceDelete();
                }
            } catch (Exception $e) {
            }
        }

        return $entity;
    }
}
