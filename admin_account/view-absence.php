<?php

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}

include "../connection.php";

include "../functions.php";

function fetch_absRequests()
{
    global $conn;
    $sql = "SELECT ar.*, s.FirstName, s.LastName, t.Firstname, t.Lastname
    FROM absencerequests AS ar
    JOIN students AS s ON ar.StudentID = s.StudentID
    JOIN teachers AS t ON ar.ApproverID = t.TeacherID;";

    $result = mysqli_query($conn, $sql);

    $absReq_array = [];
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $absReq_array[] = $rows;
        }return $absReq_array;
    }
    return false;
}

function deleteAbsenceRequest($requestID)
{
    global $conn;
    $sql = "DELETE FROM absencerequests WHERE RequestID = '$requestID'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        return true;
    }else {
        return false;
    }
}

if(isset($_POST['delete'])) {
    $requestID = $_POST['delete_record'];

    $deleteAbsRecord = deleteAbsenceRequest($requestID);
    if($deleteAbsRecord == true) {
        $message[] = "Record Successfully Deleted!";
    }else {
        $error[] = "SERVER ERROR, PLEASE TRY AGAIN!";
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
    <title>View Absence</title>
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
                    <a href="../admin.php">Dasboard</a>
                </div>

                <div class="item">
                    <a href="view-students.php">Students</a>
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
                    <a class="active" href="view-absence.php">Abscence Requests</a>
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
            </div>
            <div class="view-activity-table">
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
                <h3 style="margin-top: 1rem; margin-bottom: 1rem; font-size: 2rem; color: var(--color-primary);">Absence Requests From Students</h3>
                <?php
                if (fetch_absRequests() == false) {
                    echo "<div class=empty>";
                    echo "<p>No Available Record Yet!</p>";
                    echo "</div>";
                } else { ?>
                    <table>
                        <tr>
                            <th>Request ID</th>
                            <th>Student</th>
                            <th>Request Date</th>
                            <th>Absence Date</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Approver</th>
                            <th>Time Stamp</th>
                            <th colspan="2">Actions</th>
                        </tr>
                        <?php 
                        $absence_requests = fetch_absRequests();
                        foreach ($absence_requests as $request) { ?>
                            <tr>
                                <td><?php echo $request['RequestID'] ?></td>
                                <td><?php echo $request['FirstName'] . ' ' . $request['LastName'] ?></td>
                                <td><?php echo $request['RequestDate'] ?></td>
                                <td><?php echo $request['AbsenceDate'] ?></td>
                                <td><?php echo $request['Reasons'] ?></td>
                                <td><?php echo $request['status'] ?></td>
                                <td><?php echo $request['Firstname'] . ' ' .$request['Lastname'] ?></td>
                                <td><?php echo $request['Time_stamp'] ?></td>

                                <td>
                                    <form action="" method="post" onsubmit="return confirm('Are You sure you want to delete this record? Please not that his action is Irreversible!')">
                                        <input type="hidden" name="delete_record" value="<?php echo $request['RequestID']; ?>">
                                        <Button class="delete-btn" name="delete"  type="submit">
                                            <span class="iconify" data-icon="fluent:delete-24-filled"></span>
                                        </Button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </table><?php }
                            ?>
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