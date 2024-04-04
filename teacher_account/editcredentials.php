<?php

session_start();

include "../connection.php";

include "../functions.php";

$TeachersID = $_SESSION['teacher_id'];

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $newPass = $_POST['password'];
    $teacherID = $_SESSION['teacher_id'];
    $email = "";

    $hashedpass = md5($newPass);

    $checkifExists = checkIfUsernameExistsInAllTables($username, $email);

    if ($checkifExists == "Proceed") {
        $sql =  "UPDATE `teachers` SET `password`='$hashedpass',`username`='$username' WHERE `teacherID` = '$teacherID'";
        $result = mysqli_query($conn, $sql);

        if ($result) {

            $message[] = "User crediential changed Successfully";
            $fname = $_SESSION['teacher_fname'];
            $lname = $_SESSION['teacher_lname'];
            $admin_msg = "Teacher" . ' ' . $fname . ' ' . $lname . ' ' . "has changed username and password!";
            $admin_state = 0;

            $insert_Att_Alert = insert_adminNotification_teacher_takeAtt($admin_msg, $admin_state, $TeachersID);
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
    <section class="teacher_acc">
        <div class="sidebar">
            <div class="identify">
                <p>AMS</p>
            </div>
            <!-- End of LOGO -->

            <nav>
                <div class="item">
                    <a href="../teacher.php">Home</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/take-attendance.php">Take Attendance</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/view-attendance.php">View Attendance</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/absence-requests.php">Absence Requests</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/view-students.php">Students</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/view-teachers.php">Teachers</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/messages.php">Messages</a>
                </div>

                <div class="item">
                    <a class="active" href="../teacher_account/editcredentials.php">Edit Credentials</a>
                </div>

                <a href="../logout.php">
                    <button><span class="iconify" data-icon="mingcute:power-fill"></span>Logout</button>
                </a>
            </nav>
        </div>
        <!--End of sidebar-->

        <div class="container">
            <div class="editacc">
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg msg">' . $error . '</span>';
                    };
                };
                if (isset($message)) {
                    foreach ($message as $message) {
                        echo '<span class="success-msg msg">' . $message . '</span>';
                    };
                };
                ?>
                <h2>Edit Your Login Credentials</h2>
                <form action="" method="post">
                    <input type="text" name="username" placeholder="New Username" required>
                    <input type="password" name="password" placeholder="New Password" required>
                    <input type="submit" name="submit" value="Edit Credentials">
                </form>
            </div>
        </div>
    </section>
    <?php include "../footer.php"; ?>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script>
        function removeErrorMessage() {
            var Message = document.querySelector('.msg');
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