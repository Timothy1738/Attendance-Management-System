<?php
session_start();
include "../connection.php";

include "../functions.php";

$logic = ""; 
$subjectID = $_SESSION['subject_Taught'];
$TeachersID = $_SESSION['teacher_id'];

if (isset($_POST['select'])) {

    $period = $_POST['period'];
    $periodOneSubject = periodOneSubject();
    $periodTwoSubject = periodTwoSubject();
    $periodThreeSubject = periodThreeSubject();
    $periodFourSubject = periodfourSubject();
    $subjectname = SubjectName($TeachersID);

    if ($period == 1) {
        if ($periodOneSubject == $subjectname) {
            $today = date('Y-m-d');
            $sql = "SELECT * FROM `attendancerecords` WHERE `Date` = '$today' AND `Period` = '$period' AND `ClassID` = 1";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "You have already recorded Attendance for today";
            } else {
                $_SESSION['period'] = $period;
                $logic = 'SET';
            }
        } else {
            $error[] = "You have no lecture in this period. Have a nice Day!";
        }
    } elseif ($period == 2) {
        if ($periodTwoSubject == $subjectname) {
            $today = date('Y-m-d');
            $sql = "SELECT * FROM `attendancerecords` WHERE `Date` = '$today' AND `Period` = '$period' AND `ClassID` = 1";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "You have already recorded Attendance for today";
            } else {
                $_SESSION['period'] = $period;
                $logic = 'SET';
            }
        } else {
            $error[] = "You have no lecture in this period. Have a nice Day!";
        }
    } elseif ($period == 3) {
        if ($periodThreeSubject == $subjectname) {
            $today = date('Y-m-d');
            $sql = "SELECT * FROM `attendancerecords` WHERE `Date` = '$today' AND `Period` = '$period' AND `ClassID` = 1";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "You have already recorded Attendance for today";
            } else {
                $_SESSION['period'] = $period;
                $logic = 'SET';
            }
        } else {
            $error[] = "You have no lecture in this period. Have a nice Day!";
        }
    } else {
        if ($periodFourSubject == $subjectname) {
            $today = date('Y-m-d');
            $sql = "SELECT * FROM `attendancerecords` WHERE `Date` = '$today' AND `Period` = '$period' AND `ClassID` = 1";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "You have already recorded Attendance for today";
            } else {
                $_SESSION['period'] = $period;
                $logic = 'SET';
            }
        } else {
            $error[] = "You have no lecture in this period. Have a nice Day!";
        }
    }
}

if (isset($_SESSION['period'])) {
    if (isset($_POST['submit'])) {
       
        foreach ($_POST['attendance'] as $student_id => $attendance_data) {

            $date = date('Y-m-d');

            $time = $_SESSION['period'];

            $teacherID = $_SESSION['teacher_id'];

            $subject_id = $_POST['sid'];

            // Get the class_id for the student from the hidden input
            $class_id = $_POST['class_id'][$student_id];

            // If the 'absent' checkbox is checked, set $absent to 'absent'
            $absent = isset($attendance_data['absent']) ? 'absent' : '';

            // If the 'present' checkbox is checked, set $present to 'present'
            $present = isset($attendance_data['present']) ? 'present' : '';

            $sql = "INSERT INTO `attendancerecords`(`StudentID`, `TeacherID`, `SubjectID`, `ClassID`, `Date`, `IsPresent`, `Period`) 
            VALUES ('$student_id','$teacherID','$subject_id','$class_id','$date','$absent $present','$time')";

            $result = mysqli_query($conn, $sql);
        }
        if ($result) {
            // Successfully inserted attendance record
            $message[] = "Attendance Captured Successfully";

            $fname = $_SESSION['teacher_fname'];
            $lname = $_SESSION['teacher_lname'];
            $admin_msg = "Teacher" . ' ' . $fname . ' ' . $lname . ' ' . "has taken attendance for Class S1";
            $admin_state = 0;
            
            $insert_Att_Alert = insert_adminNotification_teacher_takeAtt($admin_msg, $admin_state, $TeachersID);
            
        } else {
            // Handle any errors
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
    <title>Take Attendance</title>
</head>

<body>
    <section class="teacher_acc">
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
            <h1 class="std-header">Take Attendance</h1>
            <div class="viewATTadminTab">
                <h3 style="color: var(--color-white);">Select Class</h3>
                <a class="active" href="../teacher_account/take-attendance.php">s1</a>
                <a href="../teacher_account/s2.php">s2</a>
                <a href="../teacher_account/s3.php">s3</a>
                <a href="../teacher_account/s4.php">s4</a>
                <a href="../teacher_account/s5.php">s5</a>
                <a href="../teacher_account/s6.php">s6</a>
                <a href="../teacher_account/extraLessons.php">Extra Lessons</a>
            </div>

            <div class="select-period">
                <form action="" method="POST">
                    <select name="period" id="">
                        <option value="">Select Period</option>
                        <option value="1">Period 1</option>
                        <option value="2">Period 2</option>
                        <option value="3">Period 3</option>
                        <option value="4">Period 4</option>
                    </select>
                    <input type="submit" value="Select Period" name="select">
                </form>
            </div>
            <div class="attendance-tables">
                <?php
                if (!empty($logic)) {
                    $gets1 = getS1(); ?>
                    <form action="" id="attendanceForm" method="post">
                        <table>
                            <tr>
                                <th>Student Name</th> 
                                <th>Class</th>
                                <th colspan="2">Actions</th>
                            </tr>
                            <?php
                            foreach ($gets1 as $s1) : ?>
                                <tr>
                                    <td><?php echo $s1['FirstName'] . ' ' . $s1['LastName'] ?></td>
                                    <td><?php echo $s1['ClassName'] ?></td>
                                    <td class="present"><input type="checkbox" name="attendance[<?= $s1['StudentID'] ?>][present]" value="Present"> Present</td>
                                    <td class="absent"><input type="checkbox" name="attendance[<?= $s1['StudentID'] ?>][absent]" value="Absent"> Absent</td>
                                    <input type="hidden" name="class_id[<?= $s1['StudentID'] ?>]" value="<?= $s1['ClassID'] ?>">
                                    <input type="hidden" name="sid" value="<?= $_SESSION['subject_Taught']?>">
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <input type="submit" class="submit" value="Submit Attendance" name="submit">
                    </form>
                <?php } else { ?>
                    <div class="empty">
                        <p>Select a period!</p>
                    </div>
                <?php } ?>
            </div>
        </div> 
    </section>
    <?php include "../footer.php";?>

    <!--Iconify cdn--->
    <script src="../main.js"></script>

    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="../main.js"></script>
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