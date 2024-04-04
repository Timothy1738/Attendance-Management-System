<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}
include "../functions.php";
include "../connection.php";

if (isset($_POST['Alevel_delete'])) {
    $record_id = $_POST['record_id'];
    $deletethis_Alevel = deleteAlevelschedule($record_id);

    if ($deletethis_Alevel == true) {
        $message[] = "Record Deleted Successfully!";
    } else {
        $error[] = "SERVER ERROR!";
    }
}
if (isset($_POST['0level_delete'])) {
    $record_id = $_POST['record_id'];
    $deletethis_Olevel = deleteOlevelschedule($record_id);

    if ($deletethis_Olevel == true) {
        $message[] = "Record Deleted Successfully!";
    } else {
        $error[] = "SERVER ERROR!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .delete-btn {
            background: none;
            border: none;
        }
    </style>
    <link rel="stylesheet" href="../styles.css">
    <title>Time Table</title>
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
                    <a class="active" href="timetable.php">Class Schedule</a>
                </div>

                <div class="item">
                    <a href="View-attendance.php">Attendance</a>
                </div>

                <div class="item">
                    <a href="notifications.php">Notifications</a>
                </div>

                <div class="item">
                    <a href="view-absence.php">Abscence Requests</a>
                </div>

                <div class="item">
                    <a href="view_admin.php">My Profile</a>
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
                </div>

                <div class="right">
                    <a href="add_schedule.php">
                        <button>Add Schedule <span class="iconify" data-icon="mdi:account-add"></span></button>
                    </a>
                </div>
            </div>

            <h3 style="margin-top: 1rem; margin-bottom: 1rem; font-size: 2rem; color: var(--color-primary);">Class Schedule</h3>
            <div class="view-activity-table">
                <h3 style="color: var(--color-primary); font-size: 1.3rem;">
                    Ordinary Level Schedule
                </h3>
                <table>
                    <tr>
                        <th>Day</th>
                        <th>08:00 - 10:00</th>
                        <th>11:00 - 13:00</th>
                        <th>14:00 - 16:00</th>
                        <th>16:00 - 18:00</th>
                        <th colspan="2">Actions</th>
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
                            <td>
                                <a href="edit-scheduleOlevel.php?id=<?= $olevel['ID']; ?>&p1=<?= $olevel['subject_1']; ?>
                                &p2=<?= $olevel['subject_2'] ?>&p3=<?= $olevel['subject_3'] ?>&p4=<?= $olevel['subject_4'] ?>&day=<?= $olevel['Day'] ?>">
                                    <span id="iconify" class="iconify" data-icon="bx:edit"></span>
                                </a>
                            </td>
                            <td>
                                <form action="timetable.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record? This Action is irreversible!')">
                                    <input type="hidden" name="record_id" value="<?php echo $olevel['ID'] ?>">
                                    <button type="submit" class="delete-btn" name="0level_delete">
                                        <span class="iconify" data-icon="fluent:delete-24-filled"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <h3 style="color: var(--color-primary); font-size: 1.3rem; margin-top: 5rem;">Advanced LeveL Schedule</h3>
                <table>
                    <tr>
                        <th>Day</th>
                        <th>08:00 - 10:00</th>
                        <th>11:00 - 13:00</th>
                        <th>14:00 - 16:00</th>
                        <th>16:00 - 18:00</th>
                        <th colspan="2">Actions</th>
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
                            <td>
                                <a href="edit-scheduleAlevel.php?id=<?= $alevel['ID']; ?>&p1=<?= $alevel['subject_1']; ?>
                                &p2=<?= $alevel['subject_2'] ?>&p3=<?= $alevel['subject_3'] ?>&p4=<?= $alevel['subject_4'] ?>&day=<?= $alevel['Day'] ?>">
                                    <span id="iconify" class="iconify" data-icon="bx:edit"></span>
                                </a>
                            </td>
                            <td>
                                <form action="timetable.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record? This Action is irreversible!')">
                                    <input type="hidden" name="record_id" value="<?php echo $alevel['ID'] ?>">
                                    <button type="submit" class="delete-btn" name="Alevel_delete">
                                        <span class="iconify" data-icon="fluent:delete-24-filled"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    <?php include "../footer.php"; ?>
    <!--ICONIFY CDN-->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
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