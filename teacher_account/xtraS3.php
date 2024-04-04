<?php
session_start();
include "../connection.php";
include "../functions.php";

$subjectID = $_SESSION['subject_Taught'];
$TeachersID = $_SESSION['teacher_id'];
$empty = "";
if (isset($_POST['select'])) {
    $subject = $_POST['subject'];
    if ($subjectID == $subject) {
        $_SESSION['subject'] = $subject;
        $empty = 'SET';
    }else {
        $error[] = "Select the subject that you teach!";
    }
}

if (isset($_SESSION['subject'])) {
    if (isset($_POST['submit'])) {

        foreach ($_POST['attendance'] as $student_id => $attendance_data) {

            $subjectID = $_SESSION['subject'];

            $teacherID = $_SESSION['teacher_id'];

            $class_id = $_POST['class_id'][$student_id];

            $absent = isset($attendance_data['absent']) ? 'absent' : '';

            $present = isset($attendance_data['present']) ? 'present' : '';

            $sql = "INSERT INTO `attendanceoverrides`(`OverrideDate`, `IsPresent`, `StudentID`, `TeacherID`, `SubjectID`, `Time`, `ClassID`) 
            VALUES (now(), '$absent $present', '$student_id', '$teacherID', '$subjectID',NOW(), '$class_id')";
            $result = mysqli_query($conn, $sql);
        }

        if ($result) {
            $message[] = "Attendance Captured Successfully";

            $fname = $_SESSION['teacher_fname'];
            $lname = $_SESSION['teacher_lname'];
            $admin_msg = "Teacher" . ' ' . $fname . ' ' . $lname . ' ' . "has taken attendance, Extra Lesson for Class S3";
            $admin_state = 0;

            $insert_Att_Alert = insert_adminNotification_teacher_takeAtt($admin_msg, $admin_state, $TeachersID);
        } else {
            $error[] = "Failed to Record Attendance " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Extra Lessons</title>
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
                    <a class="active" href="../teacher_account/take-attendance.php">Take Attendance</a>
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

            <h2 style="color: var(--color-primary);">Extra Lessons</h2>
            <nav class="viewATTadminTab">
                <h3 style="color: var(--color-white);">Select Class</h3>
                <a href="../teacher_account/extraLessons.php">s1</a>
                <a href="../teacher_account/xtraS2.php">s2</a>
                <a class="active" href="../teacher_account/xtraS3.php">s3</a>
                <a href="../teacher_account/xtraS4.php">s4</a>
                <a href="../teacher_account/xtraS5.php">s5</a>
                <a href="../teacher_account/xtraS6.php">s6</a>
            </nav>
            <div class="select-period">
                <form method="POST">
                    <select name="subject" id="">
                        <option value="">Select Subject</option>
                        <option value="1">Mathematics</option>
                        <option value="2">Physics</option>
                        <option value="3">Chemistry</option>
                        <option value="4">Geography</option>
                        <option value="5">Biology</option>
                        <option value="6">History</option>
                        <option value="7">English</option>
                        <option value="8">Agriculture</option>
                        <option value="9">Commerce</option>
                        <option value="10">CRE</option>
                        <option value="11">ICT</option>
                        <option value="12">Fine Art</option>
                        <option value="13">Literature</option>
                        <option value="14">Enterpreneurship</option>
                    </select>
                    <input type="submit" value="Select Subject" name="select">
                </form>
            </div>

            <div class="attendance-tables">
                <?php
                if (!empty($empty)) {
                    $gets3 = getS3(); ?>
                    <form action="" id="attendanceForm" method="post">
                        <table>
                            <tr>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th colspan="2">Actions</th>
                            </tr>
                            <?php
                            foreach ($gets3 as $s3) : ?>
                                <tr>
                                    <td><?php echo $s3['FirstName'] . ' ' . $s3['LastName'] ?></td>

                                    <td><?php echo $s3['ClassName'] ?></td>

                                    <td class="present"><input type="checkbox" name="attendance[<?= $s3['StudentID'] ?>][present]" value="Present"> Present</td>

                                    <td class="absent"><input type="checkbox" name="attendance[<?= $s3['StudentID'] ?>][absent]" value="Absent"> Absent </td>

                                    <input type="hidden" name="class_id[<?= $s3['StudentID'] ?>]" value="<?= $s3['ClassID'] ?>">
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <input type="submit" class="submit" value="Submit Attendance" name="submit">
                    </form>
                <?php } else { ?>
                    <div class="empty">
                        <p>Please First select a subject</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php include "../footer.php";?>
    <script>
        document.getElementById('attendanceForm').addEventListener('submit', function(event) {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name^="attendance["]');
            let errorDetected = false;

            checkboxes.forEach(function(checkbox) {
                const studentID = checkbox.name.match(/\[(\d+)\]/)[1];
                const studentCheckboxes = document.querySelectorAll(`input[type="checkbox"][name^="attendance[${studentID}]"]`);

                let isStudentChecked = false;

                studentCheckboxes.forEach(function(studentCheckbox) {
                    if (studentCheckbox.checked) {
                        isStudentChecked = true;
                    }
                });

                if (!isStudentChecked) {
                    alert(`Please check at least one checkbox for Student ID ${studentID}.`);
                    errorDetected = true;
                }
            });

            if (errorDetected) {
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>
</body>

</html>