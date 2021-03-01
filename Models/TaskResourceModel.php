<?php

namespace Mvc\Models;

use Mvc\Core\ResourceModel;
use Mvc\models\TaskModel;

class TaskResourceModel extends ResourceModel
{
    public function __construct($table, $id, TaskModel $task){
        parent::_init($table, $id, $task);
    }
}