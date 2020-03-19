<?php

require_once('Repository.php');
require_once __DIR__.'//..//models//User.php';
require_once __DIR__.'//..//models//Dish.php';
require_once __DIR__.'//..//models//Day.php';
require_once __DIR__.'//..//models//Component.php';
require_once __DIR__.'//..//models//DishComponent.php';

class DayRepository extends Repository {

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
                SELECT D.* FROM day D
                INNER JOIN user U ON D.id_user = U.id_user AND U.email = :email AND D.date = :date;
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

    public function getComponentsFromDay(string $email, string $date)
    {
        try{
            $result = [];
            $stmt = $this->database->connect()->prepare("
                SELECT dishcomponent.* FROM dishcomponent, user, day, dish, component, dishofday
                WHERE dishcomponent.id_dish = dish.id_dish AND dishcomponent.id_component = component.id_component  
                AND dish.id_dish = dishofday.id_dish AND day.id_day = dishofday.id_day
                AND dish.id_user = user.id_user AND day.id_user = user.id_user
                AND user.email = :email AND day.date = :date;
            ");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);

            $stmt->execute(); 

            $dishComponents = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if($dishComponents == false) 
            {
                return null;
            }

            foreach ($dishComponents as $dishComponent) {
                $result[] = new DishComponent(
                    $dishComponent['id_dish'],
                    $dishComponent['id_component'],
                    $dishComponent['amount'],
                    $dishComponent['id_dishComponent']
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
