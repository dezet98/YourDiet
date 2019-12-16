<?php

require_once(controllers/AppController.php)

class Routing
{
    public $routes = [];

    function __construct()
    {
        array_push($this->routes, 'index' => ['controller' => 'DefaultController', 'action' => 'index'], 'login' => ['controller' => 'DefaultController', 'action' => 'login']);
    }

    function run()
    {
        $page = isset($_GET['page'], $this->routes[$_GET['page']]) ? $_GET['page'] : 'index';

        if($this->routes[$page])
        {
            $className = $this->routes[$page]['controller'];
            $action = $this->routes[$page]['action'];
            $object = new $className;
            $object->$action();
        }
    }
} 

?>