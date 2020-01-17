<?php

require_once('Repository.php');
require_once __DIR__.'//..//models//User.php';
require_once __DIR__.'//..//models//Dish.php';

class UserRepository extends Repository {

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

            return new User($user['email'], $user['password'], $user['nickname'], $user['id_plan'], $user['id_user']);
        }
        catch(PDOException $e)
        {
            die("Error: " . $e->getMessage());
        }

    }

    public function createUser(User $user): void
    {
        $email = $user->getEmail();
        $password = $user->getPassword();
        $nickname = $user->getNickname();
        $id_plan = $user->getId_plan();

        try {
            $stmt = $this->database->connect()->prepare("
            INSERT INTO `user` (`email`, `password`, `nickname`, `id_plan`) 
            VALUES (:email, :password, :nickname, :id_plan);
            ");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
            $stmt->bindParam(':id_plan', $id_plan, PDO::PARAM_INT);

            $stmt->execute();
        }
        catch(PDOException $e)
        {
            die("Error: " . $e->getMessage());
        }
    }

    public function getDishes(string $email): ?array
    {
        try{
            $result = [];
            $stmt = $this->database->connect()->prepare("
                SELECT D.* FROM dish D, user U
                WHERE D.id_user = U.id_user and U.email = :email;
            ");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if($dishes == false) 
            {
                return null;
            }

            foreach ($dishes as $dish) {
                $result[] = new Dish(
                    $dish['id_user'],
                    $dish['name'],
                    $dish['preparationTime'],
                    $dish['description'],
                    $dish['image'],
                    $dish['id_dish']
                );
            }

            return $result;
        }
        catch(PDOException $e)
        {
            die("Error: " . $e->getMessage());
        }

    }

}

?>
