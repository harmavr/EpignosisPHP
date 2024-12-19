<?php

require_once "Dbh.php";

class Users extends Dbh
{

    public function getUsers()
    {

        $sql = 'SELECT * FROM users WHERE role = "employee";';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        }
        return [];
    }

    public function getUserById($id)
    {
        $sql = 'SELECT * FROM users WHERE id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }

    public function createUser($username, $pwd, $email, $code, $role = 'employee')
    {

        $sql = 'INSERT INTO users(username, pwd, email, employee_code, role) VALUES (:username, :pwd, :email, :code, :role)';
        $stmt = $this->connect()->prepare($sql);

        $options = [
            'cost' => 12
        ];

        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $hashedPwd);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":code", $code);
        $stmt->bindParam(":role", $role);

        $stmt->execute();
    }

    public function updateUserById($id, $username, $pwd, $email)
    {
        $sql = "UPDATE users SET username = :username, pwd = :pwd, email = :email WHERE id = :id";
        $stmt = $this->connect()->prepare($sql);

        $options = [
            'cost' => 12
        ];

        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $hashedPwd);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":id", $id);

        $stmt->execute();
    }

    public function deleteUserById($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
