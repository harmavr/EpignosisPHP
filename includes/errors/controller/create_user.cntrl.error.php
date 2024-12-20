<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/EpignosisPHP/Classes/Dbh.php';

function is_input_empty($username, $pwd)
{
    if (empty($username) || empty($pwd)) {
        return true;
    } else {
        return false;
    }
}

function is_username_already_exists($username, $user)
{
    $result = $user->getUserById($username);
    if ($result != null) {
        return true;
    } else {
        return false;
    }
}


function is_employee_code_7_digit($code)
{
    if (strlen((string)$code) === 7) {
        return true;
    } else return false;
}

function is_email_valid($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
