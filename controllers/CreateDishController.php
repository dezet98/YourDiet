<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Repository//UserRepository.php';
require_once __DIR__.'//..//Repository//DishRepository.php';


class CreateDishController extends AppController
{
    private $userRepository;
    private $dishRepository;
    
    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->dishRepository = new DishRepository();
    }

    public function createDish(): void
    {
        $this->render('createDish');
    }

    public function addDish() 
    {
        $name = $_POST['name'];

        if (ltrim($name) === '')
        {
            $value = array(
                'message' => "Musisz podać nazwe dania!",
                'status' => false
            );
            echo json_encode($value);
            return; # print(json_encode($value));
        }

        $preparationTime = $_POST['preparationTime'];
        $file = $_POST['file'];
        $description = $_POST['description'];
        $componentsArrayJSON = $_POST['components'];

        $user = $this->userRepository->getUser($_SESSION['id']);
        $newDishId = $this->dishRepository->createDish($user->getId_user(), $name, $preparationTime, $file, $description, $componentsArrayJSON);
        
        $value = array(
            'message' => "Danie zostało stworzone poprawnie!",
            'status' => true
        );

        echo json_encode($value);
    }

    public function searchComponents()
    {
        $cry = $_POST['text'];

        $components = $this->dishRepository->searchComponents($cry);

        echo json_encode((array)$components);
    }

}
?>