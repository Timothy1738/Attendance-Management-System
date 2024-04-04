<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}
include "../functions.php";
include "../connection.php";

if (isset($_POST['delete'])) {
    $subject_name = $_POST['sub_name'];
    $subject_id = $_POST['sub_id'];

    $delete = eradicateSubjectFromSystem($subject_id, $subject_name);
    if($delete == true) {
        $message[] = "Subject Deleted Successfully!";
    }else {
        $error[] = "Server Error!";
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
    <title>Subjects</title>
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
                    <a href="../admin_account/view-students.php">Students</a>
                </div>

                <div class="item">
                    <a href="../admin_account/view-teacher.php">Teachers</a>
                </div>

                <div class="item">
                    <a href="../admin_account/view-classes.php">Classes</a>
                </div>

                <div class="item">
                    <a class="active" href="subjects.php">Subjects</a>
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
                    <a href="notifications.php">Notifications</a>
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
                    <a href="add-subject.php">
                        <button>Add Subject<span class="iconify" data-icon="mdi:account-add"></span></button>
                    </a>
                </div>
            </div>

            <h1 style="color: var(--color-primary); margin-top: 2rem;">Subjects</h1>
            <div class="view-activity-table">
                <table>
                    <tr>
                        <th>SubjectID</th>
                        <th>Subject Name</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    <?php
                    $getSubjects = fetchSubjects();
                    foreach ($getSubjects as $subject) :
                    ?>
                        <tr>
                            <td><?php echo $subject['SubjectID'] ?></td>
                            <td><?php echo $subject['Subjectname'] ?></td>
                            <td>
                                <a href="edit-subject.php?id=<?php echo $subject['SubjectID'] ?>&name=<?php echo $subject['Subjectname'] ?>">
                                    <span id="iconify" class="iconify" data-icon="bx:edit"></span>
                                </a>
                            </td>
                            <td>
                                <form action="subjects.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record? Please not that this action is irreversible!!')">
                                    <input type="hidden" name="sub_name" value="<?php echo $subject['Subjectname'] ?>">
                                    <input type="hidden" name="sub_id" value="<?php echo $subject['SubjectID'] ?>">
                                    <button type="submit" class="delete-btn" name="delete">
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