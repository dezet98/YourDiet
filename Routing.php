<?php

require_once('controllers/DefaultController.php');
require_once('controllers/LoginController.php');
require_once('controllers/RegisterController.php');
require_once('controllers/YourScheduleController.php');
require_once('controllers/AdminController.php');
require_once('controllers/CreateDishController.php');

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
            'yourSchedule' => ['controller' => 'YourScheduleController', 'action' => 'getDishes'],
            'addToSchedule' => ['controller' => 'YourScheduleController', 'action' => 'addToSchedule'],
            'removeFromSchedule' => ['controller' => 'YourScheduleController', 'action' => 'removeFromSchedule'],
            'admin' => ['controller' => 'AdminController', 'action' => 'index'],
            'adminUsers' => ['controller' => 'AdminController', 'action' => 'getUsers'],
            'createDish' => ['controller' => 'CreateDishController', 'action' => 'createDish'],
            'addDish' => ['controller' => 'CreateDishController', 'action' => 'addDish'],
            'searchComponents' => ['controller' => 'CreateDishController', 'action' => 'searchComponents']
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