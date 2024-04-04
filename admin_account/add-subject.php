<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}
include "../connection.php";

include "../functions.php";

if (isset($_POST['add'])) {

    $SubjectName = $_POST['sub_name'];

    $ifExists = checkifsubjectAlreadyExists($SubjectName);

    if($ifExists == true) {

        $error[] = "Subject" . ' ' . $SubjectName . ' ' . " Already Exists!";

    }else {
        $insert =  insertsubjects($SubjectName);
        if($insert == true) {
            $message[] = "Subject Inserted Successfully!";
        }else {
            $error[] = "Failed to insert subject! SERVER ERROR!!!!!!!!!!!!!!!!!";
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
    <title>Add Subject</title>
</head>

<body>
    <div class="edit-profile">
        <a href="subjects.php">
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
            <h2>Add Subject</h2>
            <input type="text" placeholder="Subject Name" name="sub_name" required>
            <input type="submit" name="add" value="Add Subject">
        </form>
    </div>

    <?php include "../footer.php"; ?>
    <!--ICONIFY CDN-->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <!--MAIN JS-->
    <script defer src="../main.js"></script>
</body>

</html>