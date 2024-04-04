<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}

include "../connection.php";
include "../functions.php";

$fname = $_GET['fn'];
$lname = $_GET['ln'];
$tel = $_GET['tel'];
$email = $_GET['em'];
$img = $_GET['img'];
$username = $_GET['uname'];
$id = $_GET['id'];

if (isset($_POST['edit'])) {
    $id = $_POST['AdminID'];
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

    $checkifExists = checkIfUsernameExistsInAllTables($username, $email);

    if ($checkifExists == "Proceed") {
        $newBio = updateprofile($id, $firstname, $lastname, $contact, $email, $image);
        if ($newBio == true) {
            $message[] = "You have successfully edited Your profile";
        } else {
            $error[] = "SERVER ERROR";
        }
    }else {
        $error[] = "Email Already Exists!";
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
        <a href="view_admin.php">
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
        <form method="post" id="editform" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to edit this record?')">
            <h3 style="color: var(--color-primary); margin-top: 1rem; text-align: center;">Edit Your Profile</h3>
            <input type="text" name="fname" value="<?php echo $fname ?>" placeholder="First Name" required>
            <input type="text" name="lname" placeholder="Last Name" value="<?php echo $lname ?>" required>
            <input type="number" name="tel" placeholder="Contact" value="<?php echo $tel ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo $email ?>" required>
            <input type="hidden" name="AdminID" value="<?php echo $id ?>">
            <span>Old Image: <?php echo $img ?></span>
            <input type="file" name="image" required>
            <input type="submit" name="edit" value="Edit Profile">
        </form>
    </div>

    <script src="../main.js"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</body>

</html>