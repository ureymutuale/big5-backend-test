<?php


namespace App\Http\Resources\GuestDomain\Task;


use App\Http\Resources\EntityJsonResource;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class GuestTaskResource extends EntityJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return mixed
     */
    public function toArray($request)
    {
        $resource = $this->resource;
        $response = [];
        if (!Arr::get($resource, 'id')) {
            return $response;
        }
        $response = parent::toArray($request);

        unset($response['created_at']);
        unset($response['updated_at']);
        unset($response['deleted_at']);

        return $response;
    }
}
