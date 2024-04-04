<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}

include "../connection.php";
include "../functions.php";

if (isset($_POST['delete'])) {
    $id = $_POST['delete_record'];
    $delete = deleteRecord($id);
    if ($delete == "success") {
        $message[] = "Record Deleted successfully!";
    } else {
        $error[] = "SERVER ERROR";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        button {
            border: none;
            background: none;
        }

        #edit {
            color: var(--color-primary);
            box-shadow: none;
            background: none;
            font-size: 2rem;
            cursor: pointer;
        }

        #delete {
            color: crimson;
            box-shadow: none;
            background: none;
            font-size: 2rem;
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="../styles.css">
    <title>View Attendance</title>
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
                    <a href="../admin.php">Dashboard</a>
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
                    <a class="active" href="View-attendance.php">Attendance</a>
                </div>

                <div class="item">
                    <a href="view-absence.php">Abscence Requests</a>
                </div>

                <div class="item">
                    <a href="notifications.php">Notifications</a>
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
            <div class="top">
                <div class="west">
                    <div class="menu-icon" id="toggle-btn">
                        <span class="iconify" data-icon="ep:menu"></span>
                    </div>
                    <div class="date">
                        <?php echo date("Y/m/d") ?>
                    </div>
                    <h3 style="margin-left: 1rem; font-size: 1.6rem; color: var(--color-primary);">Attendance</h3>
                </div>
            </div>



            <nav class="viewATTadminTab">
                <a href="../admin_account/View-attendance.php">S1</a>
                <a href="../admin_account/s2.php">S2</a>
                <a href="../admin_account/s3.php">S3</a>
                <a class="active" href="../admin_account/s4.php">S4</a>
                <a href="../admin_account/s5.php">S5</a>
                <a href="../admin_account/s6.php">S6</a>
                <a href="../admin_account/extra.php">Extra Lessons</a>
            </nav>

            <section class="adminSection" id="s4">
                <h3 style="color: var(--color-primary);">Class Attendance Senior Four</h3>
                <?php
                if (s4attendance() == false) { ?>
                    <div class="empty">
                        <p>Attendance Has not yet been recorded for this class</p>
                    </div>
                <?php } else { ?>
                    <table>
                        <tr>
                            <th>Record ID</th>
                            <th>Student</th>
                            <th>Teacher</th>
                            <th>Class</th>
                            <th>Date</th>
                            <th>Is Present</th>
                            <th>Period</th>
                            <th colspan="2">Actions</th>
                        </tr>
                        <?php
                        $attendance = s4attendance();
                        foreach ($attendance as $attend) :
                        ?>
                            <tr>
                                <td><?php echo $attend['RecordID'] ?></td>
                                <td><?php echo $attend['FirstName'] . ' ' . $attend['LastName'] ?></td>
                                <td><?php echo $attend['Firstname'] . ' ' . $attend['Lastname'] ?></td>
                                <td><?php echo $attend['ClassName'] ?></td>
                                <td><?php echo $attend['Date'] ?></td>
                                <td><?php echo $attend['IsPresent'] ?></td>
                                <td><?php echo $attend['Period'] ?></td>


                                <td>
                                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        <input type="hidden" name="delete_record" value="<?php echo $attend['RecordID']; ?>">
                                        <Button class="delete-btn" name="delete" type="submit">
                                            <span class="iconify" id="delete" data-icon="fluent:delete-24-filled"></span>
                                        </Button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php }
                ?>
            </section>
            <!--END OF SECTION-->
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