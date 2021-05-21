<?php

namespace App\Http\Controllers\UserDomain;

use App\Exceptions\ValidationException;
use App\Http\Controllers\Controller;
use App\Http\Resources\EntityCollectionResource;
use App\Http\Resources\EntityJsonResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OpenApi\PathItem()
 * Class TestController
 * @package App\Http\Controllers
 */
class TestController extends Controller
{
    /**
     * Listing
     *
     * Display a paginated/list of the resource.
     *
     * @param Request $request :: Illuminate request object.
     * @return EntityCollectionResource
     * @throws ValidationException
     */
    public function index(Request $request)
    {
        $this->validateRequest($request, [
        ]);
        //$requestUser = $request->user();
        $data = ['value 1', 'value 2'];
        return new EntityCollectionResource($data, EntityJsonResource::class);
    }


    /**
     * Single Resource
     *
     * Get a single resource by id
     *
     * @param Request $request
     * @param $id
     * @return EntityJsonResource
     * @throws ValidationException
     */
    public function show(Request $request, $id)
    {
        $this->validateRequest($request, [
        ]);
        //$requestUser = $request->user();
        $data = [
            $id => 'value 1'
        ];
        return new EntityJsonResource($data);
    }

    /**
     * Create Resource
     *
     * Create new resource
     *
     * @param Request $request
     * @return EntityJsonResource
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validateRequest($request, [
            'name' => 'string|required'
        ]);
        //$requestUser = $request->user();
        $data = $request->all();
        return new EntityJsonResource($data);
    }

    /**
     * Update Resource
     *
     * Update a resource details
     *
     * @param Request $request
     * @param $id
     * @return EntityJsonResource
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request, [
            'name' => 'string|required'
        ]);
        //$requestUser = $request->user();
        $data = [
            'id' => $request->all(),
        ];
        return new EntityJsonResource($data);
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
        ]);
        //$requestUser = $request->user();
        $data = new EntityJsonResource($id);
        return [
            'deleted' => $id != null,
            'data' => $data
        ];
    }
}
