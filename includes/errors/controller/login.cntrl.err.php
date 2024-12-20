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

function is_username_wrong($result)
{
    if (!$result) {
        return true;
    } else {
        return false;
    }
}

function is_password_wrong($pwd, $hashPwd)
{
    if (!password_verify($pwd, $hashPwd)) {
        return true;
    } else if ($pwd === $hashPwd) {
        return true;
    } else {
        return false;
    }
}
