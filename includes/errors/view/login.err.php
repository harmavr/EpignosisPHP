<?php

// Check if there are login errors
function check_login_errors()
{
    if (isset($_SESSION['errors_login'])) {
        $errors = $_SESSION['errors_login'];

        foreach ($errors as $error) {
            echo "<p style='color: red;'>" . htmlspecialchars($error) . "</p>";
        }

        unset($_SESSION['errors_login']);
    }
}
