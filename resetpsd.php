<?php
include "connection.php";

session_start();

$role = $_SESSION['role'];
$email = $_SESSION['email'];

if (isset($_POST['change'])) {

    $createpassword = $_POST['new_password'];
    $confirmpassword = $_POST['confirm_password'];

    if ($createpassword === $confirmpassword) {

        $hashedpass = md5($confirmpassword);

        switch ($role) {
            case "students":
                $query = "UPDATE `students` SET `password` = '$hashedpass' WHERE `Email` = '$email'";
                break;
            case "admin":
                $query = "UPDATE `admin` SET `password` = '$hashedpass' WHERE `Email` = '$email'";
                break;
            case "teachers":
                $query = "UPDATE `teachers` SET `password` = '$hashedpass' WHERE `Email` = '$email'";
                break;
                // Add additional cases for other roles if needed
        }
        $result = $conn->query($query);
        if ($result) {
            // Password reset successful, redirect to login page
            
            header("Location: index.php?message=" . "You have successfully reset your password!");
            exit();
        } else {
            // Password reset failed
            $error[] = "Password reset failed. Please try again.";
        }
    } else {
        $error[] = "Passswords entered do not match";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
    <link rel="stylesheet" href="./styles.css">
</head>

<body>
    <section class="editpsd">
        <!--LOGO & HEADER-->
        <div class="form">
            <div class="header">
                <div class="logo">
                    <h4>AMS</h4>
                </div>
                <h2>ATTENDANCE MANAGEMENT SYSTEM</h2>
            </div>
            <div class="edit">
                <h3>Enter New Password</h3>
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg">' . $error . '</span>';
                    }
                }
                ?>
                <form method="POST">
                    <input type="password" name="new_password" id="new_password" placeholder="Create password" required>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confrim password" required>
                    <input type="submit" name="change" value="Change Password">
                </form>
            </div>
        </div>
    </section>
    <script src="main.js"></script>
    <!--ICONIFY JS-->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</body>

</html>