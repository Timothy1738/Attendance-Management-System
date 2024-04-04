<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}
include "../connection.php";
include "../functions.php";

$ID = $_GET['id'];
if (isset($_POST['edit'])) {
    $userid = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = "";
    $tel = "";

    $checkifExists = checkIfUsernameExistsInAllTables($username, $email);

    if ($checkifExists == "Proceed") {


        $update = updateCredentials($userid, $username, $password);
        if ($update == true) {
            $message[] = "Login credentials updated successfully!";
        } else {
            $error[] = "Failure! SERVER ERROR!!!!!!!!!!!!!!!!!!1";
        }
    } else {
        $error[] = "Username Already taken!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Edit Credentals</title>
</head>

<body>
    <div class="editacc">
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
        <h2>Edit Your Login Credentials</h2>
        <form action="" method="post">
            <input type="text" placeholder="New Username" name="username" required>
            <input type="password" placeholder="New Password" name="password" required>
            <input type="hidden" name="id" value="<?= $ID ?>">
            <input type="submit" value="Edit Credentials" name="edit" name="edit">
        </form>
    </div>
    <script defer src="../main.js"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</body>

</html>