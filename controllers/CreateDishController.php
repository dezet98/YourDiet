<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Repository//UserRepository.php';

class CreateDishController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createDish(): void
    {

        $this->render('createDish');
    }
 /*
    public function addDish() 
    {
        $userRepository = new UserRepository();
        $name ="kaczka";
        $preparationTime = "30min";
        $file = "food";
        $description = "dsadasdasd";
        $listOfComponents = array(1 => 3, 1=> 3, 2=>1);

        $user = $userRepository->getUser($_SESSION['id']);
        $newDishId = $userRepository->createDish($user->getId_user(), $name, $preparationTime, $file, $description, $listOfComponents);

        $this->render('createDish', ['messages' => ["ok"]]);
    }*/

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
        }
        else {
            $userRepository = new UserRepository();

            $preparationTime = $_POST['preparationTime'];
            $file = $_POST['file'];
            $description = $_POST['description'];
            $componentsArrayJSON = $_POST['components'];

            $user = $userRepository->getUser($_SESSION['id']);
            $newDishId = $userRepository->createDish($user->getId_user(), $name, $preparationTime, $file, $description, $componentsArrayJSON);
            
            $value = array(
                'message' => "Danie zostało stworzone poprawnie!",
                'status' => true
            );

            echo json_encode($value);
        }
    }

    public function searchComponents()
    {
        $cry = $_POST['text'];

        $userRepository = new UserRepository();
        $components = $userRepository->searchComponents($cry);

        echo json_encode((array)$components);
    }

}


?>