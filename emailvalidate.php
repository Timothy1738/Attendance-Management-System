<?php
include "connection.php";
session_start();



if (isset($_POST['proceed'])) {
    $email = $_POST["email"];

    // Check if the email exists in any of the tables
    // Determine the user's role based on the table
    $role = "";
    $tables = ["students", "admin", "teachers"];
    foreach ($tables as $table) {
        $query = "SELECT * FROM $table WHERE Email = '$email'";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $role = $table;
            break;
        }
    }

    if ($role !== "") {
        $query = "SELECT * FROM $role WHERE email = '$email'";
        $res = mysqli_query($conn, $query);

        if (mysqli_num_rows($res) == 1) {
            $row = mysqli_fetch_array($res);
            $_SESSION['email'] = $row['Email'];
            $_SESSION['role'] = $role;
            header("Location: resetpsd.php");
        }
    } else {
        // Email not found in any table
        $error[] = "Email not found. Please try again.";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title>Validate Email</title>
</head>

<body>
    <section class="validate-email">
        <div class="form">
            <div class="header">
                <div class="logo">
                    <h4>AMS</h4>
                </div>
                <h2>ATTENDANCE MANAGEMENT SYSTEM</h2>
            </div>
            <!--LOGO-->
            <div class="validate">
                <h3>Validate Your Email</h3>
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg">' . $error . '</span>';
                    }
                }
                ?>
                <form method="POST">
                    <input type="email" placeholder="Enter Your Email" name="email" id="email" required>
                    <input type="submit" name="proceed" value="Proceed">
                    <a class="return_to_login" href="index.php">Return To Login</a>
                </form>
            </div>
        </div>
    </section>
    <script src="main.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</body>

</html>