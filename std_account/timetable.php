<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header('location:../index.php');
}
include "../functions.php";
include "../connection.php";
$classID = $_SESSION['class_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Class Schedule</title>
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
                <a href="../std_account/my-attendance.php">My Attendance</a>
                <a href="timetable.php" class="active">Class Schedule</a>
                <a href="../std_account/view_teacher.php">View Teachers</a>
                <a href="../std_account/editacc.php">Edit Credentials</a>
                <a href="../std_account/profile.php">Profile</a>
            </div>
            <a href="../logout.php">
                <button><span class="iconify" data-icon="mingcute:power-fill"></span>Logout</button>
            </a>
        </nav>

        <div class="timetable">
            <h1 class="std-header">Class Schedule</h1>
            <div class="dash">
                <div class="tables">
                    <?php
                    if ($classID >= 1 && $classID <= 4) { ?>
                        <h3 style="color: var(--color-primary); margin: 1rem 0 1rem;">Time table</h3>
                        <table>
                            <tr>
                                <th>Day</th>
                                <th>08:00 - 10:00</th>
                                <th>11:00 - 13:00</th>
                                <th>14:00 - 16:00</th>
                                <th>16:00 - 18:00</th>
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
                    <?php } else { ?>
                        <h3 style="color: var(--color-primary); margin: 1rem 0 1rem;">Time table</h3>
                        <table>
                            <tr>
                                <th>Day</th>
                                <th>08:00 - 10:00</th>
                                <th>11:00 - 13:00</th>
                                <th>14:00 - 16:00</th>
                                <th>16:00 - 18:00</th>
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
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php include "../footer.php"; ?>
</body>

</html>