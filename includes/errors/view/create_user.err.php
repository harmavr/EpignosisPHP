<?php

// Check if there are errors in creating the user
function check_create_user_errors()
{
    if (isset($_SESSION['errors_create_user'])) {
        $errors = $_SESSION['errors_create_user'];

        foreach ($errors as $error) {
            echo "<p style='color: red;'>" . htmlspecialchars($error) . "</p>";
        }

        unset($_SESSION['errors_create_user']);
    }
}
