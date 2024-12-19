<?php

require_once 'includes/errors/view/login.err.php';

// it is needed for the function check_login_errors()
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./styles/index.module.css">
</head>

<body>
    <h3>Login</h3>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <button type="submit">Login</button>
    </form>

    <div>
        <?php
        check_login_errors();
        ?>
    </div>
</body>

</html>