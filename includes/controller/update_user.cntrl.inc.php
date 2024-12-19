<?php

require_once "../../Classes/Dbh.php";
require_once "../../Classes/Users.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $userId = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['pwd'];
    $email = $_POST['email'];

    $usr = new Users();

    if ($usr->updateUserById($userId, $username, $password, $email)) {
        $_SESSION['success_message'] = "User updated successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to update the user.";
    }
} else {
    $_SESSION['error_message'] = "Invalid request.";
}

header("Location: ../views/edit_user.inc.php");
exit();
