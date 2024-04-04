<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}
include "../connection.php";

include "../functions.php";

if (isset($_POST['add'])) {

    $first_subject = $_POST['s_1'];
    $second_subject = $_POST['s_2'];
    $third_subject = $_POST['s_3'];
    $fourth_subject = $_POST['s_4'];
    $Day = $_POST['day'];
    $level = $_POST['level'];

    if($level == "Olevel") {

        $checkifRecordOlevelExists = checkifDayExistsOlevel($Day);

        if($checkifRecordOlevelExists == true) {

            $error[] = "Schedule Already Recorded For this Day!";

        }else {
            $insertO_levelSchedule = addScheduleOlevel($Day, $first_subject, $second_subject, $third_subject, $fourth_subject);

            if($insertO_levelSchedule == true) {
                $message[] = "New schedule inserted successfully!";
            }else {
                $error[] = "Failed to Add Schedule! Try again or contact system Developer!";
            }
        }
    }else {

        $checkifRecordAlevelExists = checkifDayExistsAlevel($Day);

        if($checkifRecordAlevelExists ==true) {

            $error[] = "Schedule Already Recorded For this Day!";

        }else {

            $insertA_levelSchedule = addScheduleAlevel($Day, $first_subject, $second_subject, $third_subject, $fourth_subject);

            if($insertA_levelSchedule == true) {

                $message[] = "New schedule inserted successfully!";

            }else {

                $error[] = "Failed to Add Schedule! Try again or contact system Developer!";

            }

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
    <title>Add Shedule</title>
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
            <h2>Add Schedule</h2>
            <div class="form-body">

                <select name="level" id="" required>
                    <option value="">Select Level</option>
                    <option value="Olevel">Ordinary Level</option>
                    <option value="Alevel">Advanced Level</option>
                </select>

                <select name="day" id="" required>
                    <option value="">Select Day</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                </select>

                <select name="s_1" id="" required>
                    <option value="">Select Subject</option>
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

                <select name="s_2" id="" required>
                    <option value="">Select Subject</option>
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

                <select name="s_3" id="" required>
                    <option value="">Select Subject</option>
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

                <select name="s_4" id="" required>
                    <option value="">Select Subject</option>
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
            </div>
            <input type="submit" name="add" value="Add Schedule">
        </form>
    </div>
    <?php include "../footer.php"; ?>
    <!--ICONIFY CDN-->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <!--MAIN JS-->
    <script src="../main.js"></script>
</body>

</html>