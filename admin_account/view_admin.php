<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:../index.php');
}
include "../connection.php";
include "../functions.php";

$AdminID = $_SESSION['admin_id'];

$getbio = getAdminProfile($AdminID);

if (isset($_POST['delete'])) {
    $record_id = $_POST['delete_record'];
    $delete_Admin = deleteAdmin($record_id);
    if ($delete_Admin == true) {
        $message[] = "Record deleted successfully!";
    } else {
        $error[] = "Server ERROR!!!!!!!!!!!!!!!!!!!11";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        .delete-btn {
            background: none;
            border: none;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>View Admin</title>
</head>

<body>
    <div class="view-activity">
        <div class="sidebar" id="side-bar">
            <div class="identify">
                <p>AMS</p>
            </div>
            <!-- End of LOGO -->
            <nav>
                <div class="item">
                    <a href="../admin.php">Dashboard</a>
                </div>

                <div class="item">
                    <a href="../admin_account/view-students.php">Students</a>
                </div>

                <div class="item">
                    <a href="../admin_account/view-teacher.php">Teachers</a>
                </div>

                <div class="item">
                    <a href="../admin_account/view-classes.php">Classes</a>
                </div>

                <div class="item">
                    <a href="subjects.php">Subjects</a>
                </div>

                <div class="item">
                    <a href="timetable.php">Class Schedule</a>
                </div>

                <div class="item">
                    <a href="../admin_account/View-attendance.php">Attendance</a>
                </div>

                <div class="item">
                    <a href="../admin_account/view-absence.php">Abscence Requests</a>
                </div>

                <div class="item">
                    <a href="notifications.php">Notifications</a>
                </div>

                <div class="item">
                    <a class="active" href="../admin_account/view_admin.php">My Profile</a>
                </div>

                <a href="../logout.php">
                    <button><span class="iconify" data-icon="mingcute:power-fill"></span>Logout</button>
                </a>
            </nav>
        </div>
        <!-- End of sidebar -->

        <div class="container">
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
            <div class="top">
                <div class="west">
                    <div class="menu-icon" id="toggle-btn">
                        <span class="iconify" data-icon="ep:menu"></span>
                    </div>
                    <div class="date">
                        <?php echo date("Y/m/d") ?>
                    </div>
                </div>

                <div class="right">
                    <a href="../admin_account/add-admin.php">
                        <button>Add New Admin<span class="iconify" data-icon="mdi:account-add"></span></button>
                    </a>
                </div>
            </div>

            <h1 style="color: var(--color-primary); margin-top: 2rem;">My profile-Admin</h1>

            <div class="admin-box">
                <div class="admin-card">
                    <div class="img">
                        <img src="../images/<?php echo $getbio['image'] ?>" alt="profile picture">
                    </div>
                    <div class="bio">
                        <p>Full Name: <span><?php echo $getbio['Firstname'] . ' ' . $getbio['Lastname'] ?></span></p>
                        <p>Email: <span><?php echo $getbio['Email'] ?></span></p>
                        <p>Contact: <span><?php echo $getbio['Contact'] ?></span></p>
                        <p>Username: <span><?php echo $getbio['username'] ?></span></p>
                        <a href="edit-profile.php?id=<?= $getbio['AdminID']; ?>&fn=<?= $getbio['Firstname']; ?>&ln=<?= $getbio['Lastname']; ?>&em=<?= $getbio['Email']; ?>&tel=<?= $getbio['Contact']; ?>&uname=<?= $getbio['username']; ?>&img=<?= $getbio['image']; ?>">
                            <button>Edit Profile</button>
                        </a>
                        <a href="edit-cred.php?id=<?= $getbio['AdminID']; ?>">
                            <button>Edit Login Credentals</button>
                        </a>
                    </div>
                </div>
            </div>

            <h2 style="margin-top: 3rem; color: var(--color-primary);">Other Admins</h2>

            <div class="table-activity">
                <table>
                    <tr>
                        <th>AdminID</th>
                        <th>Image</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Delete</th>
                    </tr>

                    <?php
                    $admins = getadmin($AdminID);
                    foreach ($admins as $admin) {
                    ?>
                        <tr>
                            <td><?php echo $admin['AdminID'] ?></td>
                            <td><img src="../images/<?php echo $admin['image'] ?>" width="100px" height="100px" alt="profile img"></td>
                            <td><?php echo $admin['Firstname'] ?></td>
                            <td><?php echo $admin['Lastname'] ?></td>
                            <td><?php echo $admin['Email'] ?></td>
                            <td><?php echo $admin['Contact'] ?></td>
                            <td><?php echo $admin['username'] ?></td>
                            <td><?php echo $admin['password'] ?></td>
                            <td>
                                <form action="view_admin.php" method="post" onsubmit="return confirm('Are you sure you want to delete this Admin? This Action is irreversible!')">
                                    <input type="hidden" name="delete_record" value="<?php echo $admin['AdminID']; ?>">
                                    <Button class="delete-btn" name="delete" type="submit">
                                        <span class="iconify" data-icon="fluent:delete-24-filled"></span>
                                    </Button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <?php include "../footer.php"; ?>
    <!--ICONIFY CDN-->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <script src="../main.js"></script>

    <!--DOCUMENT JS-->
    <script>
        // Select the button and the item to display
        const showButton = document.getElementById('toggle-btn');
        const itemToDisplay = document.getElementById('side-bar');

        // Add a click event listener to the button
        showButton.addEventListener('click', function() {
            itemToDisplay.classList.toggle('active');
        });
    </script>
</body>

</html>