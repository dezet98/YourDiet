<?php

require_once('controllers/DefaultController.php');

class Routing
{
    public $routes = [];

    function __construct()
    {
        $this->routes = [
            'start' => ['controller' => 'DefaultController', 'action' => 'start'],
            'login' => ['controller' => 'DefaultController', 'action' => 'login'],
            'logOut' => ['controller' => 'DefaultController', 'action' => 'logOut'],
            'register' => ['controller' => 'DefaultController', 'action' => 'register'],
            'main' => ['controller' => 'DefaultController', 'action' => 'main']
                        ];
    }

    function run()
    {
        $page = isset($_GET['page'], $this->routes[$_GET['page']]) ? $_GET['page'] : 'start';

        if($this->routes[$page])
        {
            $controller = $this->routes[$page]['controller'];
            $action = $this->routes[$page]['action'];
            $object = new $controller;
            $object->$action();
        }
    }
} 

?>