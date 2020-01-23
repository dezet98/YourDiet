<?php

class Day
{
    private $id_day;
    private $id_user;
    private $date;

    public function __construct(int $id_user, string $date, int $id_day = null)
    {
        $this->id_day = $id_day;
        $this->id_user = $id_user;
        $this->date = $date;
    }
    public function getId_day(): int
    {
        return $this->id_day;
    }

    public function getId_user(): int
    {
        return $this->id_user;
    }

    public function getdate(): string
    {
        return $this->date;
    }

}

?>