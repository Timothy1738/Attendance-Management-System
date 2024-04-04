<?php
session_start();
include_once 'connection.php';

include "functions.php";

$class = $_SESSION['class_id'];
$studentID = $_SESSION['student_id'];

if (!isset($_SESSION['student_id'])) {
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title>My Account</title>
</head>

<body>
    <section class="student_acc">
        <nav class="std_nav">
            <div class="logo">
                <p>AMS</p>
            </div>
            <div class="nav-links">
                <a class="active" href="student.php">Home</a>
                <a href="./std_account/absence_request.php">Absence Request</a>
                <a href="./std_account/my-attendance.php">My Attendance</a>
                <a href="./std_account/timetable.php">Class Schedule</a>
                <a href="./std_account/view_teacher.php">View Teachers</a>
                <a href="./std_account/editacc.php">Edit Credentials</a>
                <a href="./std_account/profile.php">Profile</a>
            </div>
            <a href="logout.php">
                <button><span class="iconify" data-icon="mingcute:power-fill"></span>Logout</button>
            </a>
        </nav>
        <!--End of Nav-bar-->

        <div id="home" class="content">
            <div class="container">
                <div class="top">
                    <div class="heading">
                        <h1>Attendance Today</h1>
                        <div class="date">
                            <?php echo date("d/m/Y") ?>
                        </div>

                        <div class="day">
                            <p>
                                Its a <span><?php
                                            $currentDay = date('l');
                                            echo $currentDay;
                                            ?></span>
                            </p>
                        </div>
                    </div>

                    <div class="about">
                        <p>
                            Hi <span><?php echo $_SESSION['student_fname'] . ' ' . $_SESSION['student_lname'] ?></span>
                        </p>
                        <?php

                        $getstudents = fetchStudentProfile($studentID);
                        foreach ($getstudents as $student) { ?>
                            <div class="profile">
                                <img src="./images/<?php echo $student['image'] ?>" alt="Profile Picture">
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php

                if ($class >= 1 && $class <= 4) {
                    $schedule = getSchedule();
                    if (is_array($schedule)) {
                ?>
                        <table class="att_td">
                            <tr>
                                <th>Time</th>
                                <th>Subject</th>
                                <th>Status</th>
                            </tr>

                            <tr>
                                <td>08:00 - 10:00</td>
                                <td><?php echo $schedule['subject_1'] ?></td>
                                <?php

                                $period1 = Period1();

                                if ($period1 == "No Entry Yet") {
                                    echo '<td class="pending">';
                                    echo 'Pending';
                                    echo '</td>';
                                } else {
                                    echo '<td class="ispresent">';
                                    echo $period1;
                                    echo '</td>';
                                }

                                ?>
                            </tr>


                            <tr>
                                <td>11:00 - 13:00</td>
                                <td><?php echo $schedule['subject_2'] ?></td>

                                <?php
                                $period2 = Period2();


                                if ($period2 == "No Entry Yet") {
                                    echo '<td class="pending">';
                                    echo 'Pending';
                                    echo '</td>';
                                } else {
                                    echo '<td class="ispresent">';
                                    echo $period2;
                                    echo '</td>';
                                }
                                ?>
                            </tr>

                            <tr>
                                <td>14:00 - 16:00</td>
                                <td><?php echo $schedule['subject_3'] ?></td>
                                <?php
                                $period3 = Period3();
                                if (!is_array($period3)) {
                                    echo '<td class="pending">';
                                    echo 'Pending';
                                    echo '</td>';
                                } else {
                                    echo '<td class="ispresent">';
                                    echo $period3['IsPresent'];
                                    echo '</td>';
                                }
                                ?>
                            </tr>

                            <tr>
                                <td>16:00 - 18:00</td>
                                <td><?php echo $schedule['subject_4'] ?></td>

                                <?php
                                $period4 = Period4();
                                if (!is_array($period4)) {
                                    echo '<td class="pending">';
                                    echo 'Pending';
                                    echo '</td>';
                                } else {
                                    echo '<td class="ispresent">';
                                    echo $period4['IsPresent'];
                                    echo '</td>';
                                }
                                ?>
                            </tr>
                        </table>
                    <?php } else { ?>
                        <div class="empty">
                            <p>It's A Weekend <iconify-icon class="iconify" icon="fluent-emoji-flat:partying-face"></iconify-icon></p>
                        </div>
                    <?php }
                } else {
                    $Alevel = getscheduleAlevel();
                    if (is_array($Alevel)) { ?>
                        <table class="att_td">
                            <tr>
                                <th>Time</th>
                                <th>Subject</th>
                                <th>Status</th>
                            </tr>

                            <tr>
                                <td>08:00 - 10:00</td>
                                <td><?php echo $Alevel['subject_1'] ?></td>
                                <?php
                                $period1 = Period1();
                                if ($period1 == "No Entry Yet") {
                                    echo '<td class="pending">';
                                    echo 'Pending';
                                    echo '</td>';
                                } else {
                                    // echo "IsPresent value: " . $period1['IsPresent'] . "<br>";
                                    echo '<td class="ispresent">';
                                    echo $period1;
                                    echo '</td>';
                                }
                                ?>
                            </tr>


                            <tr>
                                <td>11:00 - 13:00</td>
                                <td><?php echo $Alevel['subject_2'] ?></td>

                                <?php
                                $period2 = Period2();
                                if ($period2 == "No Entry Yet") {
                                    echo '<td class="pending">';
                                    echo 'Pending';
                                    echo '</td>';
                                } else {
                                    echo '<td class="ispresent">';
                                    echo $period2;
                                    echo '</td>';
                                }
                                ?>
                            </tr>

                            <tr>
                                <td>14:00 - 16:00</td>
                                <td><?php echo $Alevel['subject_3'] ?></td>
                                <?php
                                $period3 = Period3();
                                if (!is_array($period3)) {
                                    echo '<td class="pending">';
                                    echo 'Pending';
                                    echo '</td>';
                                } else {
                                    echo '<td class="ispresent">';
                                    echo $period3['IsPresent'];
                                    echo '</td>';
                                }
                                ?>
                            </tr>

                            <tr>
                                <td>16:00 - 18:00</td>
                                <td><?php echo $Alevel['subject_4'] ?></td>

                                <?php
                                $period4 = Period4();
                                if (!is_array($period4)) {
                                    echo '<td class="pending">';
                                    echo 'Pending';
                                    echo '</td>';
                                } else {
                                    echo '<td class="ispresent">';
                                    echo $period4['IsPresent'];
                                    echo '</td>';
                                }
                                ?>
                            </tr>
                        </table>
                    <?php } else { ?>
                        <div class="empty">
                            <p>It's A Weekend <iconify-icon class="iconify" icon="fluent-emoji-flat:partying-face"></iconify-icon></p>
                        </div>
                <?php }
                } ?>
            </div>
            <div class="mess_side_bar">
                <h2>Messages From Teacher</h2>
                <div class="messages">
                    <?php
                    $getnotifications = getMessages();
                    if (count($getnotifications) > 0) {
                        foreach ($getnotifications as $notification) :
                    ?>
                            <div class="message-card">
                                <div class="top">
                                    <div class="cred">
                                        <img src="./images/<?php echo $notification['Image'] ?>" alt="teacher">
                                        <p><?php echo $notification['Firstname'] . ' ' . $notification['Lastname'] ?></p>
                                    </div>
                                    <!-- <form action="" method="post">
                                        <input type="hidden" value="1">
                                        <button type="submit" name="done">Mark As Read</button>
                                    </form> -->
                                </div>
                                <div class="mid">
                                    <p>Date: <span><?php echo $notification['Date'] ?></span></p>
                                    <p>Time: <span><?php echo $notification['Time'] ?></span></p>
                                </div>
                                <div class="msg-body">
                                    <?php echo $notification['Message'] ?>
                                </div>
                            </div>
                            <!--END OF CARD-1-->
                        <?php endforeach;
                    } else { ?>
                        <div class="empty">
                            <p>No messages yet! <iconify-icon class="iconify" icon="tabler:mood-empty"></iconify-icon></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php include "./footer.php"; ?>
    <!--Iconify cdn--->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <!--main js-->
    <script src="./main.js"></script>
</body>

</html>