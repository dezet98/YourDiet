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

    public function yourSchedule()
    {   
        return $this->render('yourSchedule');
    }

    public function addToSchedule()
    {
        $id_dish = $_POST['id_dish'];
        $date =  $_POST['date'];    
        $email = $_SESSION['id'];

        $userRepository = new UserRepository();
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
        $id_dish = $_POST['id_dish'];
        $date = $_POST['date'];
        $email = $_SESSION['id'];

        $userRepository = new UserRepository();
        $day = $userRepository->getDay($email, $date);
        $userRepository->removeDishFromDay($id_dish, $day->getId_day()); 
    }

    public function updateSchedule()
    {
        $date = $_POST['date'];    
        $email = $_SESSION['id'];

        $userRepository = new UserRepository();
        $dayExist = $userRepository->getDay($email, $date);

        if($dayExist) 
        {
            $dishesFromDay =  $userRepository->getDishesFromDay($email, $date); 
            echo json_encode((array)$dishesFromDay);
        } 
    }

    public function searchDishes()
    {
        $cry = $_POST['text'];
        $email = $_SESSION['id'];

        $userRepository = new UserRepository();
        $dishes = $userRepository->searchDishes($cry, $email);

        echo json_encode((array)$dishes);
    }
}

?>