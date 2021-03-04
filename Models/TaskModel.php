<?php

namespace Mvc\Models;

use Mvc\Core\Model;

class TaskModel extends Model
{
    protected $id;
    protected $title;
    protected $description;
    protected $create_at;
    protected $update_at;

    /**
     * @todo get properties 
     */
    public function __get($key)
    {
        return $this->$key;
    }

    /**
     * @todo set properties 
     */
    public function __set($key, $value)
    {
        $this->$key = $value;
    }
}