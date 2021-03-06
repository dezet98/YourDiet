<?php

class User implements JsonSerializable
{
    private $id_user;
    private $email;
    private $password;
    private $nickname;
    private $role;

    public function __construct(string $email, string $password, string $nickname, string $role, int $id_user = null)
    {
        $this->email = $email;
        $this->password = $password;
        $this->nickname = $nickname;
        $this->id_user = $id_user;
        $this->role = $role;
    }

    public function getId_user(): int
    {
        return $this->id_user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function getRole(): string
    {
        return $this->role;
    }
    
    public function jsonSerialize()
    {
        $json = array(
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'nickname' => $this->getNickname(),
            'role' => $this->getRole(),
            'id_user' => $this->getId_user(),
        );

        return $json;
    }
}

?>