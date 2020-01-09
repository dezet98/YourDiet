<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Models//User.php';
require_once __DIR__.'//..//Repository//UserRepository.php';

class DefaultController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function start()
    {
        return $this->render('start');
    }

    public function login()
    {
        $userRepository = new UserRepository();

        if ($this->isPost()) 
        {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $userRepository->getUser($email);

            if (!$user) 
            {
                $this->render('login', ['messages' => ['Błędny adres!']]);
                return;
            }

            if ($user->getPassword() !== $password)
            {
                $this->render('login', ['messages' => ['Błędne hasło!']]);
                return;
            }

            $_SESSION["id"] = $user->getEmail();
            $_SESSION["role"] = $user->getRole();

            $url = "http://$_SERVER[HTTP_HOST]/";
            echo "elo";
            header("Location: {$url}YourDiet/?page=main");
            return;
        }
        
        return $this->render('login');
    }

    public function logOut()
    {
        session_unset();
        session_destroy();
        
        return $this->render('start');
    }

    public function register()
    {
        return $this->render('register');
    }

    public function main()
    {
        return $this->render('main');
    }

}

