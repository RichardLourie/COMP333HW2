<?php

include 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userid = $_POST['userid'];
    $password = $_POST['password'];
    $verifyPassword = $_POST['confirm_password'];

    if ($password === $verifyPassword && strlen($password) >= 10) {
        // Use password_hash to securely hash the user's password.
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if the user already exists (optional, you can remove this if needed).
        $checkUserQuery = "SELECT username FROM users WHERE username = ?";
        $stmt = mysqli_prepare($db, $checkUserQuery);
        mysqli_stmt_bind_param($stmt, "s", $userid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            echo "User with this username already exists. Please choose a different username.";
            echo '<br /><a href="signup.html">Retry</a>';
        } else {
            // Insert the new user into the users table.
            $insertUserQuery = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = mysqli_prepare($db, $insertUserQuery);
            mysqli_stmt_bind_param($stmt, "ss", $userid, $hashedPassword);

            if (mysqli_stmt_execute($stmt)) {
                echo "User registration successful!";
                echo '<br /><a href="index.html">Login</a>';
            } else {
                echo "An error occurred during registration. Please try again.";
                echo '<br /><a href="signup.html">Retry</a>';
            }
        }
    } else {
        if ($password === $verifyPassword) {
            echo "Passwords match";
        }
        if (strlen($password) >= 10) {
            echo "length greater than 10";
        }
        echo "Password and confirm password do not match or are less than 10 characters long.";
        echo '<br /><a href="signup.html">Retry</a>';
    }
}
?>
