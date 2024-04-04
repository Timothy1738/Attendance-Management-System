<?php
include_once "connection.php";
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title>Return to login page</title>
</head>
<body>
    <section class="success">
        <div class="message">
            <h3>You have Successfully reset you password!</h3>
            <p>Return to Login Page</p>
            <a href="index.php">
                <button>
                    LOGIN
                </button>
            </a>
        </div>
    </section>
</body>
</html>