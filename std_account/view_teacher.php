<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header('location:../index.php');
}
include "../connection.php";
include "../functions.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Teachers</title>
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
                <a href="timetable.php">Class Schedule</a>
                <a class="active" href="../std_account/view_teacher.php">View Teachers</a>
                <a href="../std_account/editacc.php">Edit Credentials</a>
                <a href="../std_account/profile.php">Profile</a>
            </div>
            <a href="../logout.php">
                <button><span class="iconify" data-icon="mingcute:power-fill"></span>Logout</button>
            </a>
        </nav>
        <!--End of Nav-bar-->

        <div class="meet_teachers">
            <h1 class="std-header">Meet Your Teachers</h1>
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
    </section>
    <?php include "../footer.php";?>
    <!--Iconify cdn--->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>