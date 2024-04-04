<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}

include "../connection.php";

include "../functions.php";
// Database connection code

if (isset($_POST['delete'])) {
    $teacherID = $_POST['delete_record'];
    if (deleteTeacherAll($teacherID) == "yes") {
        $message[] = "Record Deleted Successfully!";
    } else {
        $error[] = "Server Error! Try Again!";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        .delete-btn {
            background: none;
            border: none;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>View Teacher</title>
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
                    <a class="active" href="view-teacher.php">Teachers</a>
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
                </div>

                <div class="right">
                    <a href="../admin_account/add-tr.php">
                        <button>Add Teacher <span class="iconify" data-icon="mdi:account-add"></span></button>
                    </a>
                </div>
            </div>
            
            <h3 style="margin-top: 1rem; margin-bottom: 1rem; font-size: 2rem; color: var(--color-primary);">Teacher's Records</h3>
            <div class="content-cards">

                <?php
                $all_teachers = get_teachers();
                foreach ($all_teachers as $teacher) { ?>
                    <div class="card">
                        <div class="img">
                            <img src="../images/<?php echo $teacher['Image'] ?>" alt="">
                        </div>
                        <div class="bio">
                            <p>Teacher ID: <span><?php echo $teacher['TeacherID'] ?></span></p>
                            <p>First Name: <span><?php echo $teacher['Firstname'] ?></span></p>
                            <p>Last Name: <span><?php echo $teacher['Lastname'] ?></span></p>
                            <p>Contact: <span><?php echo $teacher['ContactNumber'] ?></span></p>
                            <p>Email: <span><?php echo $teacher['Email'] ?></span></p>
                            <p>Subject Taught: <span><?php echo $teacher['Subjectname'] ?></span></p>
                            <p>Username: <span><?php echo $teacher['username'] ?></span></p>
                            <p>Password: <span><?php echo $teacher['password'] ?></span></p>
                        </div>
                        <div class="actions">
                            <a href="edit-tr.php?id=<?php echo $teacher['TeacherID']; ?>&fn=<?php echo $teacher['Firstname'] ?>&ln=<?php echo $teacher['Lastname'] ?>&im=<?php echo $teacher['Image'] ?>
                                &em=<?php echo $teacher['Email'] ?>&sid=<?php echo $teacher['SubjectID'] ?>&tel=<?php echo $teacher['ContactNumber'] ?>&sb=<?php echo $teacher['Subjectname'] ?>"><span id="iconify" class="iconify" data-icon="bx:edit"></span>
                            </a>

                            <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record? This Action is irreversible');">
                                <input type="hidden" name="delete_record" value="<?php echo $teacher['TeacherID']; ?>">
                                <Button class="delete-btn" name="delete" type="submit">
                                    <span class="iconify" data-icon="fluent:delete-24-filled"></span>
                                </Button>
                            </form>

                        </div>
                    </div>
                <?php } ?>
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