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
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tel = $_POST['tel'];
    $username = $_POST['username'];

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

    $ifExists = checkIFusernameexists($email, $username, $tel);
    if ($ifExists == true) {
        $error[] = "Either contact, Email, or username Already Exists!";
    } else {
        $insertadmin = insertNewAdmin($fname, $lname, $image, $email, $tel, $username, $password);
        if ($insertadmin == true) {
            $message[] = "New Admin inserted successfully!";
        } else {
            $error[] = "Error! Failed to insert Admin!!!!!!!!";
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
    <title>Add Admin</title>
</head>

<body>
    <div class="add-activity">
        <a href="../admin_account/view_admin.php">
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
            <h2>Add Admin</h2>
            <div class="form-body">
                <div class="left">
                    <input type="text" placeholder="First Name" name="fname" required>

                    <input type="text" placeholder="Last Name" name="lname" required>

                    <input type="email" placeholder="Email" name="email" required>
                </div>

                <!--LEFT FIELDS-->

                <div class="right">

                    <input type="text" placeholder="Username" name="username" required>

                    <input type="password" placeholder="Password" name="password" required>

                    <input type="number" placeholder="Contact" name="tel" required>

                    <div class="input">
                        <span>Image</span>
                        <input type="file" required name="image">
                    </div>
                </div>
                <!--RIGHT FIELDS-->
            </div>
            <input type="submit" name="add" value="Add Admin">
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