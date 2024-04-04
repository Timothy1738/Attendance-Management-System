<?php
session_start();
include "../connection.php";
include "../functions.php";

$TeachersID = $_SESSION['teacher_id'];

$fname = $_GET['fn'];
$lname = $_GET['ln'];
$tel = $_GET['ct'];
$Email = $_GET['em'];
$img = $_GET['im'];
$id = $_GET['id'];

if (isset($_POST['edit'])) {
    $id = $_POST['teacherID'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $contact = $_POST['tel'];
    $email = $_POST['email'];
    $username = "";

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

    if ($email != $Email) {

        $checkifExists = checkIfUsernameExistsInAllTables($username, $email);

        if ($checkifExists == "Proceed") {

            $newBio = editprofileTeacher($id, $firstname, $lastname, $contact, $email, $image);

            if ($newBio == "yes") {

                $message[] = "You have successfully edited Your profile";

                $fname = $_SESSION['teacher_fname'];
                $lname = $_SESSION['teacher_lname'];
                $admin_msg = "Teacher" . ' ' . $fname . ' ' . $lname . ' ' . "has edited his profile!";
                $admin_state = 0;

                $insert_Att_Alert = insert_adminNotification_teacher_takeAtt($admin_msg, $admin_state, $TeachersID);
            } else {
                $error[] = "SERVER ERROR";
            }
        } else {
            $error[] = "Email Already Exists!";
        }
    } else {
        $newBio = editprofileTeacher($id, $firstname, $lastname, $contact, $email, $image);
        if ($newBio == "yes") {
            $message[] = "You have successfully edited Your profile";

            $fname = $_SESSION['teacher_fname'];
            $lname = $_SESSION['teacher_lname'];
            $admin_msg = "Teacher" . ' ' . $fname . ' ' . $lname . ' ' . "has edited his profile!";
            $admin_state = 0;

            $insert_Att_Alert = insert_adminNotification_teacher_takeAtt($admin_msg, $admin_state, $TeachersID);
            
        } else {
            $error[] = "SERVER ERROR";
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
    <title>Edit Profile</title>
</head>

<body>
    <div class="edit-profile">
        <a href="../teacher.php">
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
        <form method="post" id="editform" enctype="multipart/form-data">
            <h3 style="color: var(--color-primary); margin-top: 1rem; text-align: center;">Edit Your Profile</h3>
            <input type="text" name="fname" value="<?php echo $fname ?>" placeholder="First Name" required>
            <input type="text" name="lname" placeholder="Last Name" value="<?php echo $lname ?>" required>
            <input type="number" name="tel" placeholder="Contact" value="<?php echo $tel ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo $Email ?>" required>
            <input type="hidden" name="teacherID" value="<?php echo $id ?>">
            <span>Old Image: <?php echo $img ?></span>
            <input type="file" name="image" required>
            <input type="submit" name="edit" value="Edit Profile">
        </form>
    </div>
    <?php include "../footer.php"; ?>

    <script src="../main.js"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</body>

</html>