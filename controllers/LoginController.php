<?php

require_once __DIR__.'//..//Repository//UserRepository.php';

class LoginController extends AppController
{
    public function __construct()
    {
        parent::__construct();
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
                $this->render('login', ['messages' => ['Użytkownik o podanym adresie nie istnieje!']]);
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
            header("Location: {$url}YourDiet/?page=yourSchedule");
            return;
        }
        
        return $this->render('login');
    }

    public function logOut()
    {
        session_unset();
        session_destroy();
        
        return $this->render('start', ['messages' => ['Zostałeś pomyślnie wylogowany!']]);
    }

}

