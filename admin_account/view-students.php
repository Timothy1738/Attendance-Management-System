<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}

include "../connection.php";
include "../functions.php";

// Check if a delete request was submitted
if (isset($_POST['submit'])) {
    $studentID = $_POST['delete_record'];

    $deleteStudent = deleteStudentAll($studentID);
    if ($deleteStudent == "yes") {
        $message[] = "Record deleted successfully.";
    } else {
        echo "SERVER ERROR";
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

        section {
            display: none;
        }

        #s1 {
            display: block;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>View Student</title>
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
                    <a class="active" href="view-students.php">Students</a>
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
                    <a href="../admin_account/add-std.php">
                        <button>Add Student <span class="iconify" data-icon="mdi:account-add"></span></button>
                    </a>
                </div>
            </div>

            <h3 style="margin-top: 1rem; margin-bottom: 1rem; font-size: 2rem; color: var(--color-primary);">Student's Records</h3>
            <div id="nav" class="viewATTadminTab">
                <a class="active" href="#s1">S1</a>
                <a href="#s2">S2</a>
                <a href="#s3">S3</a>
                <a href="#s4">S4</a>
                <a href="#s5">S5</a>
                <a href="#s6">S6</a>
            </div>

            <section id="s1">
                <div class="content-cards">

                    <?php
                    $s1_students = getS1();
                    foreach ($s1_students as $student) { ?>
                        <div class="card">
                            <div class="img">
                                <img src="../images/<?php echo $student['image'] ?>" alt="">
                            </div>
                            <div class="bio">
                                <p>Student ID: <span><?php echo $student['StudentID'] ?></span></p>
                                <p>First Name: <span><?php echo $student['FirstName'] ?></span></p>
                                <p>Last Name: <span><?php echo $student['LastName'] ?></span></p>
                                <p>Class: <span><?php echo $student['ClassName'] ?></span></p>
                                <p>Date Of Birth: <span><?php echo $student['DateOfBirth'] ?></span></p>
                                <p>Gender: <span><?php echo $student['Gender'] ?></span></p>
                                <p>Address: <span><?php echo $student['Address'] ?></span></p>
                                <p>Contact: <span><?php echo $student['ContactNumber'] ?></span></p>
                                <p>Email: <span><?php echo $student['Email'] ?></span></p>
                                <p>Username: <span><?php echo $student['username'] ?></span></p>
                            </div>
                            <div class="actions">
                                <a href="edit-std.php?id=<?php echo $student['StudentID']; ?>&im=<?php echo $student['image'] ?>&fn=<?php echo $student['FirstName'] ?>&ln=<?php echo $student['LastName'] ?>
                            &cl=<td><?php echo $student['ClassName'] ?>&cid=<?php echo $student['ClassID'] ?>&db=<?php echo $student['DateOfBirth'] ?>&gn=<?php echo $student['Gender'] ?>
                            &ad=<?php echo $student['Address'] ?>&em=<?php echo $student['Email'] ?>&ct=<?php echo $student['ContactNumber'] ?>"><span id="iconify" class="iconify" data-icon="bx:edit"></span>
                                </a>

                                <a href="track_students_attendance.php?sid=<?php echo $student['StudentID']; ?>&fn=<?php echo $student['FirstName'] ?>&ln=<?php echo $student['LastName'] ?>&img=<?php echo $student['image'] ?>&class=<?php echo $student['ClassName'] ?>">
                                    <span id="edit" class="iconify" data-icon="vaadin:records"></span>
                                </a>

                                <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="delete_record" value="<?php echo $student['StudentID']; ?>">
                                    <Button class="delete-btn" name="submit" type="submit">
                                        <span class="iconify" data-icon="fluent:delete-24-filled"></span>
                                    </Button>
                                </form>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
            <!--s1 students-->

            <section id="s2">
                <div class="content-cards">

                    <?php
                    $s2_students = getS2();
                    foreach ($s2_students as $student) { ?>
                        <div class="card">
                            <div class="img">
                                <img src="../images/<?php echo $student['image'] ?>" alt="">
                            </div>
                            <div class="bio">
                                <p>Student ID: <span><?php echo $student['StudentID'] ?></span></p>
                                <p>First Name: <span><?php echo $student['FirstName'] ?></span></p>
                                <p>Last Name: <span><?php echo $student['LastName'] ?></span></p>
                                <p>Class: <span><?php echo $student['ClassName'] ?></span></p>
                                <p>Date Of Birth: <span><?php echo $student['DateOfBirth'] ?></span></p>
                                <p>Gender: <span><?php echo $student['Gender'] ?></span></p>
                                <p>Address: <span><?php echo $student['Address'] ?></span></p>
                                <p>Contact: <span><?php echo $student['ContactNumber'] ?></span></p>
                                <p>Email: <span><?php echo $student['Email'] ?></span></p>
                                <p>Username: <span><?php echo $student['username'] ?></span></p>
                            </div>
                            <div class="actions">
                                <a href="edit-std.php?id=<?php echo $student['StudentID']; ?>&im=<?php echo $student['image'] ?>&fn=<?php echo $student['FirstName'] ?>&ln=<?php echo $student['LastName'] ?>
                            &cl=<td><?php echo $student['ClassName'] ?>&cid=<?php echo $student['ClassID'] ?>&db=<?php echo $student['DateOfBirth'] ?>&gn=<?php echo $student['Gender'] ?>
                            &ad=<?php echo $student['Address'] ?>&em=<?php echo $student['Email'] ?>&ct=<?php echo $student['ContactNumber'] ?>"><span id="iconify" class="iconify" data-icon="bx:edit"></span>
                                </a>

                                <a href="track_students_attendance.php?sid=<?php echo $student['StudentID']; ?>&fn=<?php echo $student['FirstName'] ?>&ln=<?php echo $student['LastName'] ?>&img=<?php echo $student['image'] ?>&class=<?php echo $student['ClassName'] ?>">
                                    <span id="edit" class="iconify" data-icon="vaadin:records"></span>
                                </a>

                                <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="delete_record" value="<?php echo $student['StudentID']; ?>">
                                    <Button class="delete-btn" name="submit" type="submit">
                                        <span class="iconify" data-icon="fluent:delete-24-filled"></span>
                                    </Button>
                                </form>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
            <!--s2 students-->

            <section id="s3">
                <div class="content-cards">

                    <?php
                    $s3_students = getS3();
                    foreach ($s3_students as $student) { ?>
                        <div class="card">
                            <div class="img">
                                <img src="../images/<?php echo $student['image'] ?>" alt="">
                            </div>
                            <div class="bio">
                                <p>Student ID: <span><?php echo $student['StudentID'] ?></span></p>
                                <p>First Name: <span><?php echo $student['FirstName'] ?></span></p>
                                <p>Last Name: <span><?php echo $student['LastName'] ?></span></p>
                                <p>Class: <span><?php echo $student['ClassName'] ?></span></p>
                                <p>Date Of Birth: <span><?php echo $student['DateOfBirth'] ?></span></p>
                                <p>Gender: <span><?php echo $student['Gender'] ?></span></p>
                                <p>Address: <span><?php echo $student['Address'] ?></span></p>
                                <p>Contact: <span><?php echo $student['ContactNumber'] ?></span></p>
                                <p>Email: <span><?php echo $student['Email'] ?></span></p>
                                <p>Username: <span><?php echo $student['username'] ?></span></p>
                            </div>
                            <div class="actions">
                                <a href="edit-std.php?id=<?php echo $student['StudentID']; ?>&im=<?php echo $student['image'] ?>&fn=<?php echo $student['FirstName'] ?>&ln=<?php echo $student['LastName'] ?>
                            &cl=<td><?php echo $student['ClassName'] ?>&cid=<?php echo $student['ClassID'] ?>&db=<?php echo $student['DateOfBirth'] ?>&gn=<?php echo $student['Gender'] ?>
                            &ad=<?php echo $student['Address'] ?>&em=<?php echo $student['Email'] ?>&ct=<?php echo $student['ContactNumber'] ?>"><span id="iconify" class="iconify" data-icon="bx:edit"></span>
                                </a>

                                <a href="track_students_attendance.php?sid=<?php echo $student['StudentID']; ?>&fn=<?php echo $student['FirstName'] ?>&ln=<?php echo $student['LastName'] ?>&img=<?php echo $student['image'] ?>&class=<?php echo $student['ClassName'] ?>">
                                    <span id="edit" class="iconify" data-icon="vaadin:records"></span>
                                </a>

                                <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="delete_record" value="<?php echo $student['StudentID']; ?>">
                                    <Button class="delete-btn" name="submit" type="submit">
                                        <span class="iconify" data-icon="fluent:delete-24-filled"></span>
                                    </Button>
                                </form>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
            <!--s3 students-->

            <section id="s4">
                <div class="content-cards">

                    <?php
                    $s4_students = getS4();
                    foreach ($s4_students as $student) { ?>
                        <div class="card">
                            <div class="img">
                                <img src="../images/<?php echo $student['image'] ?>" alt="">
                            </div>
                            <div class="bio">
                                <p>Student ID: <span><?php echo $student['StudentID'] ?></span></p>
                                <p>First Name: <span><?php echo $student['FirstName'] ?></span></p>
                                <p>Last Name: <span><?php echo $student['LastName'] ?></span></p>
                                <p>Class: <span><?php echo $student['ClassName'] ?></span></p>
                                <p>Date Of Birth: <span><?php echo $student['DateOfBirth'] ?></span></p>
                                <p>Gender: <span><?php echo $student['Gender'] ?></span></p>
                                <p>Address: <span><?php echo $student['Address'] ?></span></p>
                                <p>Contact: <span><?php echo $student['ContactNumber'] ?></span></p>
                                <p>Email: <span><?php echo $student['Email'] ?></span></p>
                                <p>Username: <span><?php echo $student['username'] ?></span></p>
                            </div>
                            <div class="actions">
                                <a href="edit-std.php?id=<?php echo $student['StudentID']; ?>&im=<?php echo $student['image'] ?>&fn=<?php echo $student['FirstName'] ?>&ln=<?php echo $student['LastName'] ?>
                            &cl=<td><?php echo $student['ClassName'] ?>&cid=<?php echo $student['ClassID'] ?>&db=<?php echo $student['DateOfBirth'] ?>&gn=<?php echo $student['Gender'] ?>
                            &ad=<?php echo $student['Address'] ?>&em=<?php echo $student['Email'] ?>&ct=<?php echo $student['ContactNumber'] ?>"><span id="iconify" class="iconify" data-icon="bx:edit"></span>
                                </a>

                                <a href="track_students_attendance.php?sid=<?php echo $student['StudentID']; ?>&fn=<?php echo $student['FirstName'] ?>&ln=<?php echo $student['LastName'] ?>&img=<?php echo $student['image'] ?>&class=<?php echo $student['ClassName'] ?>">
                                    <span id="edit" class="iconify" data-icon="vaadin:records"></span>
                                </a>

                                <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="delete_record" value="<?php echo $student['StudentID']; ?>">
                                    <Button class="delete-btn" name="submit" type="submit">
                                        <span class="iconify" data-icon="fluent:delete-24-filled"></span>
                                    </Button>
                                </form>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
            <!--S4 STUDENETS-->

            <section id="s5">
                <div class="content-cards">

                    <?php
                    $s5_students = getS5();
                    foreach ($s5_students as $student) { ?>
                        <div class="card">
                            <div class="img">
                                <img src="../images/<?php echo $student['image'] ?>" alt="">
                            </div>
                            <div class="bio">
                                <p>Student ID: <span><?php echo $student['StudentID'] ?></span></p>
                                <p>First Name: <span><?php echo $student['FirstName'] ?></span></p>
                                <p>Last Name: <span><?php echo $student['LastName'] ?></span></p>
                                <p>Class: <span><?php echo $student['ClassName'] ?></span></p>
                                <p>Date Of Birth: <span><?php echo $student['DateOfBirth'] ?></span></p>
                                <p>Gender: <span><?php echo $student['Gender'] ?></span></p>
                                <p>Address: <span><?php echo $student['Address'] ?></span></p>
                                <p>Contact: <span><?php echo $student['ContactNumber'] ?></span></p>
                                <p>Email: <span><?php echo $student['Email'] ?></span></p>
                                <p>Username: <span><?php echo $student['username'] ?></span></p>
                            </div>
                            <div class="actions">
                                <a href="edit-std.php?id=<?php echo $student['StudentID']; ?>&im=<?php echo $student['image'] ?>&fn=<?php echo $student['FirstName'] ?>&ln=<?php echo $student['LastName'] ?>
                            &cl=<td><?php echo $student['ClassName'] ?>&cid=<?php echo $student['ClassID'] ?>&db=<?php echo $student['DateOfBirth'] ?>&gn=<?php echo $student['Gender'] ?>
                            &ad=<?php echo $student['Address'] ?>&em=<?php echo $student['Email'] ?>&ct=<?php echo $student['ContactNumber'] ?>"><span id="iconify" class="iconify" data-icon="bx:edit"></span>
                                </a>

                                <a href="track_students_attendance.php?sid=<?php echo $student['StudentID']; ?>&fn=<?php echo $student['FirstName'] ?>&ln=<?php echo $student['LastName'] ?>&img=<?php echo $student['image'] ?>&class=<?php echo $student['ClassName'] ?>">
                                    <span id="edit" class="iconify" data-icon="vaadin:records"></span>
                                </a>

                                <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="delete_record" value="<?php echo $student['StudentID']; ?>">
                                    <Button class="delete-btn" name="submit" type="submit">
                                        <span class="iconify" data-icon="fluent:delete-24-filled"></span>
                                    </Button>
                                </form>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>

            <!--s5 students -->

            <section id="s6">
                <div class="content-cards">

                    <?php
                    $s6_students = getS6();
                    foreach ($s6_students as $student) { ?>
                        <div class="card">
                            <div class="img">
                                <img src="../images/<?php echo $student['image'] ?>" alt="">
                            </div>
                            <div class="bio">
                                <p>Student ID: <span><?php echo $student['StudentID'] ?></span></p>
                                <p>First Name: <span><?php echo $student['FirstName'] ?></span></p>
                                <p>Last Name: <span><?php echo $student['LastName'] ?></span></p>
                                <p>Class: <span><?php echo $student['ClassName'] ?></span></p>
                                <p>Date Of Birth: <span><?php echo $student['DateOfBirth'] ?></span></p>
                                <p>Gender: <span><?php echo $student['Gender'] ?></span></p>
                                <p>Address: <span><?php echo $student['Address'] ?></span></p>
                                <p>Contact: <span><?php echo $student['ContactNumber'] ?></span></p>
                                <p>Email: <span><?php echo $student['Email'] ?></span></p>
                                <p>Username: <span><?php echo $student['username'] ?></span></p>
                            </div>
                            <div class="actions">
                                <a href="edit-std.php?id=<?php echo $student['StudentID']; ?>&im=<?php echo $student['image'] ?>&fn=<?php echo $student['FirstName'] ?>&ln=<?php echo $student['LastName'] ?>
                            &cl=<td><?php echo $student['ClassName'] ?>&cid=<?php echo $student['ClassID'] ?>&db=<?php echo $student['DateOfBirth'] ?>&gn=<?php echo $student['Gender'] ?>
                            &ad=<?php echo $student['Address'] ?>&em=<?php echo $student['Email'] ?>&ct=<?php echo $student['ContactNumber'] ?>"><span id="iconify" class="iconify" data-icon="bx:edit"></span>
                                </a>

                                <a href="track_students_attendance.php?sid=<?php echo $student['StudentID']; ?>&fn=<?php echo $student['FirstName'] ?>&ln=<?php echo $student['LastName'] ?>&img=<?php echo $student['image'] ?>&class=<?php echo $student['ClassName'] ?>">
                                    <span id="edit" class="iconify" data-icon="vaadin:records"></span>
                                </a>

                                <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="delete_record" value="<?php echo $student['StudentID']; ?>">
                                    <Button class="delete-btn" name="submit" type="submit">
                                        <span class="iconify" data-icon="fluent:delete-24-filled"></span>
                                    </Button>
                                </form>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
            <!--s6 students-->

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

        // Get all section elements
        const sections = document.querySelectorAll('section');

        // Get all navigation links
        const links = document.querySelectorAll('#nav a');

        // Add a click event listener to each navigation link
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove the active class from all links
                links.forEach(link => {
                    link.classList.remove('active');
                });

                // Add the active class to the clicked link
                this.classList.add('active');

                // Hide all sections
                sections.forEach(section => {
                    section.style.display = 'none';
                });

                // Get the target section's ID from the link's href attribute
                const targetId = this.getAttribute('href').substring(1);

                // Display the target section
                document.getElementById(targetId).style.display = 'block';
            });
        });
    </script>
</body>

</html>