<?php

class Dish {
    private $id_dish;
    private $id_user;
    private $name;
    private $preparationTime;
    private $description;
    private $image;
    
    public function __construct(int $id_user, string $name, string $preparationTime, string $description, string $image, int $id_dish = null)
    {
        $this->id_user = $id_user;
        $this->name = $name;
        $this->preparationTime = $preparationTime;
        $this->description = $description;
        $this->image = $image;
        $this->id_dish = $id_dish;
    }

    public function getId_dish(): int
    {
        return $this->id_dish;
    }

    public function getId_user(): int
    {
        return $this->id_user;  
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPreparationTime(): string
    {
        return $this->preparationTime;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}

?>