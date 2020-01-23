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

        try {
            $stmt = $this->database->connect()->prepare("
            INSERT INTO user (email, password, nickname) 
            VALUES (:email, :password, :nickname);
            ");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);

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

            return new User($user['email'], $user['password'], $user['nickname'], $user['id_user']);
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

    public function getDishes(string $email): ?array
    {
        try{
            $result = [];
            $stmt = $this->database->connect()->prepare("
                SELECT D.* FROM dish D, user U
                WHERE D.id_user = U.id_user AND U.email = :email;
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

    public function createDay(int $id_user, string $date): string
    {
        try{
            $stmt = $this->database->connect()->prepare("
            INSERT INTO day (id_day, id_user, date) VALUES (NULL, :id_user, :date);
            ");
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);

            $stmt->execute();

            return $db->lastInsertId();
        }
        catch(PDOException $e)
        {
            die("Error: " . $e->getMessage());
        }
    }


    public function getDay(string $email, string $date): ?Day
    {
        try{
            $stmt = $this->database->connect()->prepare("
                SELECT D.* FROM day D, user U
                WHERE D.id_user = U.id_user AND U.email = :email AND D.date = :date;
            ");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            
            $stmt->execute();

            $day = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($day == false) 
            {
                return null;
            }

            return new Day($day['id_user'], $day['date'], $day['id_day']);
        }
        catch(PDOException $e)
        {
            die("Error: " . $e->getMessage());
        }
    }
    
    public function createDish(string $id_user, string $name, string $preparationTime, string $file, string $description, string $listOfComponents)
    {
        try{
            $stmt = $this->database->connect()->prepare("
            INSERT INTO dish (id_dish, id_user, name, description, preparationTime, image) VALUES (NULL, :id_user, :name, :description, :preparationTime, :file);
            ");
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':preparationTime', $preparationTime, PDO::PARAM_STR);
            $stmt->bindParam(':file', $file, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);

            $arrayOfComponents = explode(' ', $listOfComponents);
            $id_dish = $stmt->lastInsertId();
            foreach($arrayOfComponents as $id_component)
            {
            $stmt = $this->database->connect()->prepare("
            INSERT INTO dishcomponent (id_dishComponent, id_dish, id_component, amount) VALUES (NULL, :id_dish, :id_component, 1);
            ");
            $stmt->bindParam(':id_dish', $id_dish, PDO::PARAM_INT);
            $stmt->bindParam(':id_component', $id_component, PDO::PARAM_INT);
            }

            $stmt->execute();
        }
        catch(PDOException $e)
        {
            die("Error: " . $e->getMessage());
        }  
    }

    public function addDishToDay(int $id_dish, int $id_day): void
    {
        try{
            $stmt = $this->database->connect()->prepare("
                INSERT INTO dishofday (id_dishOfDay, id_dish, id_day) VALUES (NULL, :id_dish, :id_day);
            ");
            $stmt->bindParam(':id_dish', $id_dish, PDO::PARAM_INT);
            $stmt->bindParam(':id_day', $id_day, PDO::PARAM_INT);

            $stmt->execute();
        }
        catch(PDOException $e)
        {
            die("Error: " . $e->getMessage());
        }
    }


    public function removeDishFromDay(int $id_dish, int $id_day): void
    {
        try{ // it's no good because we don't remove particular dish, here we have only LIMIT. maybe to change 
            $stmt = $this->database->connect()->prepare(" 
                DELETE FROM dishofday  
                WHERE dishofday.id_dish = :id_dish AND dishofday.id_day = :id_day
                LIMIT 1;
            ");
            $stmt->bindParam(':id_dish', $id_dish, PDO::PARAM_INT);
            $stmt->bindParam(':id_day', $id_day, PDO::PARAM_INT);

            $stmt->execute();
        }
        catch(PDOException $e)
        {
            die("Error: " . $e->getMessage());
        }
    }
    

    public function getDishesFromDay(string $email, string $date)
    {
        try{
            $result = [];
            $stmt = $this->database->connect()->prepare("
                SELECT dish.* FROM dish, user, day, dishofday
                WHERE dish.id_user = user.id_user AND day.id_user = user.id_user 
                AND day.id_day = dishofday.id_day AND dish.id_dish = dishofday.id_dish
                AND user.email = :email AND day.date = :date;
            ");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);

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


    public function searchComponents(string $cry)
    {
        try{
            $result = [];
            $name = "%$cry%";
            $stmt = $this->database->connect()->prepare("
                SELECT * FROM component 
                WHERE component.name 
                LIKE :name
                LIMIT 20;
            ");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);

            $stmt->execute();

            $components = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if($components == false) 
            {
                return null;
            }

            foreach ($components as $component) {
                $result[] = new Component(
                    $component['name'],
                    $component['unit'],
                    $component['calories'],
                    $component['carbohydrate'],
                    $component['fats'],
                    $component['protein'],
                    $component['cholesterol'],
                    $component['gluten'],
                    $component['id_component']
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
