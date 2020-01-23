<?php

class User {
    private $id_user;
    private $email;
    private $password;
    private $nickname;
    private $role = ['ROLE_USER'];

    public function __construct(string $email, string $password, string $nickname, int $id_user = null)
    {
        $this->email = $email;
        $this->password = $password;
        $this->nickname = $nickname;
        $this->id_user = $id_user;
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

    public function getRole(): array
    {
        return $this->role;
    }
    
}

?>