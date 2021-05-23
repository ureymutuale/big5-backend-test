<?php


namespace App\Services\TaskAttachment;


interface ITaskAttachmentService
{
    /**
     * Get collection of TaskAttachments
     * @param int $perPage :: pagination limit
     * @param $sortBy :: column to sort by
     * @param string|null $order :: ASC or DESC
     * @param null $filters
     * @param int|null $byUserId :: User making the request
     * @return mixed
     */
    public function getTaskAttachmentsWith(int $perPage, $sortBy = null, string $order = null, $filters = null,
                                           int $byUserId = null);

    /**
     * Get TaskAttachment with id
     * @param $id :: entity id
     * @param null $filters
     * @param int|null $byUserId :: User making the request
     * @return mixed
     */
    public function findTaskAttachmentWithId($id, $filters = null, int $byUserId = null);

    /**
     * Create new TaskAttachment with details
     * @param $taskAttachmentDetails :: details for TaskAttachment
     * @param null $filters
     * @param int|null $byUserId :: User making the request
     * @return mixed
     */
    public function createTaskAttachmentWith($taskAttachmentDetails, $filters = null, int $byUserId = null);

    /**
     * Delete TaskAttachment with id
     * @param $id :: entity id
     * @param null $filters
     * @param int|null $byUserId :: User making the request
     * @return mixed
     */
    public function deleteTaskAttachmentWithId($id, $filters = null, int $byUserId = null);
}
