<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header('location:../index.php');
}
include "../connection.php";

include "../functions.php";



if (isset($_POST['edit'])) {
    $username = $_POST['username'];
    $newpassword = $_POST['password'];
    $studentID = $_SESSION['student_id'];
    $email = "";

    $fname = $_SESSION['student_fname'];
    $lname = $_SESSION['student_lname'];

    $admin_text = "Student" . ' ' . $fname . ' ' . $lname . ' ' . "just changed password and username!";
    $admin_status = 0;

    $insertNotification = insert_adminNotification_std_pass_change($admin_text, $admin_status, $studentID);


    $checkifExists = checkIfUsernameExistsInAllTables($username, $email);

    if ($checkifExists == "Proceed") {

        $hashedpass = md5($newpassword);

        $sql = "UPDATE `students` SET `password`='$hashedpass',`username`='$username' WHERE `StudentID` = '$studentID'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $message[] = "User Credentials Changed Successfully";
        }
    }else {
        $error[] = "Username Already taken!";
    }

    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Edit Credentials</title>
</head>

<body>
    <section class="student_acc">
        <nav class="std_nav">
            <div class="logo">
                <p>AMS</p>
            </div>
            <div class="nav-links">
                <a href="../student.php">Home</a>
                <a href="../std_account/absence_request.php">Absence Request</a>
                <a href="../std_account/my-attendance.php">My Attendance</a>
                <a href="timetable.php">Class Schedule</a>
                <a href="../std_account/view_teacher.php">View Teachers</a>
                <a class="active" href="../std_account/editacc.php">Edit Credentials</a>
                <a href="../std_account/profile.php">Profile</a>
            </div>
            <a href="../logout.php">
                <button><span class="iconify" data-icon="mingcute:power-fill"></span>Logout</button>
            </a>
        </nav>
        <!--End of Nav-bar-->

        <div class="editacc">
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                };
            };
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<span class="success-msg">' . $message . '</span>';
                };
            };
            ?>
            <h2>Edit Your Login Credentials</h2>
            <form action="" method="post">
                <input type="text" placeholder="New Username" name="username" required>
                <input type="password" placeholder="New Password" name="password" required>
                <input type="submit" value="Edit Credentials" name="edit" name="edit">
            </form>
        </div>
    </section>
    <?php include "../footer.php"; ?>
    <!--Iconify cdn--->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <script>
        function removeErrorMessage() {
            var Message = document.querySelector('.success-msg');
            if (Message) {
                setTimeout(function() {
                    Message.style.display = 'none';
                }, 3000); // 3000 milliseconds (3 seconds)
            }
        }

        // Call the function when the page loads
        window.onload = removeErrorMessage;
    </script>
</body>

</html>