<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}
include "../connection.php";
include "../functions.php";

if (isset($_POST['submit'])) {
    $recordID = $_POST['RecordID'];
    $edit = getRecord($recordID);
}

if (isset($_POST['update'])) {
    $ID = $_POST['recordID'];
    $status = $_POST['status'];

    $reset = edit($status, $ID);

    if ($reset == "success") {
        $message[] = "Attendance Updated Successfully";
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
        <a href="View-attendance.php">
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

            <input type="hidden" name="recordID" value="<?php echo isset($edit['RecordID']) ? $edit['RecordID'] : ''; ?>">


            <input type="submit" value="Update Attendance" name="update">
        </form>
    </div>
    <?php include "../footer.php"; ?>
    <!--ICONIFY CDN-->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</body>

</html>