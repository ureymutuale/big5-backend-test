<?php


namespace App\Http\Resources\GuestDomain\TaskAttachment;


use App\Http\Resources\EntityJsonResource;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class GuestTaskAttachmentResource extends EntityJsonResource
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
        $response['url'] = URL::to(Storage::url($resource['uri']));

        unset($response['task_id']);
        unset($response['task']);
        unset($response['created_at']);
        unset($response['updated_at']);
        unset($response['deleted_at']);

        return $response;
    }
}
