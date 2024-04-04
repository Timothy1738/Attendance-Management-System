<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}
include "../connection.php";

if (isset($_POST['add'])) {

    $className = $_POST['classname'];
    $year = $_POST['year'];
    $classTrID = $_POST['teacherID'];
    

    $sql = "INSERT INTO `classes`(`ClassName`, `Year`, `ClassTeacherID`) VALUES ('$className','$year','$classTrID')";

    if (mysqli_query($conn, $sql)) {
        $message[] = "New Class Added Successfully";
    } else {
        $error[] = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Add Class</title>
</head>

<body>
    <div class="add-activity">
        <a href="../admin_account/view-classes.php">
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
            <h2>Add Teacher</h2>
            <div class="form-body">

                <input type="text" placeholder="Class Name" name="classname" required>
                <input type="number" placeholder="Year" name="year" required>
                <input type="number" placeholder="Class Teacher ID" name="teacherID" required>
            </div>
            <input type="submit" name="add" value="Add Class">
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