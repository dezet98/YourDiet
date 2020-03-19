<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Repository//UserRepository.php';

class AdminController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new userRepository();
    }

    public function index(): void
    {
        $user = $this->userRepository->getUser($_SESSION['id']);
        $this->render('admin', ['user' => $user]);
    }

    function getUsers()
    {   
        $users = $this->userRepository->getUsers();
        echo json_encode((array)$users);
    }
}


?>