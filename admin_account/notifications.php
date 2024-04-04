<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}

include "../connection.php";
include "../functions.php";

if(isset($_POST['delete'])) {
    $recordID = $_POST['delete_record'];
    $delete = delete_notification($recordID);
    if($delete == "Deleted Successfully!") {
        $message[] = "Notification Deleted Successfully!";
    }else {
        $error[] = "SERVER ERROR!!!!!!!!!!!!!!!!!!!!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        button{
            background: none;
        }
    </style>
    <link rel="stylesheet" href="../styles.css">
    <title>Notifications</title>
</head>

<body>
    <div class="view-activity">
        <div class="sidebar" id="side-bar">
            <div class="identify">
                <p>AMS</p>
            </div>
            <!-- End of LOGO -->
            <nav>
                <div class="item">
                    <a href="../admin.php">Dasboard</a>
                </div>

                <div class="item">
                    <a href="view-students.php">Students</a>
                </div>

                <div class="item">
                    <a href="view-teacher.php">Teachers</a>
                </div>

                <div class="item">
                    <a href="view-classes.php">Classes</a>
                </div>

                <div class="item">
                    <a href="subjects.php">Subjects</a>
                </div>

                <div class="item">
                    <a href="timetable.php">Class Schedule</a>
                </div>


                <div class="item">
                    <a href="View-attendance.php">Attendance</a>
                </div>

                <div class="item">
                    <a href="view-absence.php">Abscence Requests</a>
                </div>

                <div class="item">
                    <a class="active" href="notifications.php">Notifications</a>
                </div>

                <div class="item">
                    <a href="view_admin.php">My profile</a>
                </div>

                <a href="../logout.php">
                    <button><span class="iconify" data-icon="mingcute:power-fill"></span>Logout</button>
                </a>
            </nav>
        </div>
        <!-- End of sidebar -->

        <div class="container">
            <div class="top">
                <div class="west">
                    <div class="menu-icon" id="toggle-btn">
                        <span class="iconify" data-icon="ep:menu"></span>
                    </div>
                    <div class="date">
                        <?php echo date("Y/m/d") ?>
                    </div>
                </div>
            </div>
            <div class="view-activity-table">
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
                <h3 style="margin-top: 1rem; margin-bottom: 1rem; font-size: 2rem; color: var(--color-primary);">Read Notifications</h3>
                <?php
                if (get_Read_Notifications() == "No Notifications Yet!") {
                    echo "<div class=empty>";
                    echo "<p>No notifications Yet!</p>";
                    echo "</div>";
                } else { ?>
                    <table>
                        <tr>
                            <th>Message</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        $notifications = get_Read_Notifications();
                        foreach ($notifications as $notify) { ?>
                            <tr>
                                <td><?php echo $notify['message'] ?></td>

                                <td>
                                    <form action="" method="post" onsubmit="return confirm('Are You sure you want to delete this record? Please not that his action is Irreversible!')">
                                        <input type="hidden" name="delete_record" value="<?php echo $notify['record_id']; ?>">
                                        <Button class="delete-btn" name="delete" type="submit">
                                            <span class="iconify" data-icon="fluent:delete-24-filled"></span>
                                        </Button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </table><?php }
                            ?>
            </div>
        </div>
    </div>
    <?php include "../footer.php"; ?>
    <!--ICONIFY CDN-->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <script src="../main.js"></script>

    <!--DOCUMENT JS-->
    <script>
        // Select the button and the item to display
        const showButton = document.getElementById('toggle-btn');
        const itemToDisplay = document.getElementById('side-bar');

        // Add a click event listener to the button
        showButton.addEventListener('click', function() {
            itemToDisplay.classList.toggle('active');
        });
    </script>
</body>

</html>