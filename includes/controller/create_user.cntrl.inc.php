<?php

require_once "../../Classes/Dbh.php";
require_once "../../Classes/Users.php";
require_once '../errors/controller/create_user.cntrl.error.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $username = $_POST['username'];
    $password = $_POST['pwd'];
    $email = $_POST['email'];
    $code = $_POST['employee_code'];

    $create_user = new Users();

    // Error handling
    if (is_input_empty($username, $password, $email, $code)) {
        $errors['empty_input'] = 'Fill in all fields!';
    }

    if (is_username_already_exists($username)) {
        $errors['username_exists'] = 'Username already taken!';
    }
    if (is_employee_code_not_7_digit($code)) {
        $errors['invalid_employee_code'] = "Employer's code must be 7 digit length!";
    }
    if (is_email_invalid($email)) {
        $errors['invalid_email'] = 'Email is not correct!';
    }

    if (!empty($errors)) {
        $_SESSION['errors_create_user'] = $errors;
        header("Location: ../views/create_user.inc.php");
        exit();
    }

    $user = $create_user->createUser($username, $password, $email, $code);
    header("Location: ../views/manager_homepage.inc.php");
}
