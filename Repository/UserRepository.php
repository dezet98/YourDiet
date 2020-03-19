<?php

require_once('Repository.php');
require_once __DIR__.'//..//models//User.php';
require_once __DIR__.'//..//models//Dish.php';
require_once __DIR__.'//..//models//Day.php';
require_once __DIR__.'//..//models//Component.php';

class UserRepository extends Repository {

    public function createUser(User $user): void
    {
        $email = $user->getEmail();
        $password = $user->getPassword();
        $nickname = $user->getNickname();
        $role = $user->getRole();

        try {
            $stmt = $this->database->connect()->prepare("
            INSERT INTO user (email, password, nickname, role) 
            VALUES (:email, :password, :nickname, :role);
            ");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);

            $stmt->execute();
        }
        catch(PDOException $e)
        {
            die("Error: " . $e->getMessage());
        }
    }

    public function getUser(string $email): ?User 
    {
        try {
            $stmt = $this->database->connect()->prepare("
                SELECT * FROM user WHERE email = :email
            ");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user == false) 
            {
                return null;
            }

            return new User($user['email'], $user['password'], $user['nickname'], $user['role'], $user['id_user']);
        }
        catch(PDOException $e)
        {
            die("Error: " . $e->getMessage());
        }

    }

    public function getUsers()
    {
        try {
            $stmt = $this->database->connect()->prepare("
            SELECT * FROM user WHERE email != :email;
            ");
            $stmt->bindParam(':email', $_SESSION['id'], PDO::PARAM_STR);
            $stmt->execute();

            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $users;
        }
        catch(PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getUsersAndDishes()
    {
        try {
            $stmt = $this->database->connect()->prepare("
            SELECT user.name, dish.name FROM user, INNER JOIN dish ON user.id_user != dish.id_user;
            ");

            $stmt->execute();

            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $users;
        }
        catch(PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}

?>
