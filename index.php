<?php
session_start();

if (!empty($_SESSION["user_role"])) {
    if ($_SESSION["user_role"] == 'students') {
        header('location: student.php');
    } elseif ($_SESSION["user_role"] == 'teachers') {
        header('location: teacher.php');
    } else {
        header('location: admin.php');
    }
}

include "connection.php";

function login($username, $password)
{

    global $conn;
    $role = "";
    $tables = ["students", "admin", "teachers"];
    foreach ($tables as $table) {
        $query = "SELECT * FROM $table WHERE username = '$username'";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $role = $table;
            break;
        }
    }

    if ($role !== "") {
        // User exists, now verify the password
        $hashedPassword = md5($password);
        $query = "SELECT * FROM $role WHERE username = '$username' AND password = '$hashedPassword'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            // Authentication successful, set session variables
            $row = mysqli_fetch_array($result);
            $_SESSION["user_role"] = $role;


            // Redirect based on role
            switch ($role) {
                case "students":
                    $_SESSION['student_id'] = $row['StudentID'];
                    $_SESSION['class_id'] = $row['ClassID'];
                    $_SESSION['student_fname'] = $row['FirstName'];
                    $_SESSION['student_lname'] = $row['LastName'];
                    header("Location: student.php");
                    break;
                case "admin":
                    $_SESSION['admin_id'] = $row['AdminID'];
                    $_SESSION['admin_fname'] = $row['Firstname'];
                    $_SESSION['admin_lname'] = $row['Lastname'];
                    header("Location: admin.php");
                    break;
                case "teachers":
                    $_SESSION['teacher_id'] = $row['TeacherID'];
                    $_SESSION['teacher_fname'] = $row['Firstname'];
                    $_SESSION['teacher_lname'] = $row['Lastname'];
                    $_SESSION['subject_Taught'] = $row['SubjectID'];
                    header("Location: teacher.php");
                    break;
                default:
                    // Handle an invalid role here
                    break;
            }
            exit();
        } else {
            // Invalid password
            return "Invalid password. Please try again.";
        }
    } else {
        // User does not exist
        return "User with this username does not exist.";
    }
}

if (isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $login = login($username, $password);

    if ($login == "Invalid password. Please try again.") {
        $error[] = "Invalid password. Please try again.";
    } elseif ($login == "User with this username does not exist.") {
        $error[] = "User with this username does not exist.";
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
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <section class="login">
        <div class="form">
            <div class="header">
                <div class="logo">
                    <h4>AMS</h4>
                </div>
                <h2>ATTENDANCE MANAGEMENT SYSTEM</h2>
            </div>
            <!--LOGO-->

            <div class="login-form">
                <h3>Login Using Your Username and Password</h3>
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg">' . $error . '</span>';
                    };
                };

                if(isset($_GET["message"])) {
                    echo '<span class="success-msg">' . $_GET['message'] . '</span>';
                }
                ?>
                <form method="POST">
                    <input type="text" placeholder="Enter Your Username" name="username" required>
                    <input type="password" placeholder="Enter Your Password" name="password" required>
                    <a href="emailvalidate">Forgot Password</a>
                    <input type="submit" name="login" value="Login">
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