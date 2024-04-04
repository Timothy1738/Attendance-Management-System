<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header('location:../index.php');
}
include "../connection.php";

include "../functions.php";

$studentID = $_SESSION['student_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Profile</title>
</head>

<body>
    <div class="student_acc">
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
                <a href="../std_account/editacc.php">Edit Credentials</a>
                <a class="active" href="../std_account/profile.php">Profile</a>
            </div>
            <a href="../logout.php">
                <button><span class="iconify" data-icon="mingcute:power-fill"></span>Logout</button>
            </a>
        </nav>
        <div class="bio">
            <?php

            $profile = fetchStudentProfile($studentID);
            foreach ($profile as $prof) :

            ?>
                <div class="bio-card">
                    <div class="left">
                        <img src="../images/<?php echo $prof['image'] ?>" alt="Profile">
                        <p class="highlight"><?php echo $prof['FirstName'] . ' ' . $prof['LastName'] ?></p>
                    </div>
                    <hr class="line">
                    <div class="right">
                        <h3>Bio</h3>
                        <p>Class: <span><?php echo $prof['ClassName'] ?></span></p>
                        <p>Date Of Birth: <span><?php echo $prof['DateOfBirth'] ?></span></p>
                        <P>Gender: <span><?php echo $prof['Gender'] ?></span></p>
                        <p>Address: <span><?php echo $prof['Address'] ?></span></p>
                        <p>Contact <span><?php echo $prof['ContactNumber'] ?></span></p>
                        <p>Email: <span><?php echo $prof['Email'] ?></span></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include "../footer.php";?>
    <!--Iconify cdn--->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>