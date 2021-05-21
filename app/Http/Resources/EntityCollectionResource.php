<?php


namespace App\Http\Resources;


use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @method currentPage()
 * @method lastPage()
 * @method path()
 * @method perPage()
 * @method total()
 * @method getCollection()
 */
class EntityCollectionResource extends ResourceCollection
{

    protected $entityClass;

    public function __construct($resource, $class)
    {
        parent::__construct($resource);
        $this->entityClass = $class;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        try {
            $paginated = $this->getCollection()->transform(function ($entity) {
                return new $this->entityClass($entity);
            });
            return [
                'data' => $paginated,
                'links' => [
                ],
                'meta' => [
                ],
                'current_page' => $this->currentPage(),
//            'from' => $this->from(),
                'last_page' => $this->lastPage(),
//            'path' => $this->path(),
                'per_page' => $this->perPage(),
//            'to' => $this->count(),
                'total' => $this->total(),
            ];
        } catch (Exception $e) {

        }
        $paginated = [];
        foreach ($this->collection as $entity) {
            $paginated[] = new $this->entityClass($entity);
        }
        return [
            'data' => $paginated,
            'links' => [
            ],
            'meta' => [
            ],
            'current_page' => 1,
//            'from' => $this->from(),
            'last_page' => 1,
//            'path' => $this->path(),
            'per_page' => count($paginated),
//            'to' => $this->count(),
            'total' => count($paginated),
        ];
    }
}

