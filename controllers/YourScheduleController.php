<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Models//User.php';
require_once __DIR__.'//..//Repository//UserRepository.php';

class YourScheduleController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDishes()
    {   
        $userRepository = new UserRepository();
        $dishes = $userRepository->getDishes($_SESSION['id']);
        
        return $this->render('yourSchedule', ['dishes' => $dishes]);
    }

}


?>