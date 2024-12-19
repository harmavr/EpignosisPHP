<?php

require_once "../Classes/Dbh.php";
require_once "../Classes/Login.php";
require_once '../includes/errors/controller/login.cntrl.err.php';

// Check if we came here via post method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $username = $_POST['username'];
    $password = $_POST['pwd'];

    $login = new Login();

    $errors = [];

    // Error handling
    if (is_input_empty($username, $password)) {
        $errors['empty_input'] = 'Fill in all fields!';
    }

    $user = $login->authenticate($username, $password);

    if (is_username_wrong($user)) {
        $errors['login_incorrect'] = 'Incorrect username info!';
    } else if (is_password_wrong($password, $user['pwd'])) {
        $errors['login_incorrect'] = 'Incorrect login info!';
    }

    if (!empty($errors)) {
        $_SESSION['errors_login'] = $errors;
        header("Location: ../index.php");
        exit();
    }

    // if we found a user at our db
    if ($user) {
        $_SESSION['user'] = $user;

        if ($user['role'] === 'manager') {
            header("Location: views/manager_homepage.inc.php");
        } else if ($user['role'] === 'employee') {
            header("Location: views/employee_homepage.inc.php");
        }
        exit();
    } else {
        $errors['login_incorrect'] = 'Authentication failed.';
        $_SESSION['errors_login'] = $errors;
        header("Location: ../index.php");
        exit();
    }
}
