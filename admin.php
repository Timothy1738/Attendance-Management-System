<?php

include 'connection.php';
include "functions.php";

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location:index.php');
}

$AdminID = $_SESSION['admin_id'];

$admin = getAdminProfile($AdminID);

function markAsRead($status)
{
    global $conn;
    $sql = "UPDATE `admin_notification` SET `status`='$status' WHERE `status`= 0 ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "Success";
    } else {
        return "Failure";
    }
}

if (isset($_POST['mark_as_read'])) {
    $status = $_POST['status'];

    $update = markAsRead($status);
    if ($update == "Success") {
        $message[] = "Your Messages have been Marked As read!";
    } else {
        $error[] = "Failed to Update message status";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="./newcss.css">
    <title>Admin Account</title>
</head>

<body>
    <div class="admin_acc">
        <div class="sidebar" id="side-bar">
            <div class="identify">
                <p>AMS</p>
            </div>
            <!-- End of LOGO -->
            <nav>
                <div class="item">
                    <a class="active" href="admin.php">Dashboard</a>
                </div>

                <div class="item">
                    <a href="./admin_account/view-students.php">Students</a>
                </div>

                <div class="item">
                    <a href="./admin_account/view-teacher.php">Teachers</a>
                </div>

                <div class="item">
                    <a href="./admin_account/view-classes.php">Classes</a>
                </div>

                <div class="item">
                    <a href="./admin_account/subjects.php">Subjects</a>
                </div>

                <div class="item">
                    <a href="./admin_account/timetable.php">Class Schedule</a>
                </div>

                <div class="item">
                    <a href="./admin_account/View-attendance.php">Attendance</a>
                </div>

                <div class="item">
                    <a href="./admin_account/view-absence.php">Abscence Requests</a>
                </div>

                <div class="item">
                    <a href="./admin_account/notifications.php">Notifications</a>
                </div>

                <div class="item">
                    <a href="./admin_account/view_admin.php">My Profile</a>
                </div>

                <a href="logout.php">
                    <button><span class="iconify" data-icon="mingcute:power-fill"></span>Logout</button>
                </a>
            </nav>
        </div>
        <!-- End of sidebar -->

        <div class="admin_container">
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
            <header>
                <div class="small-box">
                    <span class="iconify" data-icon="eva:menu-2-outline"></span>
                    <h3>Dashboard</h3>
                </div>
                <div class="info-box">
                    <p><?php echo date('Y-m-d') ?></p>
                    <div class="img">
                        <img src="./images/<?php echo $admin['image']; ?>" alt="profile_img">
                    </div>
                </div>
            </header>

            <div class="welcome">
                <h1>Welcome back <span><?php echo $_SESSION['admin_lname']; ?></span></h1>
                <span class="iconify" data-icon="twemoji:waving-hand"></span>
            </div>

            <div class="analytics">
                <h3>Analytics</h3>
                <div class="cards">
                    <?php $studentcount = count(fetchStudents()); ?>
                    <div class="card">
                        <div class="word-piece">
                            <h4>Total Number of Students</h4>
                        </div>
                        <div class="stats">
                            <span><?php echo $studentcount ?></span>
                        </div>
                    </div>
                    <!--END OF CARD-->

                    <div class="card">
                        <div class="word-piece">
                            <h4>Total Number of Teachers</h4>
                        </div>
                        <?php $teacher_count = count(get_teachers()); ?>
                        <div class="stats">
                            <span><?php echo $teacher_count ?></span>
                        </div>
                    </div>
                    <!--END OF CARD-->

                    <div class="card">
                        <div class="word-piece">
                            <h4>Total Number of Users</h4>
                        </div>
                        <?php
                        $total = $studentcount + $teacher_count; ?>
                        <div class="stats">
                            <span><?php echo $total ?></span>
                        </div>
                    </div>
                    <!--END OF CARD-->
                </div>

                <div class="info-area">
                    <div class="calender" id='calendar'></div>
                    <div class="notifications">
                        <div class="notify">
                            <h3>Notifications <span class="iconify" data-icon="ic:outline-notifications-active"></span></span></h3>
                        </div>

                        <?php
                        $notifications = getNotifications();
                        if (!is_array($notifications)) { ?>
                            <div class="empty_notifications">
                                <p>Nothing to see here!</p>
                                <span class="iconify" data-icon="game-icons:binoculars"></span>
                            </div>
                        <?php } else { ?>
                            <div class="notification_area">

                                <div class="notification_box">
                                    <?php
                                    $admin_notify = getNotifications();
                                    foreach ($admin_notify as $notification) :
                                    ?>
                                        <p><?php echo $notification['message'] ?></p>
                                    <?php endforeach; ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" name="mark_as_read">Mark As Read <span class="iconify" data-icon="solar:check-read-line-duotone"></span></button>
                                    </form>
                                </div>
                            </div>
                        <?php }
                        ?>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <?php include "footer.php"; ?>

    <script src="main.js"></script>
    <!--ICONIFY SCRIPT-->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar')
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            })
            calendar.render()
        })
    </script>

</body>

</html>