<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Repository//UserRepository.php';

class AdminController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $userRepository = new userRepository();
        $user = $userRepository->getUser($_SESSION['id']);
        $this->render('admin', ['user' => $user]);
    }

    function getUsers()
    {
         echo $_POST["idDZ"];
    }

}


?>