<?php

namespace Mvc;

use Mvc\Request;
use Mvc\Route;

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        
        Router::parse($this->request->url, $this->request);
        
        $controller = $this->loadController();

        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {
        $name = $this->request->controller . "Controller";
        $name = ucfirst($name);
        $namespace = 'Mvc\\Controllers\\' . $name ;
        $controller = new $namespace();

        return $controller;
    }

}
