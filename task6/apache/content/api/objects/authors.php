<?php

class Authors
{
    private $connect;
    private $table_name = "authors";

    public $id;
    public $name;
    public $surname;
    public $age;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    function read()
    {
        $query = "SELECT id, name, surname, age FROM " . $this->table_name;

        $stmt = $this->connect->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, surname=:surname, age=:age";

        $stmt = $this->connect->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->age = htmlspecialchars(strip_tags($this->age));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        $stmt->bindParam(":age", $this->age);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update()
    {
        $this->id = htmlspecialchars(strip_tags($this->id));
        $sql = "SELECT name, surname, age FROM " . $this->table_name . " WHERE id = " . $this->id;
        if (empty($this->connect->query($sql)->fetch(PDO::FETCH_ASSOC))) {
            return false;
        }
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->age = htmlspecialchars(strip_tags($this->age));


        if (!empty($this->name) && !empty($this->surname) && !empty($this->age)) {
            $query = "UPDATE " . $this->table_name . " SET name = :name, surname = :surname, age = :age WHERE id = :id";
        } elseif (!empty($this->name) && !empty($this->surname)) {
            $query = "UPDATE " . $this->table_name . " SET name = :name, surname = :surname, age = age WHERE id = :id";
        } elseif (!empty($this->name)) {
            $query = "UPDATE " . $this->table_name . " SET name = :name, surname = surname, age = age WHERE id = :id";
        } else {
            $query = "UPDATE " . $this->table_name . " SET name = name, surname = surname, age = age WHERE id = :id";
        }

        $stmt = $this->connect->prepare($query);
        if (!empty($this->name)) {
            $stmt->bindParam(":name", $this->name);
        }
        if (!empty($this->surname)) {
            $stmt->bindParam(":surname", $this->surname);
        }
        if (!empty($this->age)) {
            $stmt->bindParam(":age", $this->age);
        }
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete()
    {
        $sql = "SELECT id, name, surname, age FROM " . $this->table_name . " WHERE id = ?";

        if ($sql == false)
            return false;
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}