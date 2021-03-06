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
        if (!$resource || !Arr::get($resource, 'id')) {
            return null;
        }
        $response = parent::toArray($request);
        $response['attachments_count'] = count($resource['attachments']);

        unset($response['attachments']);
        unset($response['created_at']);
        unset($response['updated_at']);
        unset($response['deleted_at']);

        return $response;
    }
}
