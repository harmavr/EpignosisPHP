<?php

require_once "Dbh.php";

class Login extends Dbh
{
    public function authenticate($username)
    {
        $query = 'SELECT * FROM users WHERE username = :username;';

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}
