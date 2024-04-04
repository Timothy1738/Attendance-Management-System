<?php

session_start();

include "../connection.php";

include "../functions.php";

$TeachersID = $_SESSION['teacher_id'];


//FORM TO APPROVE OR DENY A REQUEST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['approve'])) {
        $teacherID = $_POST['teacherID'];
        $Request_ID = $_POST['requestID'];

        $sql = "UPDATE `absencerequests` SET `status`='Approved',`ApproverID`='$teacherID' WHERE `RequestID` = '$Request_ID'";
        $approved = mysqli_query($conn, $sql);

        if ($approved) {
            $message[] = "Absence Request Approved Successfully";
            $fname = $_SESSION['teacher_fname'];
            $lname = $_SESSION['teacher_lname'];
            $admin_msg = "Teacher" . ' ' . $fname . ' ' . $lname . ' ' . "Approved Absence request!";
            $admin_state = 0;

            $insert_Att_Alert = insert_adminNotification_teacher_takeAtt($admin_msg, $admin_state, $TeachersID);
        } else {
            $error[] = "Approval Failed!";
        }
    } elseif (isset($_POST['deny'])) {
        $teacherID = $_POST['teacherID'];
        $Request_ID = $_POST['requestID'];

        $sql = "UPDATE `absencerequests` SET `status`='Denied',`ApproverID`='$teacherID' WHERE `RequestID` = '$Request_ID'";
        $denied = mysqli_query($conn, $sql);

        if ($denied) {
            $message[] = "Absence Request Rejected Successfully!";
            $fname = $_SESSION['teacher_fname'];
            $lname = $_SESSION['teacher_lname'];
            $admin_msg = "Teacher" . ' ' . $fname . ' ' . $lname . ' ' . "Denied Absence request!";
            $admin_state = 0;

            $insert_Att_Alert = insert_adminNotification_teacher_takeAtt($admin_msg, $admin_state, $TeachersID);
        } else {
            $error[] = "Failed to update Request!";
        }
    }
}

//deleting record
if (isset($_POST['delete'])) {
    $id = $_POST['delete_record'];

    $delete = deleteRecordfromAbsenceRequestTable($id);

    if ($delete == "success") {
        $message[] = "Record Deleted Successfully!";
    } else {
        $error[] = "SERVOR ERROR" . mysqli_error($conn);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Absence Requests</title>
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
                    <a href="../teacher_account/take-attendance.php">Take Attendance</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/view-attendance.php">View Attendance</a>
                </div>

                <div class="item">
                    <a class="active" href="../teacher_account/absence-requests.php">Absence Requests</a>
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
            <div class="pending-approvals">
                <h1 class="std-header">Pending Approvals</h1>
                <div class="teacher_pending">
                    <?php
                    $absenceRequestsForReview = getAbsenceRequestsForReview();
                    if (count($absenceRequestsForReview) > 0) {
                        foreach ($absenceRequestsForReview as $request) {
                    ?>
                            <div class="pending_card">
                                <div class="top">
                                    <img src="../images/<?php echo $request['image'] ?>" alt="student-img">
                                    <p><?php echo $request['FirstName'] . ' ' . $request['LastName'] ?></p>
                                </div>
                                <div class="mid">
                                    <div class="linear_layout">
                                        <p class="text-muted">Request Date:</p>
                                        <p class="text-muted"><?php echo $request['RequestDate'] ?></p>
                                    </div>

                                    <div class="linear_layout">
                                        <p class="text-muted">Absence Date:</p>
                                        <p class="text-muted"><?php echo $request['AbsenceDate'] ?></p>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="text">
                                        <p><?php echo $request['Reasons'] ?></p>
                                    </div>
                                    <form class="buttons" method="post">
                                        <input type="hidden" name="teacherID" value="<?php echo $_SESSION['teacher_id'] ?>">
                                        <input type="hidden" name="requestID" value="<?php echo $request['RequestID'] ?>">
                                        <button type="submit" name="approve" class="state approved">Approve</button>
                                        <button type="submit" name="deny" class="state denied">Deny</button>
                                    </form>
                                </div>
                            </div>
                        <?php
                        }
                    } else { ?>
                        <!--END OF CARD-->
                        <div class="empty">
                            <p>No pending approvals available! <iconify-icon class="iconify" icon="ph:smiley-wink-light"></iconify-icon></p>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!--HISTORY-->
            <h3 class="history1">History</h3>
            <div class="history">
                <?php
                $requestsReviewed = getReviewedRequests();
                if (count($requestsReviewed) > 0) {
                    foreach ($requestsReviewed as $review) {
                ?>
                        <div class="history_card">
                            <div class="top">
                                <div class="imagery">
                                    <img src="../images/<?php echo $review['image'] ?>" alt="student-img">
                                    <p><?php echo $review['FirstName'] . ' ' . $review['LastName'] ?></p>
                                </div>
                                <?php
                                $state = $review['status'];
                                if ($state == 'Approved') {
                                    $cssClass = 'approved';
                                } elseif ($state == 'Denied') {
                                    $cssClass = 'denied';
                                } else {
                                    $cssClass = 'default';
                                }
                                echo '<div class="state' . ' ' . $cssClass . '">';
                                echo '<p>' . $review['status'] . '</p>';
                                echo '</div>';
                                ?>
                            </div>

                            <div class="mid">
                                <div class="linear_layout">
                                    <p class="text-muted">Request Date:</p>
                                    <p class="text-muted"><?php echo $review['RequestDate'] ?></p>
                                </div>

                                <div class="linear_layout">
                                    <p class="text-muted">Absence Date:</p>
                                    <p class="text-muted"><?php echo $review['AbsenceDate'] ?></p>
                                </div>
                            </div>

                            <div class="bottom">
                                <div class="text">
                                    <p><?php echo $review['Reasons'] ?></p>
                                </div>
                            </div>

                            <div class="actions">

                                <a href="../teacher_account/editabsence.php?id=<?php echo $review['RequestID'] ?>&fn=<?php echo $review['FirstName']?>&ln=<?php echo $review['LastName']?>&st=<?php echo $review['status']?>">
                                    <button class="edit-btn" type="submit" name="submit" onclick="return confirm('Are you sure you want to edit this record?');">
                                        <span id="iconify" class="iconify edit-btn" data-icon="bx:edit"></span>
                                    </button>
                                </a>


                                <h3 style="color: var(--color-primary); font-weight: bold;">Actions</h3>

                                <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="delete_record" value="<?php echo $review['RequestID']; ?>">
                                    <Button class="delete-btn" type="submit" name="delete">
                                        <span class="iconify delete-btn" data-icon="fluent:delete-24-filled"></span>
                                    </Button>
                                </form>

                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="empty">
                        <p>No Absence Request Yet! <iconify-icon class="iconify" icon="ph:smiley-wink-light"></iconify-icon></p>
                    </div>
                <?php } ?>
                <!--END OF CARD-->
            </div>
        </div>
    </section>
    <?php include "../footer.php";?>

    <!--Iconify cdn--->

    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <!--main js-->
    <script src="../main.js"></script>
</body>

</html>