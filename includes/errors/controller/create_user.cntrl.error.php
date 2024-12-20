<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/EpignosisPHP/Classes/Dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/EpignosisPHP/Classes/Users.php';

function is_input_empty($username, $pwd)
{
    if (empty($username) || empty($pwd)) {
        return true;
    } else {
        return false;
    }
}

function is_username_already_exists($username)
{
    $user = new Users();

    $result = $user->getUserByName($username);

    if ($result !== null) {
        return true;
    } else {
        return false;
    }
}

function is_employee_code_not_7_digit($code)
{

    if (strlen((string)$code) !== 7) {

        return true;
    } else return false;
}

function is_email_invalid($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        return true;
    } else {
        return false;
    }
}
