<?php

class User
{
    private $id,$name, $surname, $phoneNumber, $email, $address, $dateOfBirth, $userType;
    private $connection;
    public function __contruct($connection){
        $this->connection = $connection;
    }

    public static function getAllUsers($connection){
        $query = "SELECT * FROM user";
        return $connection->query($query);
    }
}