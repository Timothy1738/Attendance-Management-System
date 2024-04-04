<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}
include "../connection.php";
include "../functions.php";

$id = $_GET['id'];
$img = $_GET['im'];
$fname = $_GET['fn'];
$lname = $_GET['ln'];
$classname = $_GET['cl'];
$DOB = $_GET['db'];
$gender = $_GET['gn'];
$address = $_GET['ad'];
$email = $_GET['em'];
$tel = $_GET['ct'];
$classid = $_GET['cid'];




if (isset($_POST['edit'])) {
    $studentid = $_POST['studentid'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $class = $_POST['class'];
    $dateOfBirth = $_POST['dob'];
    $sex = $_POST['gender'];
    $ad = $_POST['address'];
    $contact = $_POST['tel'];
    $Email = $_POST['email'];

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

    $checkifExists = checkIfUsernameExistsInAllTables($username, $email);
    if (strlen($contact) != 10) {

        $error[] = "Invalid contact!";
    } else {

        if ($checkifExists == "Proceed") {
            $newBio = editstudent($studentid, $firstname, $lastname, $class, $dateOfBirth, $sex, $ad, $contact, $Email, $image);
            if ($newBio == "yes") {
                $message[] = "Student Record changed successfully!";
            } else {
                $error[] = "SERVER ERROR";
            }
        } else {
            $error[] = "Email Already Exists!";
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
    <title>Edit Student</title>
</head>

<body>
    <div class="edit-std-profile">
        <a href="view-students.php">
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
        <form method="post" id="editform" enctype="multipart/form-data" onsubmit="return confirm('Are You sure you want to edit this record?')">
            <h3 style="color: var(--color-primary); margin-top: 1rem; text-align: center;">Edit Student Profile</h3>
            <div class="form-body">
                <div class="right">
                    <input type="text" name="fname" value="<?php echo $fname ?>" placeholder="First Name" required>
                    <input type="text" name="lname" placeholder="Last Name" value="<?php echo $lname ?>" required>
                    <select name="class" id="" required>
                        <option value="<?php echo $classid ?>">Current Class: <?php echo $classname ?></option>
                        <option value="1">S1</option>
                        <option value="2">S2</option>
                        <option value="3">S3</option>
                        <option value="4">S4</option>
                        <option value="5">S5</option>
                        <option value="6">S6</option>
                    </select>
                    <input type="date" name="dob" value="<?php echo $DOB ?>">
                    <input type="text" name="gender" value="<?php echo $gender ?>">
                </div>
                <div class="left">
                    <input type="text" name="address" value="<?php echo $address ?>">
                    <input type="email" name="email" placeholder="Email" value="<?php echo $email ?>" required>
                    <input type="number" name="tel" placeholder="Contact" value="<?php echo $tel ?>" required>
                    <input type="hidden" name="studentid" value="<?php echo $id ?>">
                    <span>Old Image: <?php echo $img ?></span>
                    <input type="file" name="image" required>
                </div>
            </div>
            <input type="submit" name="edit" value="Edit Profile">
        </form>
    </div>

    <?php include "../footer.php"; ?>

    <script src="../main.js"></script>
    <!--ICONIFY CDN-->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</body>

</html>