<?php
session_start();
include "../connection.php";
include "../functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>View Teachers</title>
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
                    <a href="../teacher_account/view-students.php">Students</a>
                </div>

                <div class="item">
                    <a class="active" href="../teacher_account/view-teachers.php">Teachers</a>
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
            <h1 class="std-header">Teachers</h1>
            <div class="teacher_cards">
                <?php
                $teachers = get_teachers();
                foreach ($teachers as $teacher) {
                ?>
                    <div class="teacher_card">
                        <div class="top">
                            <img src="../images/<?php echo $teacher['Image'] ?>" alt="Teacher">
                            <div class="name">
                                <h3 class="teacher_name"><?php echo $teacher['Firstname'] . ' ' . $teacher['Lastname'] ?></h3>
                                <h4>Subject Taught: <span><?php echo $teacher['Subjectname'] ?></span></h4>
                            </div>
                        </div>
                        <div class="bottom">
                            <div class="phone">
                                <iconify-icon class="iconify" icon="mdi:phone"></iconify-icon>
                                <p><?php echo $teacher['ContactNumber'] ?></p>
                            </div>
                            
                            <div class="email">
                                <iconify-icon class="iconify" icon="material-symbols:stacked-email"></iconify-icon>
                                <p><?php echo $teacher['Email'] ?></p>
                            </div>
                        </div>
                    </div>
                    <!--END OF TEACHER CARD-->
                <?php }
                ?>

            </div>
        </div>
    </div>
    <?php include "../footer.php";?>
    <!-- ICONIFY CDN -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>