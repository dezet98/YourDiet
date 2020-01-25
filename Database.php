<?php

require_once "config.php";


class Database {
    private $username;
    private $password;
    private $host;
    private $database;

    public function __construct()
    {
        $this->username = USERNAME;
        $this->password = PASSWORD;
        $this->host = HOST;
        $this->database = DATABASE;
    }

    public function connect()
    {
        try {
            $conn = new PDO("mysql:host=$this->host; dbname=$this->database", $this->username, $this->password);
            $conn -> query ('SET NAMES utf8');  // without that I won't have polish marks
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    } 
}

?>