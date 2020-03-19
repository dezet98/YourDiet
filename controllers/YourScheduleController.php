<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Models//User.php';
require_once __DIR__.'//..//Repository//DayRepository.php';
require_once __DIR__.'//..//Repository//DishRepository.php';

class YourScheduleController extends AppController
{
    private $dayRepository;
    private $userRepository;

    public function __construct()
    {
        parent::__construct(); 
        $this->dayRepository = new DayRepository();
        $this->userRepository = new UserRepository();
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

        $dayExist = $this->dayRepository->getDay($email, $date);

        if($dayExist) 
        {
            $this->dayRepository->addDishToDay($id_dish, $dayExist->getId_day());   
        } 
        else // if user doesn't have a concrete day we have to create that day first:
        {
            $user = $this->userRepository->getUser($email);   
            $this->dayRepository->createDay($user->getId_user(), $date);
            $day = $this->dayRepository->getDay($email, $date);
            $this->dayRepository->addDishToDay($id_dish, $day->getId_day()); 
        }
    }

    public function removeFromSchedule()
    {
        $id_dish = $_POST['id_dish'];
        $date = $_POST['date'];
        $email = $_SESSION['id'];

        $day = $this->dayRepository->getDay($email, $date);
        $this->dayRepository->removeDishFromDay($id_dish, $day->getId_day()); 
    }

    public function updateSchedule()
    {
        $date = $_POST['date'];    
        $email = $_SESSION['id'];

        $dayExist = $this->dayRepository->getDay($email, $date);

        if($dayExist) 
        {
            $dishesFromDay =  $this->dayRepository->getDishesFromDay($email, $date); 
            echo json_encode((array)$dishesFromDay);
        } 
    }

    public function searchDishes()
    {
        $cry = $_POST['text'];
        $email = $_SESSION['id'];

        $this->dishRepository = new DishRepository();
        $dishes = $this->dishRepository->searchDishes($cry, $email);

        echo json_encode((array)$dishes);
    }
}
?>