<?php
session_start();
include "../connection.php";
include "../functions.php";

$firstname = $_GET['fn'];
$lastname = $_GET['ln'];

$TeachersID = $_SESSION['teacher_id'];

if (isset($_POST['submit'])) {
    $recordID = $_POST['recordID'];
    $edit = getRecordExtralessons($recordID);
}

if (isset($_POST['update'])) {
    $ID = $_POST['recordID'];
    $status = $_POST['status'];

    $reset = ExtraLessonsEdited($status, $ID);

    if ($reset == "success") {
        $message[] = "Attendance Updated Successfully";

        $fname = $_SESSION['teacher_fname'];
        $lname = $_SESSION['teacher_lname'];

        $admin_msg = "Teacher" . ' ' . $fname . ' ' . $lname . ' ' . "just Edited Attendance in Extra Lessons of"  . ' ' . $firstname . ' ' . $lastname;
        $admin_state = 0;

        $insert_Att_Alert = insert_adminNotification_teacher_takeAtt($admin_msg, $admin_state, $TeachersID);
    } else {
        $error[] = "Failed to Update Attendance" . mysqli_error($conn);
    }
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Edit Attendance</title>
</head>

<body>
    <div class="edit-info">
        <a href="../teacher_account/attExtraLessons.php">
            <div class="return">
                <span class="iconify" data-icon="ion:arrow-back-outline"></span>
            </div>
        </a>
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
        <form method="post">
            <div class="input">
                <span>Student Name</span>
                <input type="text" placeholder="Student Name" readonly value="<?php echo isset($edit['FirstName']) ? $edit['FirstName'] . ' ' . $edit['LastName'] : ''; ?>">
            </div>
            <div class="input">
                <span>Edit Status</span>
                <input type="text" placeholder="absent/present" name="status" value="<?php echo isset($edit['IsPresent']) ? $edit['IsPresent'] : ''; ?>">
            </div>

            <input type="hidden" name="recordID" value="<?php echo isset($edit['OverrideID']) ? $edit['OverrideID'] : ''; ?>">


            <input type="submit" value="Update Attendance" name="update">
        </form>
    </div>
    <?php include "../footer.php"; ?>
    <!--ICONIFY CDN-->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</body>

</html>