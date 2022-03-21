<?php

function getAllUsers($connection){
        $query = "SELECT * FROM user";
        return $connection->query($query);
}

function addUser($connection, $name,$surname,$phoneNumber,$email, $address, $dateOfBirth, $userType){

}