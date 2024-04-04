<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}
include "../connection.php";

include "../functions.php";

$subjectID = $_GET['id'];
$subjectname =  $_GET['name'];

if (isset($_POST['edit'])) {

    $id = $_POST['id'];
    $sub_name = $_POST['sub_name'];

    $edit = editSubjectName($id, $sub_name);

    if ($edit == true) {
        $message[] = "Subject Name Changed successfully!";
    } else {
        $error[] = "Failed to edit Record!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Edit Shedule</title>
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
            <h2>Edit Subject</h2>
            <input type="text" placeholder="Subject Name" name="sub_name" value="<?php echo $subjectname ?>" required>

            <input type="hidden" name="id" value="<?php echo $subjectID ?>">
            <input type="submit" name="edit" value="Edit Subject">
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