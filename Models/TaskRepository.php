<?php

namespace Mvc\Models;

use Mvc\Models\TaskResourceModel;

class TaskRepository
{
    private $taskRepository;

    public function __construct() {
        $this->taskRepository = new TaskResourceModel('tasks', 'id', new TaskModel);
    }
    public function add($model)
    {
        return $this->taskRepository->save($model);
    }

    public function edit($model)
    {
        return $this->taskRepository->save($model);
    }

    public function delete($model)
    {
        return $this->taskRepository->delete($model->id);
    }

    public function get($id)
    {
        return $this->taskRepository->find($id);
    }

    public function getAll()
    {
        return $this->taskRepository->all();
    }
}