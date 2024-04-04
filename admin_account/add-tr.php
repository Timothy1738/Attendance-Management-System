<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}
include "../connection.php";

include "../functions.php";

if (isset($_POST['add'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $subjectTaught = $_POST['subject'];

    $image = basename($_FILES["image"]["name"]);
    $targetDir = "../images/";
    $targetFilePath = $targetDir . $image;

    if (!empty($_FILES["image"]["name"]) && $_FILES["image"]["error"] == 0) {
        // Move the uploaded file
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
    } else {
        // Handle the file upload error
        echo "File upload failed with error code: " . $_FILES["image"]["error"];
    }

    $lettersOnlyRegex = '/^[a-zA-Z]+$/';

    if (!preg_match($lettersOnlyRegex, $fname)) {
        $error[] = 'Please enter only letters in the First Name field.';
    }

    if (!preg_match($lettersOnlyRegex, $lname)) {
        $error[] = 'Please enter only letters in the Last Name field.';
    }

    $teacherexists = teacher_already_exists($email, $contact);

    if ($teacherexists == true) {

        $error[] = "Teacher" . ' ' . $fname . ' ' . $lname . ' ' . "Already Exists!";
    }

    if (strlen($contact) != 10) {

        $error[] = "Invalid contact!";
    }

    $checkifUsernameAlreadyExists = checkIfUsernameExistsInAllTables($username, $email);

    if ($checkifUsernameAlreadyExists == "Proceed") {

        if (empty($error)) {
            $insertteacher = insert_teacher($fname, $lname, $contact, $email, $password, $username, $subjectTaught, $image);

            if ($insertteacher == true) {

                $message[] = "New Teacher registered successfully!";
            } else {
                $error[] = "Server Error, Please try Again!";
            }
        }


    } else {
        $error[] = "Username" . ' ' . $username . ' ' . "Already Taken!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Add Teacher</title>
</head>

<body>
    <div class="add-activity">
        <a href="../admin_account/view-teacher.php">
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

        <form method="POST" class="activity" enctype="multipart/form-data">
            <h2>Add Teacher</h2>
            <div class="form-body">
                <div class="left">
                    <input type="text" placeholder="First Name" name="fname" required>

                    <input type="text" placeholder="Last Name" name="lname" required>

                    <input type="text" placeholder="Username" name="username" required>

                    <input type="number" placeholder="Contact" name="contact" required>
                </div>
                <!--LEFT FIELDS-->

                <div class="right">
                    <input type="email" placeholder="Email" name="email">

                    <input type="password" name="password" placeholder="Password" required>

                    <select name="subject" id="">
                        <option value="">Subject Taught</option>
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

                    <div class="input">
                        <span>Image</span>
                        <input type="file" required name="image">
                    </div>
                </div>
                <!--RIGHT FIELDS-->
            </div>
            <input type="submit" name="add" value="Add Teacher">
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