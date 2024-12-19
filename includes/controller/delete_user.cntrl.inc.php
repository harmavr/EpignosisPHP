<?php

require_once "../../Classes/Dbh.php";
require_once "../../Classes/Users.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $userId = $_POST['id'];

    $usr = new Users();

    if ($usr->deleteUserById($userId)) {
        $_SESSION['success_message'] = "User deleted successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to delete the user.";
    }
} else {
    $_SESSION['error_message'] = "Invalid request.";
}

header("Location: ../views/manager_homepage.inc.php");
exit();
