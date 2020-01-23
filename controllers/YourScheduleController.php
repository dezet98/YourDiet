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
        $dishesOfDay = $userRepository->getDishesFromDay($_SESSION['id'], date("Y-m-d"));

        return $this->render('yourSchedule', ['dishes' => $dishes, 'dishesOfDay' => $dishesOfDay]);
    }

    public function addToSchedule()
    {
        $userRepository = new UserRepository();

        $id_dish = $_POST['id_dish'];
        $date =  $_POST['date'];    
        $email = $_SESSION['id'];

        $dayExist = $userRepository->getDay($email, $date);

        if($dayExist) 
        {
            $userRepository->addDishToDay($id_dish, $dayExist->getId_day());   
        } 
        else // if user doesn't have a concrete day we have to create that day first:
        {
            $user = $userRepository->getUser($email);   
            $userRepository->createDay($user->getId_user(), $date);
            $day = $userRepository->getDay($email, $date);
            $userRepository->addDishToDay($id_dish, $day->getId_day()); 
        }
    }

    public function removeFromSchedule()
    {
        $userRepository = new UserRepository();

        $id_dish = $_POST['id_dish'];
        $date = $_POST['date'];
        $email = $_SESSION['id'];

        $day = $userRepository->getDay($email, $date);
        $userRepository->removeDishFromDay($id_dish, $day->getId_day()); 
    }


}


?>