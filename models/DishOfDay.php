<?php

class DishOfDay
{
    private $id_dishOfDay;
    private $id_dish;
    private $id_day;

    public function __construct(int $id_dish, int $id_day, int $id_dishOfDay = null)
    {
        $this->id_dish = $id_dish;
        $this->id_day = $id_day;
        $this->id_dishOfDay = $id_dishOfDay;
    }

    public function getId_dishOfDay(): int
    {
        return $this->id_dishOfDay;
    }

    public function getId_dish(): int
    {
        return $this->id_dish;
    }

    public function getId_day(): int
    {
        return $this->id_day;
    } 

}

?>