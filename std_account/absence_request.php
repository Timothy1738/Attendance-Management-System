<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header('location:../index.php');
}
$studentID = $_SESSION['student_id'];
include "../connection.php";

//GET ABSENCE REQUESTS SUBMITTED BY STUDENT
function get_reasons($studentID)
{
    global $conn;
    $sql = "SELECT * FROM `absencerequests` WHERE `StudentID` = '$studentID' AND `status` = 'Pending'";
    $res = mysqli_query($conn, $sql);

    $std_data = array();
    while ($row = mysqli_fetch_array($res)) {
        array_push($std_data, $row);
    }
    return $std_data;
}


//GET ABSENCE REQUESTS FRO STUDENTS WHICH HAS BEEN APPROVED OR DENIED BY TEACHER
function get_review($studentID)
{
    global $conn;
    $sql = "SELECT ar.*, t.Firstname, t.Lastname FROM absencerequests AS ar 
    JOIN teachers AS t ON ar.ApproverID = t.TeacherID
    WHERE ar.StudentID = '$studentID' AND ar.status != 'Pending'";
    $review = mysqli_query($conn, $sql);

    $status = array();
    while ($row = mysqli_fetch_array($review)) {
        array_push($status, $row);
    }
    return $status;
}

//function add_teachers( );



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../newcss.css">
    <title>Abscence Request</title>
</head>

<body>
    <section class="student_acc">
        <nav class="std_nav">
            <div class="logo">
                <p>AMS</p>
            </div>
            <div class="nav-links">
                <a href="../student.php">Home</a>
                <a href="../std_account/absence_request.php" class="active">Absence Request</a>
                <a href="../std_account/my-attendance.php">My Attendance</a>
                <a href="timetable.php">Class Schedule</a>
                <a href="../std_account/view_teacher.php">View Teachers</a>
                <a href="../std_account/editacc.php">Edit Credentials</a>
                <a href="../std_account/profile.php">Profile</a>
            </div>
            <a href="../logout.php">
                <button><span class="iconify" data-icon="mingcute:power-fill"></span>Logout</button>
            </a>
        </nav>

        <div id="absence">
            <div class="abs-top">
                <h1 class="std-header">Absence Requests</h1>
                <a href="../std_account/absence_request_form.php">
                    <button>Make New Request</button>
                </a>
            </div>

            <div class="await">
                <h3>Pending Requests</h3>
                <div class="await-flex">
                    <?php
                    $absenceRequests = get_reasons($studentID);
                    if (count($absenceRequests) > 0) {
                        foreach ($absenceRequests as $reason) { ?>
                            <div class="await-card">
                                <div class="upper">
                                    <div class="date">
                                        <?php echo $reason['RequestDate'] ?>
                                    </div>
                                    <div class="state">
                                        <p><?php echo $reason['status'] ?></p>
                                    </div>
                                </div>

                                <p class="reason">
                                    <?php echo $reason['Reasons'] ?>
                                </p>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="empty">
                            <p>No Pending Requests <iconify-icon class="iconify" icon="ph:smiley-wink-light"></iconify-icon></p>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="status-known">
                <h3>Previous Requests</h3>
                <div class="prev-req">
                    <?php
                    $ReviewedState = get_review($studentID);
                    $myreviews = get_review($studentID);
                    if (count($myreviews) > 0) {
                        foreach ($ReviewedState as $reviews) { ?>
                            <div class="Pcard-1">
                                <div class="upper">
                                    <div class="date">
                                        <?php echo $reviews['RequestDate'] ?>
                                    </div>
                                    <?php
                                    $state = $reviews['status'];
                                    if ($state == 'Approved') {
                                        $cssClass = 'approved';
                                    } elseif ($state == 'Denied') {
                                        $cssClass = 'denied';
                                    } else {
                                        $cssClass = 'default';
                                    }
                                    echo '<div class="state' . ' ' . $cssClass . '">';
                                    echo '<p>' . $reviews['status'] . '</p>';
                                    echo '</div>';
                                    ?>
                                    
                                </div>
                                <p style="margin-top: 1rem;">Approved by: <span style="color: var(--color-primary); font-weight: bold;"><?php echo $reviews['Firstname'] . ' ' . $reviews['Lastname'] ?></span></p>
                                <p class="reason">
                                    <?php echo $reviews['Reasons'] ?>
                                </p>
                            </div>
                            <!--END OF CARD-->
                        <?php }
                    } else { ?>
                        <div class="empty">
                        <p>Your Teacher has not reviewed any absence requests from you yet! <iconify-icon class="iconify" icon="ph:smiley-wink-light"></iconify-icon></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php include "../footer.php";?>
    <!--Iconify cdn--->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>