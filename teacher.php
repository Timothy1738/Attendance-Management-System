<?php
include_once 'connection.php';

include "functions.php";

session_start();

if (!isset($_SESSION['teacher_id'])) {
    header('location:login.php');
}

$teacherID = $_SESSION['teacher_id'];

function markasread($id, $update_status)
{
    global $conn;
    $sql = "UPDATE `teacher_notification` SET `status`='$update_status' WHERE `Subject_ID`='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return "success";
    } else {
        return "failure";
    }
}

if (isset($_POST['submit'])) {
    $update_status = $_POST['status'];
    $id = $_SESSION['subject_Taught'];

    $markasread = markasread($id, $update_status);

    if ($markasread == "success") {
        $message[] = "All your notifications have been marked as read!";
    } else {
        $error[]  = "SERVER ERROR!!!!!!!!!!!!!!!!!!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title>Teacher Account</title>
</head>

<body>
    <section class="teacher_acc">
        <div class="sidebar">
            <div class="identify">
                <p>AMS</p>
            </div>
            <!-- End of LOGO -->

            <nav>
                <div class="item active">
                    <a class="active" href="teacher.php">Home</a>
                </div>

                <div class="item">
                    <a href="./teacher_account/take-attendance.php">Take Attendance</a>
                </div>

                <div class="item">
                    <a href="./teacher_account/view-attendance.php">View Attendance</a>
                </div>

                <div class="item">
                    <a href="./teacher_account/absence-requests.php">Abscence Requests</a>
                </div>

                <div class="item">
                    <a href="./teacher_account/view-students.php">Students</a>
                </div>

                <div class="item">
                    <a href="./teacher_account/view-teachers.php">Teachers</a>
                </div>

                <div class="item">
                    <a href="./teacher_account/messages.php">Messages</a>
                </div>

                <div class="item">
                    <a href="./teacher_account/editcredentials.php">Edit Credentials</a>
                </div>

                <a href="logout.php">
                    <button><span class="iconify" data-icon="mingcute:power-fill"></span>Logout</button>
                </a>
            </nav>
        </div>
        <!--End of sidebar-->

        <div class="container">
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
            <div class="about_dash">
                <h1><span class="iconify" data-icon="eva:menu-2-outline"></span>Dashboard</h1>
                <h1 class="h1">Welcome Back, <span><?php echo $_SESSION['teacher_lname'] ?></span> <span class="iconify" data-icon="twemoji:waving-hand"></span></h1>
            </div>
            <div class="mid-container">
                <div class="timetable">
                    <h2>Time Table O-level</h2>
                    <table>
                        <tr>
                            <th>Day</th>
                            <th>08:00 - 10:00</th>
                            <th>11:00 - 1:00</th>
                            <th>2:00 - 4:00</th>
                            <th>4:00 - 6:00</th>
                        </tr>
                        <?php
                        $getOlevelTT = fetchOleveTimeTable();
                        foreach ($getOlevelTT as $olevel) :
                        ?>
                            <tr>
                                <td class="bold"><?php echo $olevel['Day'] ?></td>
                                <td><?php echo $olevel['subject_1'] ?></td>
                                <td><?php echo $olevel['subject_2'] ?></td>
                                <td><?php echo $olevel['subject_3'] ?></td>
                                <td><?php echo $olevel['subject_4'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    <h2>Time Table A-level</h2>
                    <table>
                        <tr>
                            <th>Day</th>
                            <th>08:00 - 10:00</th>
                            <th>11:00 - 1:00</th>
                            <th>2:00 - 4:00</th>
                            <th>4:00 - 6:00</th>
                        </tr>
                        <?php
                        $getAlevelTT = fetchAleveTimeTable();
                        foreach ($getAlevelTT as $alevel) : ?>
                            <tr>
                                <td class="bold"><?php echo $alevel['Day'] ?></td>
                                <td><?php echo $alevel['subject_1'] ?></td>
                                <td><?php echo $alevel['subject_2'] ?></td>
                                <td><?php echo $alevel['subject_3'] ?></td>
                                <td><?php echo $alevel['subject_4'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    <div class="student-count">
                        <h3>Number of Students</h3>
                        <div class="boxes">
                            <div class="box">
                                <p>s1</p>
                                <?php
                                $s1count = allStudentsFromSeniorOne();
                                $classteacherS1 = getClassTeacherSeniorOne();
                                ?>
                                <?php
                                foreach ($classteacherS1 as $s1) :
                                ?>
                                    <p><span><?php echo $s1count ?></span> Students</p>
                                    <p>Class Teacher: <span><?php echo $s1['Firstname'] . ' ' . $s1['Lastname'] ?></span></p>
                                <?php endforeach; ?>
                            </div>

                            <div class="box">
                                <p>s2</p>
                                <?php
                                $s2count = allStudentsFromSeniorTwo();
                                $classteacherS2 = getClassTeacherSeniorTwo();
                                ?>
                                <p><span><?php echo $s2count ?></span> Students</p>
                                <?php
                                foreach ($classteacherS2 as $s2) :
                                ?>
                                    <p>Class Teacher: <span><?php echo $s2['Firstname'] . ' ' . $s2['Lastname'] ?></span></p>
                                <?php endforeach; ?>
                            </div>

                            <div class="box">
                                <p>s3</p>
                                <?php
                                $s3count = allStudentsFromSeniorThree();
                                $classteacherS3 = getClassTeacherSeniorThree();
                                ?>
                                <p><span><?php echo $s3count ?></span> Students</p>
                                <?php
                                foreach ($classteacherS3 as $s3) :
                                ?>
                                    <p>Class Teacher: <span><?php echo $s3['Firstname'] . ' ' . $s3['Lastname'] ?></span></p>
                                <?php endforeach; ?>
                            </div>

                            <div class="box">
                                <p>s4</p>
                                <?php
                                $s4count = allStudentsFromSeniorFour();
                                $classteacherS4 = getClassTeacherSeniorFour();
                                ?>
                                <p><span><?php echo $s4count ?></span> Students</p>
                                <?php
                                foreach ($classteacherS4 as $s4) :
                                ?>
                                    <p>Class Teacher: <span><?php echo $s4['Firstname'] . ' ' . $s4['Lastname'] ?></span></p>
                                <?php endforeach; ?>
                            </div>

                            <div class="box">
                                <p>s5</p>
                                <?php
                                $s5count = allStudentsFromSeniorFive();
                                $classteacherS5 = getClassTeacherSeniorFive();
                                ?>
                                <p><span><?php echo $s5count ?></span> Students</p>
                                <?php
                                foreach ($classteacherS5 as $s5) :
                                ?>
                                    <p>Class Teacher: <span><?php echo $s5['Firstname'] . ' ' . $s5['Lastname'] ?></span></p>
                                <?php endforeach; ?>
                            </div>

                            <div class="box">
                                <p>s6</p>
                                <?php
                                $s6count = allStudentsFromSeniorSix();
                                $classteacherS6 = getClassTeacherSeniorSix();
                                ?>
                                <p><span><?php echo $s6count ?></span> Students</p>
                                <?php
                                foreach ($classteacherS6 as $s6) :
                                ?>
                                    <p>Class Teacher: <span><?php echo $s6['Firstname'] . ' ' . $s6['Lastname'] ?></span></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="total">
                            <?php
                            $total = totalnumberofstudents(); ?>
                            <h4>Total Student Population</h4>
                            <p><span><?php echo $total ?></span> students</p>
                        </div>
                    </div>
                </div>
                <div class="profile-area" style="margin-top: 16px;">
                    <div class="about">
                        <h3>Profile</h3>
                        <?php
                        $getTeacher = getTeacher($teacherID);
                        foreach ($getTeacher as $teacher) :
                        ?>
                            <img src="./images/<?php echo $teacher['Image'] ?>" alt="Profile Image">
                            <p class="name"><span><?php echo $teacher['Firstname'] . ' ' . $teacher['Lastname'] ?></span></p>
                            <p>Subject Taught: <span><?php echo $teacher['Subjectname'] ?></span></p>
                            <p>Contact: <span><?php echo $teacher['ContactNumber'] ?></span></p>
                            <p>Email <span><?php echo $teacher['Email'] ?></span></p>
                            <a href="./teacher_account/editprofile.php?id=<?php echo $teacher['TeacherID'] ?>&fn=<?php echo $teacher['Firstname'] ?>&ln=<?php echo $teacher['Lastname'] ?>&ct=<?php echo $teacher['ContactNumber'] ?>&em=<?php echo $teacher['Email'] ?>&im=<?php echo $teacher['Image'] ?>">
                                <button type="submit" name="edit" onclick="return confirm('Are you sure you want to edit your profile? ');">
                                    Edit Profile
                                </button>
                            </a>
                        <?php endforeach; ?>

                    </div>

                    <div class="notifications">
                        <h3 style="color: var(--color-primary);">Notifications</h3>
                        <?php

                        $subjectID = $_SESSION['subject_Taught'];
                        $bell_icons = getTeachernotification($subjectID);
                        if ($bell_icons == "empty!") { ?>
                            <div class="empty_notifications">
                                <p>Nothing to see here!</p>
                                <span class="iconify" data-icon="game-icons:binoculars"></span>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="box">
                                <?php
                                $bell_icons = getTeachernotification($subjectID);
                                foreach ($bell_icons as $icon) { ?>
                                    <p><span class="iconify" data-icon="ic:outline-notifications-active"></span>: <?php echo $icon['notification'] . ' ' . 'from' . ' ' . $icon['FirstName'] . ' ' . $icon['LastName'] ?></p>
                                <?php } ?>

                                <form action="" method="post">
                                    <div></div>
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" name="submit">Mark As Read <span class="iconify" data-icon="solar:check-read-line-duotone"></span></button>
                                </form>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include "./footer.php"; ?>

    <!--Iconify cdn--->

    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <!--main js-->
    <script src="main.js"></script>
</body>

</html>