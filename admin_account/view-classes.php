<?php

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}

include "../connection.php";

include "../functions.php";


// Check if a delete request was submitted
if (isset($_POST['delete_record'])) {
    $classID = $_POST['delete_record'];

    if (deleteClass($classID) == true) {
        $message[] = "Record Deleted Successfully!";
    } else {
        $error[] = "SERVER ERROR, PLEASE TRY AGAIN!";
    }
}

$all_classes = get_classes();
function get_classes()
{
    global $conn;
    $sql = "SELECT * FROM `classes`";
    $res = mysqli_query($conn, $sql);

    $class_data = array();
    while ($row = mysqli_fetch_array($res)) {
        array_push($class_data, $row);
    }
    return $class_data;
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
    <title>View Classes</title>
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
                    <a class="active" href="view-classes.php">Classes</a>
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
                    <a href="../admin_account/add-class.php">
                        <button>Add Class <span class="iconify" data-icon="mdi:account-add"></span></button>
                    </a>
                </div>
            </div>
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
            <div class="student-count">
                        <h1 style="color: var(--color-primary);">Classes</h1>
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
                    </div>
            <div class="view-activity-table">
            
                <table>

                    <tr>
                        <th>Class ID</th>
                        <th>Class Name</th>
                        <th>Year</th>
                        <th>Class TeacherID</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    <?php foreach ($all_classes as $class) { ?>
                        <tr>
                            <td><?php echo $class['ClassID'] ?></td>
                            <td><?php echo $class['ClassName'] ?></td>
                            <td><?php echo $class['Year'] ?></td>
                            <td><?php echo $class['ClassTeacherID'] ?></td>
                            <td><a href="edit-class.php?id=<?php echo $class['ClassID']; ?>&cn=<?php echo $class['ClassName'] ?>&yr=<?php echo $class['Year'] ?>&ctid=<?php echo $class['ClassTeacherID'] ?>"><span id="iconify" class="iconify" data-icon="bx:edit"></span></a></td>
                            <td>
                                <form action="" method="post" onsubmit="return confirm('Are You sure you want to delete this Record? Please Note that this Action is irreversible!')">
                                    <input type="hidden" name="delete_record" value="<?php echo $class['ClassID']; ?>">
                                    <Button class="delete-btn" type="submit">
                                        <span class="iconify" data-icon="fluent:delete-24-filled"></span>
                                    </Button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
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