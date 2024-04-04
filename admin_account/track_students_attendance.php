<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}
include "../connection.php";
include "../functions.php";

$fname = $_GET['fn'];
$lname = $_GET['ln'];
$img = $_GET['img'];
$class = $_GET['class'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Track Attendance</title>
</head>

<body>
    <div class="track_att">
        <div class="brief-profile">
            <div class="img">
                <img src="../images/<?php echo $img?>" alt="">
                <h1 style="color: var(--color-primary);"><?php echo $fname . ' ' . $lname?></h1>
            </div>
            <h1>Class: <span style="color: var(--color-primary);"><?php echo $class?></span></h1>
        </div>
        <div class="view-activity-table">
            <h3 style="color: var(--color-primary);  margin-top: 2rem;">Normal Shedule</h3>
            <?php
            $studentID = $_GET['sid'];
            if (myAttendanceStudent($studentID) == false) { ?>
                <div class="empty">
                    <p>Student has not attended Any Lecture yet!</p>
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
                            <td><?php echo $Schedule['SubjectName']?></td>
                            <td><?php echo $Schedule['Period'] ?></td>
                            <td><?php echo $Schedule['IsPresent'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php }
            ?>

            <h3 style="color: var(--color-primary);  margin-top: 2rem;">Extra Lessons</h3>
            <?php
            $extraLessons = myAttenenceExtraLessons($studentID);
            if ($extraLessons == false) { ?>
                <div class="empty">
                    <p>Student has not attended Any Extra Lesson yet!</p>
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
</body>

</html>