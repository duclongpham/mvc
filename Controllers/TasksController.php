<?php

namespace Mvc\Controllers;

use Mvc\Core\Controller;
use Mvc\Models\TaskRepository;
use Mvc\Models\TaskModel;

class TasksController extends Controller
{
    private $taskRepo;

    public function __construct(){
        $this->taskRepo = new TaskRepository;
    }

    public function index()
    {

        $d['tasks'] = $this->taskRepo->getAll();
        $this->set($d);
        $this->render("index");
    }

    public function create()
    {
        if (isset($_POST["title"]))
        {
            $taskModel = new TaskModel();
            $taskModel->title = $_POST["title"];
            $taskModel->description = $_POST["description"]??null;
            $taskModel->created_at = date('Y-m-d H:i:s');

            if ($this->taskRepo->add($taskModel))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }

        $this->render("create");
    }

    public function edit($id)
    {   
        $d["task"] = $this->taskRepo->get($id);

        if (isset($_POST["title"]))
        {
            $taskModel = new TaskModel();
            $taskModel->id = $id;
            $taskModel->title = $_POST["title"];
            $taskModel->description = $_POST["description"]??null;
            $taskModel->updated_at = date('Y-m-d H:i:s');

            if ($this->taskRepo->edit($taskModel))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    public function delete($id)
    {
        $taskModel = new TaskModel();
        $taskModel->id = $id;
        if ($this->taskRepo->delete($taskModel))
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }

}
