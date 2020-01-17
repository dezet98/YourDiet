<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Models//User.php';
require_once __DIR__.'//..//Repository//UserRepository.php';

class RegisterController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register()
    {   
        $userRepository = new UserRepository();

        if ($this->isPost()) 
        {
            $email = $_POST['email'];
            $nickname = $_POST['nickname'];
            $password = $_POST['password'];

            $userExist = $userRepository->getUser($email);

            if ($userExist) 
            {
                return $this->render('register', ['messages' => ['Użytkownik o podanym adresie już istnieje']]);
            }
  
            $user = new User($email, $password, $nickname, 1);  // you have to deal with id_plan in future
            $userRepository->createUser($user);

            return $this->render('login', ['messages' => ['Rejestracja przebiegła pomyślnie']]);
        }
        
        return $this->render('register');
    }

}

?>