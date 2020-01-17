<?php

require_once('controllers/DefaultController.php');
require_once('controllers/LoginController.php');
require_once('controllers/RegisterController.php');
require_once('controllers/YourScheduleController.php');

class Routing
{
    public $routes = [];

    function __construct()
    {
        $this->routes = [
            'start' => ['controller' => 'DefaultController', 'action' => 'start'],
            'login' => ['controller' => 'LoginController', 'action' => 'login'],
            'logOut' => ['controller' => 'LoginController', 'action' => 'logOut'],
            'register' => ['controller' => 'RegisterController', 'action' => 'register'],
            'yourSchedule' => ['controller' => 'YourScheduleController', 'action' => 'getDishes']
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