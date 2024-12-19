<?php

require_once "../../Classes/Dbh.php";
require_once "../../Classes/Requests.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $requestId = $_POST['id'];

    $req = new Requests();

    if ($req->rejectRequestById($requestId)) {
        $_SESSION['success_message'] = "Request deleted successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to delete the request.";
    }
} else {
    $_SESSION['error_message'] = "Invalid request.";
}

header("Location: ../views/view_requests.inc.php");
exit();
