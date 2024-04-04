<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header('location:../index.php');
}

include "../connection.php";

include "../functions.php";


if (isset($_POST['request'])) {
    $studentID = $_POST['studentID'];
    $Adate = $_POST['Absdate'];
    $Rdate = date('Y-m-d');
    $status = "Pending";
    $subjects = $_POST['subjects'];
    $reason = $_POST['reason'];
    $text = "You have a new Absence request!";
    $state = 0;

    if ($Adate < $Rdate) {

        $error[] = "Enter the correct absence Date";
    } else {

        $insert = insert($studentID, $status, $Adate, $subjects, $reason,);

        if ($insert == "Request Submitted Successfully") {

            $message[] = "Request Submitted Successfully";

            $fname = $_SESSION['student_fname'];
            $lname = $_SESSION['student_lname'];

            $admin_message = "Student" . ' ' . $fname . ' ' . $lname . "just sent an absence request!";
            $admin_state = 0;

            $insert_Admin_notification = insert_adminNotification($admin_message, $admin_state, $studentID);

            $insertNotification = insertNotifications($subjects, $studentID, $text, $state);
        } else {

            $error[] = mysqli_error($conn);
        }
    }
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../newcss.css">
    <title>Absence Request Form</title>
</head>

<body>
    <div class="abs-form">
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
        <a href="./absence_request.php">
            <div class="return">
                <span class="iconify" data-icon="ion:arrow-back-outline"></span>
            </div>
        </a>
        <form method="post" action="">
            <h2>Fill this form and wait for approval from the teacher</h2>


            <input type="hidden" value="<?php echo $_SESSION['student_id']; ?>" name="studentID">

            <div class="input">
                <span>Absence Date</span>
                <input type="date" name="Absdate" required>
            </div>

            <div class="input">
                <span>Subject You Won't Attend</span>
                <select name="subjects" id="subjects">
                    <option value="">Subjects</option>
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
            </div>

            <div class="input">
                <span>Absence Reason</span>
                <textarea name="reason" id="" cols="30" rows="10" placeholder="Reason...."></textarea>
            </div>

            <input type="submit" name="request" value="Send Request">
        </form>
    </div>
    <?php include "../footer.php"; ?>
    <!--ICONIFY CDN-->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <script src="../main.js"></script>
</body>

</html>