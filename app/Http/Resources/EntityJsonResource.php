<?php


namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntityJsonResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }


    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return mixed
     */
    public function toArray($request)
    {
        $resource = $this->resource;
        $response = $resource;
//        $response = parent::toArray($resource);
        return $response;
    }
}

