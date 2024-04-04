<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}

include "../connection.php";
include "../functions.php";

$id = $_GET['id'];
$classname = $_GET['cn'];
$year = $_GET['yr'];
$ctid = $_GET['ctid'];



if (isset($_POST['edit'])) {
    $classID = $_POST['classid'];
    $className = $_POST['classname'];
    $year = $_POST['year'];
    $classTID = $_POST['ctid'];

    $editClass = editClass($classID, $className, $year, $classTID);

    if ($editClass == true) {
        $message[] = "Class Record changed successfully!";
    } else {
        $error[] = "SERVER ERROR";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Edit Class</title>
</head>

<body>
    <div class="edit-std-profile">
        <a href="view-classes.php">
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
        <form method="post" onsubmit="return confirm('Are You sure you want to edit this record?')">
            <h3 style="color: var(--color-primary); margin-top: 1rem; text-align: center;">Edit Class</h3>
            <input type="text" name="classname" value="<?php echo $classname ?>" placeholder="Class Name" required>
            <input type="number" name="year" placeholder="Year" value="<?php echo $year ?>" required>
            <input type="number" name="ctid" placeholder="Class Teacher ID" value="<?php echo $ctid ?>">
            <input type="hidden" name="classid" value="<?php echo $id ?>">
            <input type="submit" name="edit" value="Edit Class">
        </form>
    </div>

    <?php include "../footer.php"; ?>

    <script src="../main.js"></script>
    <!--ICONIFY CDN-->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</body>

</html>