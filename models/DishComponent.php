<?php

class DishComponent implements JsonSerializable
{
    private $id_dishComponent;
    private $id_dish;
    private $id_component;
    private $amount;

    public function __construct(int $id_dish, int $id_component, int $amount, int $id_dishComponent = null)
    {
        $this->id_dish = $id_dish;
        $this->id_component = $id_component;
        $this->amount = $amount;
        $this->id_dishComponent = $id_dishComponent;
    }

    public function getId_dishComponent(): int
    {
        return $this->id_dishComponent;
    }

    public function getId_component(): int
    {
        return $this->id_component;
    }

    public function getId_dish(): int
    {
        return $this->id_dish;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function jsonSerialize()
    {
        $json = array(
            'id_dish' => $this->getId_dish(),
            'id_component' => $this->getId_component(),
            'amount' => $this->getAmount(),
            'id_dishComponent' => $this->getId_dishComponent(),
        );

        return $json;
    }

}

?>