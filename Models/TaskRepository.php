<?php

namespace Mvc\Models;

use Mvc\Models\TaskResourceModel;

class TaskRepository
{
    private $taskRepository;

    public function __construct() {
        $this->taskRepository = new TaskResourceModel('tasks', 'id', new TaskModel);
    }

    /**
     * @param object $model
     * @return bool
     */
    public function add($model)
    {
        return $this->taskRepository->save($model);
    }

    /**
     * @param object $model
     * @return bool
     */
    public function edit($model)
    {
        return $this->taskRepository->save($model);
    }

    /**
     * @param object $model
     * @return bool
     */
    public function delete($model)
    {
        return $this->taskRepository->delete($model->id);
    }

    /**
     * @param string/int $id
     * @return object
     */
    public function get($id)
    {
        return $this->taskRepository->find($id);
    }

    /**
     * @return object
     */
    public function getAll()
    {
        return $this->taskRepository->all();
    }
}