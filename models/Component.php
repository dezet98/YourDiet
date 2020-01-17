<?php

class Component
{
    private $id_component;
    private $name;
    private $unit;
    private $calories;
    private $carbohydrate;
    private $fats;
    private $protein;
    private $cholesterol;
    private $gluten;

    public function __construct(string $name, string $unit, int $calories, int $carbohydrate, int $fats, int $protein, int $cholesterol, int $gluten, int $id_component = null)
    {
        $this->name = $name;
        $this->unit = $unit;
        $this->calories = $calories;
        $this->carbohydrate = $carbohydrate;
        $this->fats = $fats;
        $this->protein = $protein;
        $this->cholesterol = $cholesterol;
        $this->gluten = $gluten;
        $this->id_component = $id_component;
    }

    public function getId_component(): int
    {
        return $this->id_component;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function getCalories(): int
    {
        return $this->calories;
    }

    public function getCarbohydrate(): int
    {
        return $this->carbohydrate;
    }

    public function getFats(): int
    {
        return $this->fats;
    }

    public function getProtein(): int
    {
        return $this->protein;
    }

    public function getCholesterol(): int
    {
        return $this->cholesterol;
    }

    public function getGluten(): int
    {
        return $this->gluten;
    }
}

?>