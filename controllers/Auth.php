<?php
class Auth
{
    public static function AuthUserById($conn, $userId, $userPassword){
        $query = "SELECT * FROM user WHERE id='$userId'";
        $user = $conn->query($query);
        echo $user;
    }
}