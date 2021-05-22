<?php


namespace App\Http\Controllers\GuestDomain;

use App\Constants\TaskStatus;
use App\Exceptions\ValidationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseListRequest;
use App\Http\Resources\EntityCollectionResource;
use App\Http\Resources\GuestDomain\Task\GuestTaskResource;
use App\Services\Task\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OpenApi\PathItem()
 * Class TasksController
 * @package App\Http\Controllers
 */
class TasksController extends Controller
{
    protected $taskService;

    public function __construct()
    {
        $this->taskService = new TaskService();
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
    public function index(BaseListRequest $request)
    {
        $this->validateRequest($request, [
        ]);
        //$requestUser = $request->user();
        $perPage = $request->per_page;
        $sortBy = $request->order_by;
        $sortOrder = $request->order;
        $filters = $request->only(['status']);

        if ($request->has('search') && strlen($request->search) > 0) {
            $filters['search'] = $request->search;
        }

        $tasks = $this->taskService->getTasksWith($perPage, $sortBy, $sortOrder, $filters, null);
        return new EntityCollectionResource($tasks, GuestTaskResource::class);
    }


    /**
     * Single Resource
     *
     * Get a single resource by id
     *
     * @param Request $request
     * @param $id
     * @return GuestTaskResource
     * @throws ValidationException
     */
    public function show(Request $request, $id)
    {
        $this->validateRequest($request, [
        ]);
        //$requestUser = $request->user();
        $taskId = $id;
        $filters = [];

        $task = $this->taskService->findTaskWithId($taskId, $filters, null);
        return new GuestTaskResource($task);
    }

    /**
     * Create Resource
     *
     * Create new resource
     *
     * @param Request $request
     * @return GuestTaskResource
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validateRequest($request, [
            'title' => 'string|required',
            'description' => 'string|nullable'
        ]);
        //$requestUser = $request->user();
        $filters = [];
        $data = $request->only(['title', 'description']);

        $task = $this->taskService->createTaskWith($data, $filters, null);
        return new GuestTaskResource($task);
    }

    /**
     * Update Resource
     *
     * Update a resource details
     *
     * @param Request $request
     * @param $id
     * @return GuestTaskResource
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $validStatuses = implode(',', [TaskStatus::Pending, TaskStatus::Active, TaskStatus::Done]);
        $this->validateRequest($request, [
            'title' => 'string|required',
            'description' => 'string|nullable',
            'status' => "string|nullable|in:$validStatuses"
        ]);
        //$requestUser = $request->user();
        $taskId = $id;
        $filters = [];
        $data = $request->only(['title', 'description', 'status']);

        $task = $this->taskService->updateTaskWithId($taskId, $data, $filters, null);
        return new GuestTaskResource($task);
    }

    /**
     * Delete Resource
     *
     * Delete a resource instance
     * @param Request $request
     * @param $id
     * @return JsonResponse|mixed
     * @throws ValidationException
     */
    public function destroy(Request $request, $id)
    {
        $this->validateRequest($request, [
            'force' => 'bool|nullable',
        ]);
        //$requestUser = $request->user();
        $taskId = $id;
        $filters = $request->only(['force']);

        $task = $this->taskService->deleteTaskWithId($taskId, $filters, null);
        $data = new GuestTaskResource($task);
        return [
            'deleted' => $id != null,
            'data' => $data
        ];
    }
}
