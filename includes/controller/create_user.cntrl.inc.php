<?php

require_once "../../Classes/Dbh.php";
require_once "../../Classes/Users.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['pwd'];
    $email = $_POST['email'];
    $code = $_POST['employee_code'];

    $create_user = new Users();
    $user = $create_user->createUser($username, $password, $email, $code);
    header("Location: ../views/manager_homepage.inc.php");
}
