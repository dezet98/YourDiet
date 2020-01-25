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

            if(ltrim($email) === '' || ltrim($nickname) === '' || ltrim($password) === '')
            {
                return $this->render('register', ['messages' => ['Uzupełnij wszystkie pola']]);
            }


            $userExist = $userRepository->getUser($email);

            if($userExist) 
            {
                return $this->render('register', ['messages' => ['Użytkownik o podanym adresie już istnieje']]);
            }
            
            $key = 'c1isvFdxMDdmjOlvxpecFw';
            $password_keyed = hash_hmac("sha256", $password, $key);
            $password_hashed = password_hash($password_keyed, PASSWORD_ARGON2ID);

            $user = new User($email, $password_hashed, $nickname, "ROLE_USER");  
            $userRepository->createUser($user);

            return $this->render('login', ['messages' => ['Rejestracja przebiegła pomyślnie']]);
        }
        
        return $this->render('register');
    }
}

?>

