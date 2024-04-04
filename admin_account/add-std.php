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
    $gender = $_POST['gender'];
    $DOB = $_POST['DOB'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $class = $_POST['class'];

    $lettersOnlyRegex = '/^[a-zA-Z]+$/'; 

    $image = basename($_FILES["image"]["name"]);
    $targetDir = "../images/";
    $targetFilePath = $targetDir . $image;

    if (!empty($_FILES["image"]["name"]) && $_FILES["image"]["error"] == 0) {
        // Move the uploaded file
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
    } else {
        // Handle the file upload error
        $error[] =  "File upload failed with error code: " . $_FILES["image"]["error"];
    }

    if (!preg_match($lettersOnlyRegex, $fname)) {
        $error[] = 'Please enter only letters in the First Name field.';
    }

    if (!preg_match($lettersOnlyRegex, $lname)) {
        $error[] = 'Please enter only letters in the Last Name field.';
    }

    // Calculate the age based on the provided date of birth
    $birthDate = new DateTime($DOB);
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;

    // Set the minimum age allowed
    $minimumAge = 10;

    if ($age < $minimumAge) {

        $error[] = "The student is too young";

    }

    $studentExists = student_already_exists($email, $contact);

    if ($studentExists == "Email Exists") {

        $error[] = "Student" . ' ' . $fname . ' ' . $lname . ' ' . "Already Exists";
    }

    $checkusername = checkIfUsernameExistsInAllTables($username, $email);

    if ($checkusername == "User Already Exists") {

        $error[] = "Username Already Exists!";
    }

    if (strlen($contact) != 10) {

        $error[] = "Contact Should have 10 characters only";
    }

    if (empty($error)) {
        $insertStudent = insert_student($image, $fname, $lname, $class, $DOB, $gender, $address, $contact, $email, $password, $username);
        if ($insertStudent = "yes") {
            $message[] = "New Student Added Successfully";
        } else {
            $error[] = "Error. FAILED TO INSERT STUDENT!!!!!!!!!!!!!";
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
    <title>Add Student</title>
</head>

<body>
    <div class="add-activity">
        <a href="../admin_account/view-students.php">
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
            <h2>Add Student</h2>
            <div class="form-body">
                <div class="left">
                    <input type="text" placeholder="First Name" name="fname" required>

                    <input type="text" placeholder="Last Name" name="lname" required>

                    <select name="gender" id="" required>
                        <option value="">Select Gender</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                    </select>

                    <!-- <input type="text" placeholder="Gender" name="gender" required> -->

                    <div class="input">
                        <span>Date of Birth</span>
                        <input type="date" required name="DOB">
                    </div>

                    <input type="text" placeholder="Address" name="address" required>
                </div>
                <!--LEFT FIELDS-->

                <div class="right">
                    <input type="number" placeholder="Contact" name="contact" required>

                    <input type="email" placeholder="Email" name="email" required>

                    <input type="text" placeholder="Username" name="username" required>

                    <input type="password" placeholder="Password" name="password" required>

                    <select name="class" id="class">
                        <option value="1">S1</option>
                        <option value="2">S2</option>
                        <option value="3">S3</option>
                        <option value="4">S4</option>
                        <option value="5">S5</option>
                        <option value="6">S6</option>
                    </select>

                    <div class="input">
                        <span>Image</span>
                        <input type="file" required name="image">
                    </div>
                </div>
                <!--RIGHT FIELDS-->
            </div>
            <input type="submit" name="add" value="Add Student">
        </form>
    </div>

    <?php include "../footer.php"; ?>
    <!--ICONIFY CDN-->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <!--MAIN JS-->
    <script defer src="../main.js"></script>
</body>

</html>