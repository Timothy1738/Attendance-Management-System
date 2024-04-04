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
    <title>My Attendance</title>
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
                <a class="active" href="../std_account/my-attendance.php">My Attendance</a>
                <a href="timetable.php">Class Schedule</a>
                <a href="../std_account/view_teacher.php">View Teachers</a>
                <a href="../std_account/editacc.php">Edit Credentials</a>
                <a href="../std_account/profile.php">Profile</a>
            </div>
            <a href="../logout.php">
                <button><span class="iconify" data-icon="mingcute:power-fill"></span>Logout</button>
            </a>
        </nav>
        <!--End of Nav-bar-->
        <div class="my-attendance">
            <div class="tables">
                <h3>Normal Schedule</h3>
                <?php
                if (myAttendanceStudent($studentID) == false) { ?>
                    <div class="empty">
                        <p>You Have not had Any lesson yet!</p>
                    </div>
                <?php } else { ?>
                    <table>
                        <tr>
                            <th>Date</th>
                            <th>Teacher That Took Attendance</th>
                            <th>Subject</th>
                            <th>Period</th>
                            <th>Status</th>
                        </tr>

                        <?php
                        $normalSchedule = myAttendanceStudent($studentID);
                        foreach ($normalSchedule as $Schedule) :
                        ?>
                            <tr>
                                <td><?php echo $Schedule['Date'] ?></td>
                                <td><?php echo $Schedule['Firstname'] . ' ' . $Schedule['Lastname'] ?></td>
                                <td><?php echo$Schedule['SubjectName']?></td>
                                <td><?php echo $Schedule['Period'] ?></td>
                                <td><?php echo $Schedule['IsPresent'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php }
                ?>
            </div>
            <div class="tables">
                <h3>Extra Lessons</h3>
                <?php
                $extraLessons = myAttenenceExtraLessons($studentID);
                if ($extraLessons == false) { ?>
                    <div class="empty">
                        <p>You have not had Any Extra Lessons!</p>
                    </div>
                <?php } else { ?>
                    <table>
                        <tr>
                            <th>Date</th>
                            <th>Subject</th>
                            <th>Teacher That Took Attendance</th>
                            <th>Status</th>
                        </tr>


                        <?php

                        foreach ($extraLessons as $lesson) :
                        ?>
                            <tr>
                                <td><?php echo $lesson['OverrideDate'] ?></td>
                                <td><?php echo $lesson['SubjectName'] ?></td>
                                <td><?php echo $lesson['Firstname'] . ' ' . $lesson['Lastname'] ?></td>
                                <td><?php echo $lesson['IsPresent'] ?></td>
                            </tr>
                    <?php endforeach;
                    } ?>
                    </table>
            </div>
        </div>
    </section>
    <?php include "../footer.php";?>
    <!--Iconify cdn--->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>