<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Models//User.php';
require_once __DIR__.'//..//Repository//UserRepository.php';


class GroceryListController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->dayRepository = new DayRepository();
    }

    public function groceryList()
    {
        return $this->render('groceryList');
    }

    public function addToGroceryList()
    {
        $date = $_POST['date'];
        $email = $_SESSION['id'];

        $componentsFromDay = $this->dayRepository->getComponentsFromDay($email, $date);

        echo json_encode((array)$componentsFromDay);
    }

}

