<?php


namespace App\Http\Controllers\GuestDomain;


use App\Exceptions\ValidationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseListRequest;
use App\Http\Resources\EntityCollectionResource;
use App\Http\Resources\GuestDomain\TaskAttachment\GuestTaskAttachmentResource;
use App\Services\TaskAttachment\TaskAttachmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OpenApi\PathItem()
 * Class TaskAttachmentsController
 * @package App\Http\Controllers
 */
class TaskAttachmentsController extends Controller
{
    protected $attachmentService;

    public function __construct()
    {
        $this->attachmentService = new TaskAttachmentService();
    }

    /**
     * Listing
     *
     * Display a paginated/list of the resource.
     *
     * @param BaseListRequest $request :: Illuminate request object.
     * @return EntityCollectionResource
     * @throws ValidationException
     */
    public function index(BaseListRequest $request, $taskId)
    {
        $this->validateRequest($request, [
        ]);
        //$requestUser = $request->user();
        $perPage = $request->per_page;
        $sortBy = $request->order_by;
        $sortOrder = $request->order;
        $filters = $request->only(['file_type']);

        if ($request->has('search') && strlen($request->search) > 0) {
            $filters['search'] = $request->search;
        }
        $filters['task_id'] = $taskId;

        $tasks = $this->attachmentService->getTaskAttachmentsWith($perPage, $sortBy, $sortOrder, $filters, null);
        return new EntityCollectionResource($tasks, GuestTaskAttachmentResource::class);
    }

    /**
     * Create Resource
     *
     * Create new resource
     *
     * @param Request $request
     * @return GuestTaskAttachmentResource
     * @throws ValidationException
     */
    public function store(Request $request, $taskId)
    {
        $this->validateRequest($request, [
            'file' => 'required|file|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:5120',
        ]);
        //$requestUser = $request->user();
        $filters = [];
        $filters['task_id'] = $taskId;
        $data = [
            'task_id' => $taskId,
            'file' => $request['file']
        ];

        $task = $this->attachmentService->createTaskAttachmentWith($data, $filters, null);
        return new GuestTaskAttachmentResource($task);
    }

    /**
     * Delete Resource
     *
     * Delete a resource instance
     * @param Request $request
     * @param $taskId
     * @param $id
     * @return JsonResponse|mixed
     * @throws ValidationException
     */
    public function destroy(Request $request, $taskId, $id)
    {
        $this->validateRequest($request, [
            'force' => 'bool|nullable',
        ]);
        //$requestUser = $request->user();
        $attachmentId = $id;
        $filters = $request->only(['force']);
        $filters['task_id'] = $taskId;

        $task = $this->attachmentService->deleteTaskAttachmentWithId($attachmentId, $filters, null);
        $data = new GuestTaskAttachmentResource($task);
        return [
            'deleted' => $task != null,
            'data' => $data
        ];
    }
}
