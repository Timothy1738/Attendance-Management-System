<?php
session_start();
include "../connection.php";
$teacherID = $_SESSION['teacher_id'];

if (isset($_POST['message'])) {
    $classID = $_POST['class'];
    $subjectID = $_SESSION['subject_Taught'];
    $textmessage = $_POST['messagetext'];
    $date = date('Y-m-d');
    $sql = "INSERT INTO `messages`(`ClassID`, `TeacherID`, `Message`, `Date`, `SubjectID`, `Time`) 
    VALUES ('$classID','$teacherID','$textmessage', '$date', '$subjectID', now())";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $message[] = "Message Sent!";
    } else {
        $error[] = "Failed" . mysqli_error($conn);
    }
}

function getMessages()
{
    global $conn;
    global $teacherID;
    $sql = "SELECT
    m.*,
    c.ClassName
    FROM `messages` AS m
    JOIN `classes` AS c ON m.ClassID = c.ClassID
    WHERE `TeacherID` = $teacherID";
    $result = mysqli_query($conn, $sql);

    $messageArray = [];
    while ($row = mysqli_fetch_array($result)) {
        $messageArray[] = $row;
    }
    return $messageArray;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Messages</title>
</head>

<body>
    <div class="teacher_acc">
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
                    <a href="../teacher_account/absence-requests.php">Absence Requests</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/view-students.php">Students</a>
                </div>

                <div class="item">
                    <a href="../teacher_account/view-teachers.php">Teachers</a>
                </div>

                <div class="item">
                    <a class="active" href="../teacher_account/messages.php">Messages</a>
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
            <h1 class="std-header">Messages</h1>
            <div class="write-msg">
                <h3>Write a message</h3>
                <form method="post">
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
                    <div class="input">
                        <label for="">Select Class</label>
                        <select name="class" id="" required>
                            <option value="">Select Class</option>
                            <option value="1">S1</option>
                            <option value="2">S2</option>
                            <option value="3">S3</option>
                            <option value="4">S4</option>
                            <option value="5">S5</option>
                            <option value="6">S6</option>
                        </select>
                    </div>

                    <textarea name="messagetext" id="" cols="30" rows="10" placeholder="Write Message...." required></textarea>
                    <input type="submit" value="Send Message" name="message">
                </form>
            </div>
            <div class="past-msgs">
                <h2>Previous Messages</h2>
                <div class="history">
                    <?php
                    $getMessages = getMessages();
                    if (count($getMessages) > 0) {
                        foreach ($getMessages as $messages) : ?>
                            <div class="messgage-card">
                                <div class="date">
                                    <p><?php echo $messages['Date'] ?></p>
                                </div>
                                <div class="text">
                                    <p>Class: <span><?php echo $messages['ClassName'] ?></span></p>
                                    <p>Time: <span><?php echo $messages['Time'] ?></span></p>
                                    <p><?php echo $messages['Message'] ?></p>
                                </div>
                            </div>
                        <?php endforeach;
                    } else { ?>
                        <div class="empty">
                            <p>You Havent sent any messages yet! <iconify-icon class="iconify" icon="tabler:mood-empty"></iconify-icon></p>
                        </div>
                    <?php } ?>
                    <!--END OF MESSAGE CARD1-->
                </div>
            </div>
        </div>
    </div>
    <?php include "../footer.php";?>
    <!--MAIN JS-->
    <script src="../main.js"></script>

    <!--ICONIFY CDN-->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>