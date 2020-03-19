<?php

require_once('Repository.php');
require_once __DIR__.'//..//models//User.php';
require_once __DIR__.'//..//models//Dish.php';
require_once __DIR__.'//..//models//Day.php';
require_once __DIR__.'//..//models//Component.php';

class DishRepository extends Repository {

    public function getDishes(string $email): ?array
    {
        try{
            $result = [];
            $stmt = $this->database->connect()->prepare("
                SELECT D.* FROM dish D
                INNER JOIN user U ON D.id_user = U.id_user AND U.email = :email;
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
    
    public function createDish(string $id_user, string $name, string $preparationTime, string $file, string $description, string $componentsArrayJSON)
    {
        try{
            $conn = $this->database->connect();
            //$conn->beginTransaction();

            $stmt = $conn->prepare("
            INSERT INTO dish (id_dish, id_user, name, description, preparationTime, image) VALUES (NULL, :id_user, :name, :description, :preparationTime, :file);
            ");
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':preparationTime', $preparationTime, PDO::PARAM_STR);
            $stmt->bindParam(':file', $file, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);

            $stmt->execute();

            $components = json_decode($componentsArrayJSON); 
            $id_dish = $conn->lastInsertId();

            foreach($components as $id_component => $amount)
            {
                $stmt = $this->database->connect()->prepare("
                INSERT INTO dishcomponent (id_dishComponent, id_dish, id_component, amount) VALUES (NULL, :id_dish, :id_component, :amount);
                ");
                $stmt->bindParam(':id_dish', $id_dish, PDO::PARAM_INT);
                $stmt->bindParam(':id_component', $id_component, PDO::PARAM_INT);
                $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);   //str because amount is float, so probably I don't have exit
                $stmt->execute();
            }

            //$conn->commit();  
        }
        catch(PDOException $e)
        {
            //$conn->rollback();
            die("Error: " . $e->getMessage());
        }  
    }

    public function searchDishes(string $cry, string $email)
    {
        try{
            $result = [];
            $name = "%$cry%";
            $stmt = $this->database->connect()->prepare("
                SELECT dish.* FROM dish
                INNER JOIN user ON user.id_user = dish.id_user AND user.email = :email AND dish.name 
                LIKE :name
                LIMIT 20;
            ");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
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
