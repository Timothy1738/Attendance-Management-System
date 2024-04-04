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
$email = $_GET['em'];
$tel = $_GET['tel'];
$subject = $_GET['sb'];
$subjectid = $_GET['sid'];




if (isset($_POST['edit'])) {
    $id = $_POST['teacherid'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $subject = $_POST['subject'];
    $contact = $_POST['tel'];
    $email = $_POST['email'];

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
            $newBio = editteacher($id, $firstname, $lastname, $subject, $contact, $email, $image);
            if ($newBio == true) {
                $message[] = "Teacher Record changed successfully!";
            } else {
                $error[] = "SERVER ERROR";
            }
        }else {
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
    <title>Edit Teacher</title>
</head>

<body>
    <div class="edit-std-profile">
        <a href="view-teacher.php">
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
            <h3 style="color: var(--color-primary); margin-top: 1rem; text-align: center;">Edit Teacher Profile</h3>
            <div class="form-body">
                <div class="right">
                    <input type="text" name="fname" value="<?php echo $fname ?>" placeholder="First Name" required>
                    <input type="text" name="lname" placeholder="Last Name" value="<?php echo $lname ?>" required>
                    <select name="subject" id="" required>
                        <option value="<?php echo $subjectid ?>">Current Subject Taught: <?php echo $subject ?></option>
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
                    <input type="email" name="email" value="<?php echo $email ?>">
                </div>
                <div class="left">
                    <input type="number" name="tel" placeholder="Contact" value="<?php echo $tel ?>" required>
                    <input type="hidden" name="teacherid" value="<?php echo $id ?>">
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