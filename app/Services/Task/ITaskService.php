<?php


namespace App\Services\Task;


interface ITaskService
{
    /**
     * Get collection of Tasks
     * @param int $perPage :: pagination limit
     * @param $sortBy :: column(s) to sort by
     * @param string|null $order :: ASC or DESC
     * @param null $filters
     * @param int|null $byUserId :: User making the request
     * @return mixed
     */
    public function getTasksWith(int $perPage, $sortBy = null, string $order = null, $filters = null,
                                 int $byUserId = null);

    /**
     * Get Task with id
     * @param $id :: entity id
     * @param null $filters
     * @param int|null $byUserId :: User making the request
     * @return mixed
     */
    public function findTaskWithId($id, $filters = null, int $byUserId = null);

    /**
     * Create new Task with details
     * @param $taskDetails :: details for Task
     * @param null $filters
     * @param int|null $byUserId :: User making the request
     * @return mixed
     */
    public function createTaskWith($taskDetails, $filters = null, int $byUserId = null);

    /**
     * Update Task with id
     * @param $id :: entity id
     * @param $updatedDetails :: updated details for user
     * @param null $filters
     * @param int|null $byUserId :: User making the request
     * @return mixed
     */
    public function updateTaskWithId($id, $updatedDetails, $filters = null, int $byUserId = null);


    /**
     * Delete Task with id
     * @param $id :: entity id
     * @param null $filters
     * @param int|null $byUserId :: User making the request
     * @return mixed
     */
    public function deleteTaskWithId($id, $filters = null, int $byUserId = null);
}
