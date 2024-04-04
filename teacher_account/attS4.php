<?php
session_start();
include "../connection.php";
include "../functions.php";
$teacherID = $_SESSION['teacher_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        button {
            border: none;
            background: none;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Attendance S4</title>
</head>

<body>
    <div class="teacher_acc">
        <div class="sidebar">
            <div class="identify">
                <p>AMS</p>
            </div>
            <!-- End of LOGO -->

            <nav>
                <div class="item active">
                    <a href="../teacher.php">Home</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/take-attendance.php">Take Attendance</a>
                </div>

                <div class="item">
                    <a class="active" href="../teacher_account/view-attendance.php">View Attendance</a>
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
                    <a href="../teacher_account/editcredentials.php">Edit Credentials</a>
                </div>

                <a href="../logout.php">
                    <button><span class="iconify" data-icon="mingcute:power-fill"></span>Logout</button>
                </a>
            </nav>
        </div>
        <!--End of sidebar-->

        <div class="container">
            <div class="view-att-top">
                <h1 class="std-header">Attendance Records</h1>
                <a href="../teacher_account/take-attendance.php">Take Attendance</a>
            </div>

            <div class="viewATTadminTab">
                <a href="../teacher_account/view-attendance.php">S1</a>
                <a href="../teacher_account/attS2.php">S2</a>
                <a href="../teacher_account/attS3.php">S3</a>
                <a class="active" href="../teacher_account/attS4.php">S4</a>
                <a href="../teacher_account/attS5.php">S5</a>
                <a href="../teacher_account/attS6.php">S6</a>
                <a href="../teacher_account/attExtraLessons.php">Extra Lessons</a>
            </div>

            <?php
            $getAttendance = getAttendanceRecordsS4($teacherID);
            if ($getAttendance == false) { ?>
                <div class="empty">
                    <p>You have not recorded Attendance for this class yet!</p>
                </div>
            <?php } else { ?>
                <table class="view-att-table">
                    <tr>
                        <th>Student</th>
                        <th>Teacher</th>
                        <th>Subject</th>
                        <th>Class</th>
                        <th>Date</th>
                        <th>Is Present</th>
                        <th>Period</th>
                        <th>Edit</th>
                    </tr>
                    <?php

                    foreach ($getAttendance as $attendance) :
                    ?>
                        <tr>
                            <td><?php echo $attendance['FirstName'] . ' ' . $attendance['LastName'] ?></td>
                            <td><?php echo $attendance['Firstname'] . ' ' . $attendance['Lastname'] ?></td>
                            <td><?php echo $attendance['SubjectName']?></td>
                            <td><?php echo $attendance['ClassName'] ?></td>
                            <td><?php echo $attendance['Date'] ?></td>
                            <td><?php echo $attendance['IsPresent'] ?></td>
                            <td><?php echo $attendance['Period'] ?></td>
                            <td>
                                <form action="../teacher_account/edit.php?fn=<?= $attendance['FirstName']?>&ln=<?= $attendance['LastName']?>" method="post">
                                    <input type="hidden" name="recordID" value="<?php echo $attendance['RecordID'] ?>">
                                    <button type="submit" name="submit" onclick="return confirm('Are you sure you want to edit this record?');">
                                        <span id="iconify" class="iconify" data-icon="bx:edit"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php } ?>
        </div>
    </div>
    <?php include "../footer.php"; ?>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</body>

</html>