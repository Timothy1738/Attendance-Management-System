<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}
include "../connection.php";

include "../functions.php";

$recordID = $_GET['id'];
$subject_1 =  $_GET['p1'];
$subject_2 = $_GET['p2'];
$subject_3 = $_GET['p3'];
$subject_4 = $_GET['p4'];
$Day = $_GET['day'];

if (isset($_POST['edit'])) {

    $record_ID = $_POST['id'];
    $first_subject = $_POST['s_1'];
    $second_subject = $_POST['s_2'];
    $third_subject = $_POST['s_3'];
    $fourth_subject = $_POST['s_4'];

    $edit = editAlevel($record_ID, $first_subject, $second_subject, $third_subject, $fourth_subject);

    if ($edit == true) {
        $message[] = "Record Edited Successfully";
    } else {
        $error[] = "Failed to edit Record!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Edit Shedule</title>
</head>

<body>
    <div class="add-activity">
        <a href="timetable.php">
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

        <form method="POST" class="activity">
            <h2>Edit Schedule Advanced Level</h2>
            <div class="form-body">
                <input type="text" placeholder="Day" value="<?php echo $Day ?>" required readonly>

                <select name="s_1" id="">
                    <option value="<?= $subject_1 ?>">Current Subject: <?php echo $subject_1 ?></option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Physics">Physics</option>
                    <option value="Chemistry">Chemistry</option>
                    <option value="Geography">Geography</option>
                    <option value="Biology">Biology</option>
                    <option value="History">History</option>
                    <option value="English">English</option>
                    <option value="Agriculture">Agriculture</option>
                    <option value="Commerce">Commerce</option>
                    <option value="CRE">CRE</option>
                    <option value="ICT">ICT</option>
                    <option value="Fine Art">Fine Art</option>
                    <option value="Literature">Literature</option>
                    <option value="Enterpreneurship">Enterpreneurship</option>
                </select>
                <!--SUBJECT ONE-->

                <select name="s_2" id="">
                    <option value="<?= $subject_2 ?>">Current Subject: <?php echo $subject_2 ?></option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Physics">Physics</option>
                    <option value="Chemistry">Chemistry</option>
                    <option value="Geography">Geography</option>
                    <option value="Biology">Biology</option>
                    <option value="History">History</option>
                    <option value="English">English</option>
                    <option value="Agriculture">Agriculture</option>
                    <option value="Commerce">Commerce</option>
                    <option value="CRE">CRE</option>
                    <option value="ICT">ICT</option>
                    <option value="Fine Art">Fine Art</option>
                    <option value="Literature">Literature</option>
                    <option value="Enterpreneurship">Enterpreneurship</option>
                </select>
                <!--SUBJECT TWO-->

                <select name="s_3" id="">
                    <option value="<?= $subject_3 ?>">Current Subject: <?php echo $subject_3 ?></option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Physics">Physics</option>
                    <option value="Chemistry">Chemistry</option>
                    <option value="Geography">Geography</option>
                    <option value="Biology">Biology</option>
                    <option value="History">History</option>
                    <option value="English">English</option>
                    <option value="Agriculture">Agriculture</option>
                    <option value="Commerce">Commerce</option>
                    <option value="CRE">CRE</option>
                    <option value="ICT">ICT</option>
                    <option value="Fine Art">Fine Art</option>
                    <option value="Literature">Literature</option>
                    <option value="Enterpreneurship">Enterpreneurship</option>
                </select>
                <!--SUBJECT THREE-->

                <select name="s_4" id="">
                    <option value="<?= $subject_4 ?>">Current Subject: <?php echo $subject_4 ?></option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Physics">Physics</option>
                    <option value="Chemistry">Chemistry</option>
                    <option value="Geography">Geography</option>
                    <option value="Biology">Biology</option>
                    <option value="History">History</option>
                    <option value="English">English</option>
                    <option value="Agriculture">Agriculture</option>
                    <option value="Commerce">Commerce</option>
                    <option value="CRE">CRE</option>
                    <option value="ICT">ICT</option>
                    <option value="Fine Art">Fine Art</option>
                    <option value="Literature">Literature</option>
                    <option value="Enterpreneurship">Enterpreneurship</option>
                </select>
                <!--SUBJECT FOUR-->

                <input type="hidden" name="id" value="<?php echo $recordID ?>">
            </div>
            <input type="submit" name="edit" value="Edit Schedule">
        </form>
    </div>
    <?php include "../footer.php"; ?>
    <!--ICONIFY CDN-->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <!--MAIN JS-->
    <script>
        function removeErrorMessage() {
            var Message = document.querySelector('.success-msg');
            if (Message) {
                setTimeout(function() {
                    Message.style.display = 'none';
                }, 3000); // 3000 milliseconds (3 seconds)
            }
        }

        // Call the function when the page loads
        window.onload = removeErrorMessage;
    </script>
</body>

</html>