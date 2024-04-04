<?php
session_start();

include "../connection.php";

include "../functions.php";

$fname = $_GET['fn'];
$lname = $_GET['ln'];
$status = $_GET['st'];
$ID = $_GET['id'];

if (isset($_POST['update'])) {
    $ID = $_POST['requestID'];
    $status = $_POST['status'];

    $reset = editAbsenceRequest($status, $ID);

    if ($reset == "success") {
        $message[] = "Absence Request Status Changed Successfully!";
    } else {
        $error[] = "Failed to Update Absence Request status" . mysqli_error($conn);
    }
}
// echo isset($edit['FirstName']) ? $edit['FirstName'] . ' ' . $edit['LastName'] : '';
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Edit Absence Request</title>
</head>

<body>
    <div class="edit-info">

        <a href="../teacher_account/absence-requests.php">
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
                <input type="text" placeholder="Student Name" readonly value="<?php echo $fname . ' ' . $lname?>">
            </div>

            <div class="input">
                <select name="status" id="" required>
                    <option value="">Current Status is: <?php echo $status?></option>
                    <option value="Approved">Approved</option>
                    <option value="Denied">Denied</option>
                </select>
            </div>
            <input type="hidden" name="requestID" value="<?php echo $ID?>">


            <input type="submit" value="Update Attendance" name="update">

        </form>
    </div>
    <?php include "../footer.php";?>
    
    <!--ICONIFY CDN-->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="../main.js"></script>
</body>

</html>
