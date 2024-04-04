<?php
session_start();
include "../connection.php";
include "../functions.php";


// var_dump(callstudents());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        section {
            display: none;
        }

        #s1 {
            display: block;
        }
    </style>
    <link rel="stylesheet" href="../styles.css">
    <title>View Studets</title>
</head>

<body>
    <div class="teacher_acc">
        <div class="sidebar">
            <div class="identify">
                <p>AMS</p>
            </div>
            <!-- End of LOGO -->

            <nav>
                <div class="item active">
                    <a href="../teacher.php">Home</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/take-attendance.php">Take Attendance</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/view-attendance.php">View Attendance</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/absence-requests.php">Absence Requests</a>
                </div>

                <div class="item">
                    <a class="active" href="../teacher_account/view-students.php">Students</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/view-teachers.php">Teachers</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/messages.php">Messages</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/editcredentials.php">Edit Credentials</a>
                </div>

                <a href="../logout.php">
                    <button><span class="iconify" data-icon="mingcute:power-fill"></span>Logout</button>
                </a>
            </nav>
        </div>
        <!--End of sidebar-->

        <div class="container">
            <h1 class="std-header">Students</h1>
            <div id="nav" class="viewATTadminTab">
                <a class="active" href="#s1">S1</a>
                <a href="#s2">S2</a>
                <a href="#s3">S3</a>
                <a href="#s4">S4</a>
                <a href="#s5">S5</a>
                <a href="#s6">S6</a>
            </div>



            <section id="s1">
                <div class="view-child">
                    <?php
                    $std = getS1();
                    foreach ($std as $stds) { ?>
                        <div class="child-card">
                            <div class="top">
                                <img src="../images/<?php echo $stds['image'] ?>" alt="studentprofileimg">
                            </div>
                            <div class="bottom">
                                <p>Name: <span><?php echo $stds['FirstName'] . ' ' . $stds['LastName'] ?></span></p>
                                <p>Class: <span><?php echo $stds['ClassName'] ?></span></p>
                                <p>DOB: <span><?php echo $stds['DateOfBirth'] ?></span></p>
                                <P>Gender: <span><?php echo $stds['Gender'] ?></span></P>
                                <p>Address: <span><?php echo $stds['Address'] ?></span></p>
                                <p>Contact: <span><?php echo $stds['ContactNumber'] ?></span></p>
                                <p>Email: <span><?php echo $stds['Email'] ?></span></p>
                            </div>

                            <div class="action">
                                <a href="track_students_attendance.php?sid=<?php echo $stds['StudentID']; ?>&fn=<?php echo $stds['FirstName'] ?>&ln=<?php echo $stds['LastName'] ?>&img=<?php echo $stds['image'] ?>&class=<?php echo $stds['ClassName'] ?>">
                                    <button>Track Attendance</button>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                    <!--END OF CARD-->
                </div>
            </section>


            <section id="s2">
                <div class="view-child">
                    <?php
                    $std2 = getS2();
                    foreach ($std2 as $stds2) { ?>
                        <div class="child-card">
                            <div class="top">
                                <img src="../images/<?php echo $stds2['image'] ?>" alt="studentprofileimg">
                            </div>
                            <div class="bottom">
                                <p>Name: <span><?php echo $stds2['FirstName'] . ' ' . $stds2['LastName'] ?></span></p>
                                <p>Class: <span><?php echo $stds2['ClassName'] ?></span></p>
                                <p>DOB: <span><?php echo $stds2['DateOfBirth'] ?></span></p>
                                <P>Gender: <span><?php echo $stds2['Gender'] ?></span></P>
                                <p>Address: <span><?php echo $stds2['Address'] ?></span></p>
                                <p>Contact: <span><?php echo $stds2['ContactNumber'] ?></span></p>
                                <p>Email: <span><?php echo $stds2['Email'] ?></span></p>
                            </div>

                            <div class="action">
                                <a href="track_students_attendance.php?sid=<?php echo $stds2['StudentID']; ?>&fn=<?php echo $stds2['FirstName'] ?>&ln=<?php echo $stds2['LastName'] ?>&img=<?php echo $stds2['image'] ?>&class=<?php echo $stds2['ClassName'] ?>">
                                    <button>Track Attendance</button>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                    <!--END OF CARD-->
                </div>
            </section>

            <section id="s3">
                <div class="view-child">
                    <?php
                    $std3 = getS3();
                    foreach ($std3 as $stds3) { ?>
                        <div class="child-card">
                            <div class="top">
                                <img src="../images/<?php echo $stds3['image'] ?>" alt="studentprofileimg">
                            </div>
                            <div class="bottom">
                                <p>Name: <span><?php echo $stds3['FirstName'] . ' ' . $stds3['LastName'] ?></span></p>
                                <p>Class: <span><?php echo $stds3['ClassName'] ?></span></p>
                                <p>DOB: <span><?php echo $stds3['DateOfBirth'] ?></span></p>
                                <P>Gender: <span><?php echo $stds3['Gender'] ?></span></P>
                                <p>Address: <span><?php echo $stds3['Address'] ?></span></p>
                                <p>Contact: <span><?php echo $stds3['ContactNumber'] ?></span></p>
                                <p>Email: <span><?php echo $stds3['Email'] ?></span></p>
                            </div>

                            <div class="action">
                                <a href="track_students_attendance.php?sid=<?php echo $stds3['StudentID']; ?>&fn=<?php echo $stds3['FirstName'] ?>&ln=<?php echo $stds3['LastName'] ?>&img=<?php echo $stds3['image'] ?>&class=<?php echo $stds3['ClassName'] ?>">
                                    <button>Track Attendance</button>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                    <!--END OF CARD-->
                </div>
            </section>

            <section id="s4">
                <div class="view-child">
                    <?php
                    $std4 = getS4();
                    foreach ($std4 as $stds4) { ?>
                        <div class="child-card">
                            <div class="top">
                                <img src="../images/<?php echo $stds4['image'] ?>" alt="studentprofileimg">
                            </div>
                            <div class="bottom">
                                <p>Name: <span><?php echo $stds4['FirstName'] . ' ' . $stds4['LastName'] ?></span></p>
                                <p>Class: <span><?php echo $stds4['ClassName'] ?></span></p>
                                <p>DOB: <span><?php echo $stds4['DateOfBirth'] ?></span></p>
                                <P>Gender: <span><?php echo $stds4['Gender'] ?></span></P>
                                <p>Address: <span><?php echo $stds4['Address'] ?></span></p>
                                <p>Contact: <span><?php echo $stds4['ContactNumber'] ?></span></p>
                                <p>Email: <span><?php echo $stds4['Email'] ?></span></p>
                            </div>

                            <div class="action">
                                <a href="track_students_attendance.php?sid=<?php echo $stds4['StudentID']; ?>&fn=<?php echo $stds4['FirstName'] ?>&ln=<?php echo $stds4['LastName'] ?>&img=<?php echo $stds4['image'] ?>&class=<?php echo $stds4['ClassName'] ?>">
                                    <button>Track Attendance</button>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                    <!--END OF CARD-->
                </div>
            </section>

            <section id="s5">
                <div class="view-child">
                    <?php
                    $std5 = getS5();
                    foreach ($std5 as $stds5) { ?>
                        <div class="child-card">
                            <div class="top">
                                <img src="../images/<?php echo $stds5['image'] ?>" alt="studentprofileimg">
                            </div>
                            <div class="bottom">
                                <p>Name: <span><?php echo $stds5['FirstName'] . ' ' . $stds5['LastName'] ?></span></p>
                                <p>Class: <span><?php echo $stds5['ClassName'] ?></span></p>
                                <p>DOB: <span><?php echo $stds5['DateOfBirth'] ?></span></p>
                                <P>Gender: <span><?php echo $stds5['Gender'] ?></span></P>
                                <p>Address: <span><?php echo $stds5['Address'] ?></span></p>
                                <p>Contact: <span><?php echo $stds5['ContactNumber'] ?></span></p>
                                <p>Email: <span><?php echo $stds5['Email'] ?></span></p>
                            </div>

                            <div class="action">
                                <a href="track_students_attendance.php?sid=<?php echo $stds5['StudentID']; ?>&fn=<?php echo $stds5['FirstName'] ?>&ln=<?php echo $stds5['LastName'] ?>&img=<?php echo $stds5['image'] ?>&class=<?php echo $stds5['ClassName'] ?>">
                                    <button>Track Attendance</button>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                    <!--END OF CARD-->
                </div>
            </section>

            <section id="s6">
                <div class="view-child">
                    <?php
                    $std6 = getS6();
                    foreach ($std6 as $stds6) { ?>
                        <div class="child-card">
                            <div class="top">
                                <img src="../images/<?php echo $stds6['image'] ?>" alt="studentprofileimg">
                            </div>
                            <div class="bottom">
                                <p>Name: <span><?php echo $stds6['FirstName'] . ' ' . $stds6['LastName'] ?></span></p>
                                <p>Class: <span><?php echo $stds6['ClassName'] ?></span></p>
                                <p>DOB: <span><?php echo $stds6['DateOfBirth'] ?></span></p>
                                <P>Gender: <span><?php echo $stds6['Gender'] ?></span></P>
                                <p>Address: <span><?php echo $stds6['Address'] ?></span></p>
                                <p>Contact: <span><?php echo $stds6['ContactNumber'] ?></span></p>
                                <p>Email: <span><?php echo $stds6['Email'] ?></span></p>
                            </div>

                            <div class="action">
                                <a href="track_students_attendance.php?sid=<?php echo $stds6['StudentID']; ?>&fn=<?php echo $stds6['FirstName'] ?>&ln=<?php echo $stds6['LastName'] ?>&img=<?php echo $stds6['image'] ?>&class=<?php echo $stds6['ClassName'] ?>">
                                    <button>Track Attendance</button>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                    <!--END OF CARD-->
                </div>
            </section>
        </div>
    </div>
    <?php include "../footer.php"; ?>
    <script defer src="../main.js"></script>
    <script>
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