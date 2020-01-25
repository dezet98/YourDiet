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
        if ($this->isPost()) 
        {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userRepository = new UserRepository();
            $user = $userRepository->getUser($email);

            if (!$user) 
            {
                return $this->render('login', ['messages' => ['Użytkownik o podanym adresie nie istnieje!']]);
               
            }

            $key = 'c1isvFdxMDdmjOlvxpecFw';
            $password_keyed = hash_hmac("sha256", $password, $key);
            $password_hashed = $user->getPassword();

            if (!password_verify($password_keyed, $password_hashed))
            {
                return $this->render('login', ['messages' => ['Błędne hasło!']]);
            }

            $_SESSION["id"] = $user->getEmail();
            $_SESSION["role"] = $user->getRole();

            return $this->render('yourSchedule');
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

?>

