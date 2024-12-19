<?php

require_once "../../Classes/Dbh.php";
require_once "../../Classes/Requests.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_from = $_POST['date_from'];
    $date_to = $_POST['date_to'];
    $reason = $_POST['reason'];

    $request_vacation = new Requests();
    $request_vacation->createRequest($date_from, $date_to, $reason);

    header("Location: ../views/employee_homepage.inc.php");
    exit();
}
