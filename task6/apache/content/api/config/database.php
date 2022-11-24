<?php

class Database
{
    // private $host = "db";
    // private $db_name = "appDB2";
    private $username = "root";
    private $password = "example";
    public $connect;

    public function getConnection(): ?PDO
    {
        $this->connect = null;

        try {
            $this->connect =  new PDO('mysql:host=db;dbname=appDB2', $this->username, $this->password);
            // $this->connect->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Ошибка подключения: " . $exception->getMessage();
        }

        return $this->connect;
    }
}