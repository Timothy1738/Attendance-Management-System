<?php
include "connection.php";

/*=====================
=======================STUDENT ACCOUNT FUNCTIONS===========================
=======================*/
//FUNCTIONS FOR STUDENTS TO SEE ATTENDANCE

function insert_adminNotification($admin_message, $admin_state, $studentID)
{
    global $conn;
    $sql = "INSERT INTO `admin_notification`(`message`, `status`, `user_id`) VALUES ('$admin_message','$admin_state','$studentID')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "true";
    }
    return "false";
}

function insert_adminNotification_std_pass_change($admin_text, $admin_status, $studentID)
{
    global $conn;
    $sql = "INSERT INTO `admin_notification`(`message`, `status`, `user_id`) VALUES ('$admin_text','$admin_status','$studentID')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "true";
    }
    return "false";
}

function insert($studentID, $status, $Adate, $subjects, $reason,)
{
    global $conn;
    $sql = "INSERT INTO `absencerequests`(`StudentID`, `RequestDate`, `AbsenceDate`, `Reasons`, `SubjectID`, `status`, `ApproverID`, `Time_stamp`) 
    VALUES ('$studentID',NOW(),'$Adate','$reason','$subjects','$status','',NOW())";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "Request Submitted Successfully";
    } else {
        return mysqli_error($conn);
    }
}


function insertNotifications($subjects, $studentID, $text, $state)
{
    global $conn;
    $sql = "INSERT INTO `teacher_notification`(`Subject_ID`, `StudentID`, `notification`, `status`) 
    VALUES ('$subjects', '$studentID', '$text','$state')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return "Error";
    }
}

#period 1
function Period1()
{
    global $conn;
    global $studentID;
    $dateToday = date('Y-m-d');
    $sql = "SELECT `IsPresent` FROM `attendancerecords` WHERE `Date` = '$dateToday' AND `StudentID` = '$studentID' AND `Period` = 1";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_array($res);
        $result = $row['IsPresent'];
        return $result;
    } else {
        return "No Entry Yet";
    }
}

#period 2
function Period2()
{
    global $conn;
    global $studentID;
    $dateToday = date('Y-m-d');
    $sql = "SELECT `IsPresent` FROM `attendancerecords` WHERE `Date` = '$dateToday' AND `StudentID` = '$studentID' AND `Period` = 2";
    $value = mysqli_query($conn, $sql);

    if (mysqli_num_rows($value) > 0) {
        $row = mysqli_fetch_array($value);
        $res = $row['IsPresent'];
        return $res;
    } else {
        return "No Entry Yet";
    }
}

#period 3
function Period3()
{
    global $conn;
    global $studentID;
    $dateToday = date('Y-m-d');
    $sql = "SELECT `IsPresent` FROM `attendancerecords` WHERE `Date` = '$dateToday' AND `StudentID` = '$studentID' AND `Period` = 3";
    $resultfor3 = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultfor3) > 0) {
        $row = mysqli_fetch_array($resultfor3);
        return $row;
    } else {
        return "No Entry Yet";
    }
}

#period 4
function Period4()
{
    global $conn;
    global $studentID;
    $dateToday = date('Y-m-d');
    $sql = "SELECT `IsPresent` FROM `attendancerecords` WHERE `Date` = '$dateToday' AND `StudentID` = '$studentID' AND `Period` = 4";
    $resultfor4 = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultfor4) > 0) {
        $row = mysqli_fetch_array($resultfor4);
        return $row;
    } else {
        return "No Entry Yet";
    }
}

function getMessages()
{
    global $conn;
    global $class;
    $sql = "SELECT
    m.*,
    t.Firstname,
    t.Lastname,
    t.Image
    FROM `messages` AS m
    JOIN `teachers` AS t ON m.TeacherID = t.TeacherID
    WHERE `ClassID` = $class";

    $result = mysqli_query($conn, $sql);

    $messagesArray = [];
    while ($row = mysqli_fetch_array($result)) {
        $messagesArray[] = $row;
    }
    return $messagesArray;
}
function myAttendanceStudent($studentID)
{
    global $conn;
    $sql = "SELECT ar.Date,
    ar.IsPresent, 
    ar.Period,
    t.Firstname,
    s.SubjectName,
    t.Lastname FROM attendancerecords AS ar 
    JOIN subjects AS s ON ar.SubjectID = s.SubjectID 
    JOIN teachers AS t ON ar.TeacherID = t.TeacherID
     WHERE ar.StudentID = $studentID;";

    $result = mysqli_query($conn, $sql);

    $myAttArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $myAttArray[] = $row;
        }
        return $myAttArray;
    }
    return false;
}

function myAttenenceExtraLessons($studentID)
{
    global $conn;
    $sql = "SELECT ar.OverrideDate, 
    ar.IsPresent, 
    t.Firstname, 
    t.Lastname, 
    s.SubjectName 
    FROM attendanceoverrides AS ar 
    JOIN subjects AS s ON ar.SubjectID = s.SubjectID 
    JOIN teachers AS t ON ar.TeacherID = t.TeacherID 
    WHERE ar.StudentID = $studentID";

    $result = mysqli_query($conn, $sql);

    $myAttArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $myAttArray[] = $row;
        }
        return $myAttArray;
    }
    return false;
}


// function to get s1 students
function getS1()
{
    global $conn;
    $sql = "SELECT 
    s.*,
    c.ClassName
    FROM
    `students` AS s
    JOIN classes as c ON s.ClassID = c.ClassID
    WHERE s.ClassID = 1";

    $res = mysqli_query($conn, $sql);

    $std_array = [];
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_array($res)) {
            $std_array[] = $row;
        }
        return $std_array;
    }
}

// function to get s2 students
function getS2()
{
    global $conn;
    $sql = "SELECT 
    s.*,
    c.ClassName
    FROM
    `students` AS s
    JOIN classes as c ON s.ClassID = c.ClassID
    WHERE s.ClassID = 2";

    $res = mysqli_query($conn, $sql);

    $std_array = [];
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_array($res)) {
            $std_array[] = $row;
        }
        return $std_array;
    }
}

// function to get s3 students
function getS3()
{
    global $conn;
    $sql = "SELECT 
    s.*,
    c.ClassName
    FROM
    `students` AS s
    JOIN classes as c ON s.ClassID = c.ClassID
    WHERE s.ClassID = 3";

    $res = mysqli_query($conn, $sql);

    $std_array = [];
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_array($res)) {
            $std_array[] = $row;
        }
        return $std_array;
    }
}

// function to get s4 students
function getS4()
{
    global $conn;
    $sql = "SELECT 
    s.*,
    c.ClassName
    FROM
    `students` AS s
    JOIN classes as c ON s.ClassID = c.ClassID
    WHERE s.ClassID = 4";

    $res = mysqli_query($conn, $sql);

    $std_array = [];
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_array($res)) {
            $std_array[] = $row;
        }
        return $std_array;
    }
}

// function to get s5 students
function getS5()
{
    global $conn;
    $sql = "SELECT 
    s.*,
    c.ClassName
    FROM
    `students` AS s
    JOIN classes as c ON s.ClassID = c.ClassID
    WHERE s.ClassID = 5";

    $res = mysqli_query($conn, $sql);

    $std_array = [];
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_array($res)) {
            $std_array[] = $row;
        }
        return $std_array;
    }
}


// function to get s5 students
function getS6()
{
    global $conn;
    $sql = "SELECT 
    s.*,
    c.ClassName
    FROM
    `students` AS s
    JOIN classes as c ON s.ClassID = c.ClassID
    WHERE s.ClassID = 6";

    $res = mysqli_query($conn, $sql);

    $std_array = [];
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_array($res)) {
            $std_array[] = $row;
        }
        return $std_array;
    }
}

// get o-level Time table
function getschedule()
{
    $currentDay = date('l');
    global $conn;
    $sql = "SELECT * FROM `o-level` WHERE `Day` = '$currentDay'";
    $execute = mysqli_query($conn, $sql);

    if (mysqli_num_rows($execute) > 0) {
        $row = mysqli_fetch_array($execute);
        return $row;
    } else {
        return "Its A weekend";
    }
}

// get A-level Time table
function getscheduleAlevel()
{
    $currentDay = date('l');
    global $conn;
    $sql = "SELECT * FROM `a-level` WHERE `Day` = '$currentDay'";
    $execute = mysqli_query($conn, $sql);

    if (mysqli_num_rows($execute) > 0) {
        $row = mysqli_fetch_array($execute);
        return $row;
    } else {
        return "Its A weekend";
    }
}

function getperiods()
{
    global $conn;
    $sql = "SELECT * FROM `absence_status`";
    $result = mysqli_query($conn, $sql);

    $data = mysqli_fetch_array($result);
    return $data;
}

//get_teachers details GLOBAL FUNCTION
function get_teachers()
{
    global $conn;
    $sql = "SELECT
    t.*,
    s.Subjectname
FROM
    teachers AS t
JOIN
    subjects AS s ON t.SubjectID = s.SubjectID;
";
    $result = mysqli_query($conn, $sql);

    $teacherdata = array();
    while ($row = mysqli_fetch_array($result)) {
        array_push($teacherdata, $row);
    }
    return $teacherdata;
}


////////////////////////////////////////////////
// TEACHERS ACCOUNT FUNCTIONS
////////////////////////////////////////////////

function insert_adminNotification_teacher_takeAtt($admin_msg, $admin_state, $TeachersID)
{
    global $conn;
    $sql = "INSERT INTO `admin_notification`(`message`, `status`, `user_id`) VALUES ('$admin_msg','$admin_state','$TeachersID')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "true";
    }
    return "false";
}

function getTeachernotification($subjectID)
{
    global $conn;
    $sql = "SELECT tn.*, s.FirstName, s.LastName FROM teacher_notification AS tn
    JOIN students AS s ON tn.StudentID = s.StudentID
    WHERE tn.status = 0 AND tn.Subject_ID = '$subjectID'";
    $res = mysqli_query($conn, $sql);

    $teacherNotificationArray = [];
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_array($res)) {
            $teacherNotificationArray[] = $row;
        }
        return $teacherNotificationArray;
    } else {
        return "empty!";
    }
}

// var_dump(getTeachernotification($subjectID));
function SubjectName($TeachersID)
{
    global $conn;
    $sql = "SELECT s.SubjectName
    FROM teachers AS t
    JOIN subjects AS s ON t.SubjectID = s.SubjectID
    WHERE t.TeacherID = $TeachersID";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $subjectname = $row['SubjectName'];
        return $subjectname;
    }
    return false;
}

//Period one subject O-level Schedule
function periodOneSubject()
{
    $currentDay = date('l');
    global $conn;
    $sql = "SELECT subject_1 FROM `o-level` WHERE `Day` = '$currentDay'";
    $execute = mysqli_query($conn, $sql);

    if (mysqli_num_rows($execute) > 0) {
        $row = mysqli_fetch_array($execute);
        $subject = $row['subject_1'];
        return $subject;
    } else {
        return "SERVER ERROR";
    }
}

//Period two subject O-level Schedule
function periodTwoSubject()
{
    $currentDay = date('l');
    global $conn;
    $sql = "SELECT subject_2 FROM `o-level` WHERE `Day` = '$currentDay'";
    $execute = mysqli_query($conn, $sql);

    if (mysqli_num_rows($execute) > 0) {
        $row = mysqli_fetch_array($execute);
        $subject = $row['subject_2'];
        return $subject;
    } else {
        return "SERVER ERROR";
    }
}

//Period three subject O-level Schedule
function periodThreeSubject()
{
    $currentDay = date('l');
    global $conn;
    $sql = "SELECT subject_3 FROM `o-level` WHERE `Day` = '$currentDay'";
    $execute = mysqli_query($conn, $sql);

    if (mysqli_num_rows($execute) > 0) {
        $row = mysqli_fetch_array($execute);
        $subject = $row['subject_3'];
        return $subject;
    } else {
        return "SERVER ERROR";
    }
}


//Period three subject O-level Schedule
function periodfourSubject()
{
    $currentDay = date('l');
    global $conn;
    $sql = "SELECT subject_4 FROM `o-level` WHERE `Day` = '$currentDay'";
    $execute = mysqli_query($conn, $sql);

    if (mysqli_num_rows($execute) > 0) {
        $row = mysqli_fetch_array($execute);
        $subject = $row['subject_4'];
        return $subject;
    } else {
        return "SERVER ERROR";
    }
}

//A LEVEL ROUTINE
//Period one subject O-level Schedule
function periodOneSubject_Alevel()
{
    $currentDay = date('l');
    global $conn;
    $sql = "SELECT subject_1 FROM `a-level` WHERE `Day` = '$currentDay'";
    $execute = mysqli_query($conn, $sql);

    if (mysqli_num_rows($execute) > 0) {
        $row = mysqli_fetch_array($execute);
        $subject = $row['subject_1'];
        return $subject;
    } else {
        return "SERVER ERROR";
    }
}

//Period two subject A-level Schedule
function periodTwoSubject_Alevel()
{
    $currentDay = date('l');
    global $conn;
    $sql = "SELECT subject_2 FROM `a-level` WHERE `Day` = '$currentDay'";
    $execute = mysqli_query($conn, $sql);

    if (mysqli_num_rows($execute) > 0) {
        $row = mysqli_fetch_array($execute);
        $subject = $row['subject_2'];
        return $subject;
    } else {
        return "SERVER ERROR";
    }
}

//Period three subject A-level Schedule
function periodThreeSubject_Alevel()
{
    $currentDay = date('l');
    global $conn;
    $sql = "SELECT subject_3 FROM `a-level` WHERE `Day` = '$currentDay'";
    $execute = mysqli_query($conn, $sql);

    if (mysqli_num_rows($execute) > 0) {
        $row = mysqli_fetch_array($execute);
        $subject = $row['subject_3'];
        return $subject;
    } else {
        return "SERVER ERROR";
    }
}


//Period three subject A-level Schedule
function periodfourSubject_Alevel()
{
    $currentDay = date('l');
    global $conn;
    $sql = "SELECT subject_4 FROM `a-level` WHERE `Day` = '$currentDay'";
    $execute = mysqli_query($conn, $sql);

    if (mysqli_num_rows($execute) > 0) {
        $row = mysqli_fetch_array($execute);
        $subject = $row['subject_4'];
        return $subject;
    } else {
        return "SERVER ERROR";
    }
}



//////////FUNCTIONS FOR ATTENDANCE/////
function getAttendanceRecordsS1($teacherID)
{
    global $conn;
    $sql = "SELECT
    ar.*,
    s.FirstName,
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName,
    sub.SubjectName
    FROM `attendancerecords` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID
    JOIN `subjects` AS sub ON ar.SubjectID = sub.SubjectID
    WHERE c.ClassID = 1 AND t.TeacherID = $teacherID";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}

function getAttendanceRecordsS2($teacherID)
{
    global $conn;
    $sql = "SELECT
    ar.*,
    s.FirstName,
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName,
    sub.SubjectName
    FROM `attendancerecords` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID
    JOIN `subjects` AS sub ON ar.SubjectID = sub.SubjectID
    WHERE c.ClassID = 2 AND t.TeacherID = $teacherID";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}

function getAttendanceRecordsS3($teacherID)
{
    global $conn;
    $sql = "SELECT
    ar.*,
    s.FirstName,
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName,
    sub.SubjectName
    FROM `attendancerecords` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID
    JOIN `subjects` AS sub ON ar.SubjectID = sub.SubjectID
    WHERE c.ClassID = 3 AND t.TeacherID = $teacherID";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}

function getAttendanceRecordsS4($teacherID)
{
    global $conn;
    $sql = "SELECT
    ar.*,
    s.FirstName,
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName,
    sub.SubjectName
    FROM `attendancerecords` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID
    JOIN `subjects` AS sub ON ar.SubjectID = sub.SubjectID
    WHERE c.ClassID = 4 AND t.TeacherID = $teacherID";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}

function getAttendanceRecordsS5($teacherID)
{
    global $conn;
    $sql = "SELECT
    ar.*,
    s.FirstName,
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName,
    sub.SubjectName
    FROM `attendancerecords` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID
    JOIN `subjects` AS sub ON ar.SubjectID = sub.SubjectID
    WHERE c.ClassID = 5 AND t.TeacherID = $teacherID";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}

function getAttendanceRecordsS6($teacherID)
{
    global $conn;
    $sql = "SELECT
    ar.*,
    s.FirstName,
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName,
    sub.SubjectName
    FROM `attendancerecords` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID
    JOIN `subjects` AS sub ON ar.SubjectID = sub.SubjectID
    WHERE c.ClassID = 6 AND t.TeacherID = $teacherID";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}

//used both in teacher and ADMIN TO FETCH RECORD
function getRecord($recordID)
{
    global $conn;
    $sql = "SELECT
        attendancerecords.RecordID,
        attendancerecords.StudentID,
        attendancerecords.IsPresent,
        students.FirstName,
        students.LastName
        FROM attendancerecords
        JOIN students ON attendancerecords.StudentID = students.studentID
        WHERE RecordID = $recordID";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $record = mysqli_fetch_assoc($result);
        return $record;
    } else {
        return "SERVER ERROR";
    }
}


function fetchOleveTimeTable()
{
    global $conn;
    $sql = "SELECT * FROM `o-level`";
    $result = mysqli_query($conn, $sql);

    $olevelTableArray = [];
    while ($columns = mysqli_fetch_array($result)) {
        $olevelTableArray[] = $columns;
    }
    return $olevelTableArray;
}

function fetchAleveTimeTable()
{
    global $conn;
    $sql = "SELECT * FROM `a-level`";
    $result = mysqli_query($conn, $sql);

    $AlevelTableArray = [];
    while ($ROWS = mysqli_fetch_array($result)) {
        $AlevelTableArray[] = $ROWS;
    }
    return $AlevelTableArray;
}

function getTeacher($teacherID)
{
    global $conn;
    // global $teacherID;

    $sql = "SELECT 
    teachers.*,
    subjects.Subjectname FROM `teachers` JOIN subjects ON teachers.SubjectID = subjects.SubjectID WHERE `TeacherID` = $teacherID";
    $result = mysqli_query($conn, $sql);

    $teachersArray = [];
    while ($rows = mysqli_fetch_array($result)) {
        $teachersArray[] = $rows;
    }
    return $teachersArray;
}

//function to edit teacher's Credentials
function editprofileTeacher($id, $firstname, $lastname, $contact, $email, $image)
{
    global $conn;
    $sql = "UPDATE `teachers` SET `Image`='$image',`Firstname`='$firstname',`Lastname`='$lastname',`ContactNumber`='$contact',`Email`='$email' WHERE `TeacherID`='$id'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "yes";
    } else {
        return false;
    }
}

//all students from s1
function allStudentsFromSeniorOne()
{
    global $conn;
    $sql = "SELECT * FROM `students` WHERE `ClassID` = 1";
    $result = mysqli_query($conn, $sql);

    $s1students = [];
    while ($row = mysqli_fetch_array($result)) {
        $s1students[] = $row;
        $totals1 = count($s1students);
    }
    return $totals1;
}

//all students from s2
function allStudentsFromSeniorTwo()
{
    global $conn;
    $sql = "SELECT * FROM `students` WHERE `ClassID` = 2";
    $result = mysqli_query($conn, $sql);

    $s2students = [];
    while ($row = mysqli_fetch_array($result)) {
        $s2students[] = $row;
        $totals2 = count($s2students);
    }
    return $totals2;
}

//all students from s3
function allStudentsFromSeniorThree()
{
    global $conn;
    $sql = "SELECT * FROM `students` WHERE `ClassID` = 3";
    $result = mysqli_query($conn, $sql);

    $s3students = [];
    while ($row = mysqli_fetch_array($result)) {
        $s3students[] = $row;
        $totals3 = count($s3students);
    }
    return $totals3;
}

// var_dump(allStudentsFromSeniorThree());

//all students from s4
function allStudentsFromSeniorFour()
{
    global $conn;
    $sql = "SELECT * FROM `students` WHERE `ClassID` = 4";
    $result = mysqli_query($conn, $sql);

    $s4students = [];
    while ($row = mysqli_fetch_array($result)) {
        $s4students[] = $row;
        $totals4 = count($s4students);
    }
    return $totals4;
}

//all students from s5
function allStudentsFromSeniorFive()
{
    global $conn;
    $sql = "SELECT * FROM `students` WHERE `ClassID` = 5";
    $result = mysqli_query($conn, $sql);

    $s1students = [];
    while ($row = mysqli_fetch_array($result)) {
        $s1students[] = $row;
        $totals5 = count($s1students);
    }
    return $totals5;
}

//all students from s1
function allStudentsFromSeniorSix()
{
    global $conn;
    $sql = "SELECT * FROM `students` WHERE `ClassID` = 6";
    $result = mysqli_query($conn, $sql);

    $s6students = [];
    while ($row = mysqli_fetch_array($result)) {
        $s6students[] = $row;
        $totals6 = count($s6students);
    }
    return $totals6;
}

//totalstudents

function totalnumberofstudents()
{
    global $conn;
    $sql = "SELECT * FROM `students`";
    $result = mysqli_query($conn, $sql);

    $allstudents = [];
    while ($row = mysqli_fetch_array($result)) {
        $allstudents[] = $row;
        $total = count($allstudents);
    }
    return $total;
}

//get classteacherName
function getClassTeacherSeniorOne()
{
    global $conn;
    $sql = "SELECT classes.*, teachers.Firstname, Teachers.Lastname
    FROM classes JOIN teachers ON classes.ClassTeacherID = teachers.TeacherID
    WHERE ClassID = 1 ";

    $result = mysqli_query($conn, $sql);

    // if(!$result) {
    //     echo mysqli_error($conn);
    // }else {
    //     echo "proceed";
    // }
    $classS1 = [];
    while ($rows = mysqli_fetch_array($result)) {
        $classS1[] = $rows;
    }
    return $classS1;
}

function getClassTeacherSeniorTwo()
{
    global $conn;
    $sql = "SELECT classes.*, teachers.Firstname, Teachers.Lastname
    FROM classes JOIN teachers ON classes.ClassTeacherID = teachers.TeacherID
    WHERE ClassID = 2 ";

    $result = mysqli_query($conn, $sql);

    // if(!$result) {
    //     echo mysqli_error($conn);
    // }else {
    //     echo "proceed";
    // }
    $classS2 = [];
    while ($rows = mysqli_fetch_array($result)) {
        $classS2[] = $rows;
    }
    return $classS2;
}

function getClassTeacherSeniorThree()
{
    global $conn;
    $sql = "SELECT classes.*, teachers.Firstname, Teachers.Lastname
    FROM classes JOIN teachers ON classes.ClassTeacherID = teachers.TeacherID
    WHERE ClassID = 3 ";

    $result = mysqli_query($conn, $sql);

    // if(!$result) {
    //     echo mysqli_error($conn);
    // }else {
    //     echo "proceed";
    // }
    $classS3 = [];
    while ($rows = mysqli_fetch_array($result)) {
        $classS3[] = $rows;
    }
    return $classS3;
}

function getClassTeacherSeniorFour()
{
    global $conn;
    $sql = "SELECT classes.*, teachers.Firstname, Teachers.Lastname
    FROM classes JOIN teachers ON classes.ClassTeacherID = teachers.TeacherID
    WHERE ClassID = 4 ";

    $result = mysqli_query($conn, $sql);

    // if(!$result) {
    //     echo mysqli_error($conn);
    // }else {
    //     echo "proceed";
    // }
    $classS4 = [];
    while ($rows = mysqli_fetch_array($result)) {
        $classS4[] = $rows;
    }
    return $classS4;
}

function getClassTeacherSeniorFive()
{
    global $conn;
    $sql = "SELECT classes.*, teachers.Firstname, Teachers.Lastname
    FROM classes JOIN teachers ON classes.ClassTeacherID = teachers.TeacherID
    WHERE ClassID = 5 ";

    $result = mysqli_query($conn, $sql);

    // if(!$result) {
    //     echo mysqli_error($conn);
    // }else {
    //     echo "proceed";
    // }
    $classS5 = [];
    while ($rows = mysqli_fetch_array($result)) {
        $classS5[] = $rows;
    }
    return $classS5;
}

function getClassTeacherSeniorSix()
{
    global $conn;
    $sql = "SELECT classes.*, teachers.Firstname, Teachers.Lastname
    FROM classes JOIN teachers ON classes.ClassTeacherID = teachers.TeacherID
    WHERE ClassID = 6 ";

    $result = mysqli_query($conn, $sql);

    // if(!$result) {
    //     echo mysqli_error($conn);
    // }else {
    //     echo "proceed";
    // }
    $classS6 = [];
    while ($rows = mysqli_fetch_array($result)) {
        $classS6[] = $rows;
    }
    return $classS6;
}

//get student profile
function fetchStudentProfile($studentID)
{
    global $conn;
    $sql = "SELECT students.*, classes.ClassName FROM students JOIN classes ON students.ClassID = classes.ClassID WHERE StudentID = $studentID";
    $result = mysqli_query($conn, $sql);

    $stdprofileArray = [];
    while ($row = mysqli_fetch_array($result)) {
        $stdprofileArray[] = $row;
    }
    return $stdprofileArray;
}

//ABSENCE REQUEST FUNCTIONS
//GET ABSENCE REQUESTS FOR REVIEW
function getAbsenceRequestsForReview()
{
    global $conn;
    $teachersID = $_SESSION['teacher_id'];

    $sql = "SELECT
    ar.*, s.FirstName, s.LastName, s.image
FROM
    absencerequests AS ar
JOIN
    students AS s ON ar.StudentID = s.StudentID
JOIN
    teachers AS t ON ar.SubjectID = t.SubjectID
WHERE
    t.TeacherID = '$teachersID'
    AND ar.status = 'Pending';
";

    $result = $conn->query($sql);

    $absencerequests = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $absencerequests[] = $row;
        }
    }
    return $absencerequests;
}

// var_dump(getAbsenceRequestsForReview());


//FUNCTION TO FETCH REQUESTS THAT HAVE BEEN DENIED OR APPROVED
function getReviewedRequests()
{
    global $conn;
    $approverID = $_SESSION['teacher_id'];
    $sql = "SELECT ar.*, s.FirstName, s.LastName, s.image FROM absencerequests ar JOIN
    students s ON ar.StudentID = s.StudentID WHERE ar.status != 'Pending' AND ar.ApproverID = $approverID";
    $status = $conn->query($sql);
    $reviewedRequests = [];

    if ($status->num_rows > 0) {
        while ($row = $status->fetch_assoc()) {
            $reviewedRequests[] = $row;
        }
    }
    return $reviewedRequests;
}

// var_dump(getReviewedRequests());

function getReviewedRequestsByID($recordID)
{
    global $conn;
    $sql = "SELECT ar.RequestID, ar.status, s.FirstName, s.LastName FROM absencerequests AS ar JOIN
    students AS s ON ar.StudentID = s.StudentID 
    WHERE ar.status != 'Pending' AND ar.RequestID = $recordID";
    $status = $conn->query($sql);
    $reviewedRequests = [];

    if ($status->num_rows > 0) {
        while ($row = $status->fetch_assoc()) {
            $reviewedRequests[] = $row;
        }
    }
    return $reviewedRequests;
}

//edit attendance
function editAbsenceRequest($status, $ID)
{
    global $conn;
    $sql = "UPDATE `absencerequests` SET `status`= '$status' WHERE `RequestID` = '$ID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "success";
    } else {
        return false;
    }
}

//delete record from attendance table
function deleteRecordfromAbsenceRequestTable($id)
{
    global $conn;
    $sql = "DELETE FROM `absencerequests` WHERE `RequestID` = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "success";
    } else {
        return false;
    }
}

/*=====================
=======================ADMIN ACCOUNT FUNCTIONS===========================
=======================*/

//delete record from attendance table
function deleteRecord($id)
{
    global $conn;
    $sql = "DELETE FROM `attendancerecords` WHERE `RecordID` = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "success";
    } else {
        return false;
    }
}

//edit attendance
function edit($status, $ID)
{
    global $conn;
    $sql = "UPDATE `attendancerecords` SET `IsPresent`='$status' WHERE `RecordID` = '$ID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "success";
    } else {
        return false;
    }
}

//getrecord for extra lessons to supply edit form
function getRecordExtralessons($recordID)
{
    global $conn;
    $sql = "SELECT attendanceoverrides.OverrideID, 
    attendanceoverrides.StudentID, 
    attendanceoverrides.IsPresent, 
    students.FirstName, students.LastName 
    FROM attendanceoverrides JOIN students ON attendanceoverrides.StudentID = students.studentID 
    WHERE OverrideID = $recordID";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $record = mysqli_fetch_assoc($result);
        return $record;
    } else {
        return "SERVER ERROR";
    }
}

//edit attendance
function ExtraLessonsEdited($status, $ID)
{
    global $conn;
    $sql = "UPDATE `attendanceoverrides` SET `IsPresent`='$status' WHERE `OverrideID` = '$ID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "success";
    } else {
        return false;
    }
}

//fetch attendance records for display
function getAttendanceRecordsExtraLessons($teacherID)
{
    global $conn;
    $sql = "SELECT
    ar.*,
    s.FirstName, 
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName
    FROM `attendanceoverrides` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID
    WHERE t.TeacherID = $teacherID";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}

//delete record from attendance overrides table
function deleteRecordExtraLesson($id)
{
    global $conn;
    $sql = "DELETE FROM `attendanceoverrides` WHERE `OverrideID` = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "success";
    } else {
        return false;
    }
}

function getAttendanceRecordsS1AdminAcc()
{
    global $conn;
    $sql = "SELECT
    ar.*,
    s.FirstName,
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName
    FROM `attendancerecords` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID
    WHERE c.ClassID = 1";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}


function studentsAttendanceSenior2()
{
    global $conn;
    $sql = "SELECT
    ar.*,
    s.FirstName,
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName
    FROM `attendancerecords` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID
    WHERE c.ClassID = 2";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}

function attendanceS3()
{
    global $conn;
    $sql = "SELECT
    ar.*,
    s.FirstName,
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName
    FROM `attendancerecords` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID
    WHERE c.ClassID = 3";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}

function s4attendance()
{
    global $conn;
    $sql = "SELECT
    ar.*,
    s.FirstName,
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName
    FROM `attendancerecords` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID
    WHERE c.ClassID = 4";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}

function s5attendance()
{
    global $conn;
    $sql = "SELECT
    ar.*,
    s.FirstName,
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName
    FROM `attendancerecords` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID
    WHERE c.ClassID = 5";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}

function s6attendance()
{
    global $conn;
    $sql = "SELECT
    ar.*,
    s.FirstName,
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName
    FROM `attendancerecords` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID
    WHERE c.ClassID = 6";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}

//fetch attendance records for display
function ExtraLessons()
{
    global $conn;
    $sql = "SELECT
    ar.*,
    s.FirstName, 
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName
    FROM `attendanceoverrides` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}

//edit student records

function editstudent($studentid, $firstname, $lastname, $class, $dateOfBirth, $sex, $ad, $contact, $Email, $image)
{
    global $conn;
    $sql = "UPDATE `students` SET `image`='$image',`FirstName`='$firstname',`LastName`='$lastname',`ClassID`='$class',`DateOfBirth`='$dateOfBirth',`Gender`='$sex',`Address`='$ad',`ContactNumber`='$contact',`Email`='$Email'
    WHERE `StudentID`='$studentid'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "yes";
    } else {
        return false;
    }
}

//view students function
function fetchStudents()
{
    global $conn;
    $sql = "SELECT
    s.*,
    c.ClassName,
    c.ClassID
FROM
    students AS s
JOIN
    classes AS c ON s.ClassID = c.ClassID";
    $value = mysqli_query($conn, $sql);

    $studentsArray = [];
    if ($value->num_rows > 0) {
        while ($row = $value->fetch_assoc()) {
            $studentsArray[] = $row;
        }
    }
    return $studentsArray;
}

//function delete a student
function deleteStudent($studentID)
{
    global $conn;
    $sql = "DELETE FROM students WHERE StudentID = $studentID";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        return "yes";
    } else {
        return false;
    }
}

/*===============ADD STUDENT FUNCTIONS=================*/
function insert_teacher($fname, $lname, $contact, $email, $password, $username, $subjectTaught, $image)
{
    global $conn;
    $hashedpass = md5($password);
    $sql = "INSERT INTO `teachers`(`Image`, `Firstname`, `Lastname`, `ContactNumber`, `Email`, `SubjectID`, `password`, `username`)
    VALUES ('$image','$fname','$lname','$contact','$email','$subjectTaught', '$hashedpass', '$username')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        return true;
    } else {
        return false;
    }
}


function teacher_already_exists($email, $contact)
{
    global $conn;

    $sql = "SELECT * FROM `teachers` WHERE `Email` = '$email' OR `ContactNumber` = '$contact'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        return true;
    } else {
        return false;
    }
}

/*=============DELETE STUDENT ACROSS ALL TABLES=======*/
function deleteTeacherAll($teacherID)
{
    global $conn;
    try {
        // Prepare the queries
        $sql1 = "DELETE FROM `absencerequests` WHERE ApproverID = '$teacherID'";
        $sql2 = "DELETE FROM `attendanceoverrides` WHERE TeacherID = '$teacherID'";
        $sql3 = "DELETE FROM `attendancerecords` WHERE TeacherID = '$teacherID'";
        $sql4 = "DELETE FROM `teachers` WHERE TeacherID = '$teacherID'";

        //execute queries

        mysqli_query($conn, $sql1);

        mysqli_query($conn, $sql2);

        mysqli_query($conn, $sql3);

        mysqli_query($conn, $sql4);

        // Commit the changes made in the transaction
        mysqli_commit($conn);

        return "yes";
    } catch (Exception $e) {
        // Rollback the transaction on error
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    } finally {
        // Enable autocommit again
        mysqli_autocommit($conn, true);
    }
}

/*===============ADD STUDENT FUNCTIONS=================*/
function insert_student($image, $fname, $lname, $class, $DOB, $gender, $address, $contact, $email, $password, $username)
{
    global $conn;
    $hashedpass = md5($password);
    $sql = "INSERT INTO `students`(`image`, `Firstname`, `Lastname`, `ClassID`, `DateOfBirth`, `Gender`, `Address`, `ContactNumber`, `Email`, `password`, `username`)
    VALUES ('$image','$fname','$lname','$class','$DOB','$gender','$address','$contact','$email', '$hashedpass', '$username')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        return "yes";
    } else {
        return false;
    }
}


function student_already_exists($email, $contact)
{
    global $conn;

    $sql = "SELECT * FROM `students` WHERE `Email` = '$email' OR `ContactNumber` = '$contact'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        return "Email Exists";
    } else {
        return "proceed!";
    }
}

function checkIfUsernameExistsInAllTables($username, $email)
{
    global $conn;
    $tables = ["students", "admin", "teachers"];

    foreach ($tables as $table) {
        $query = "SELECT * FROM $table WHERE username = '$username' OR Email = '$email'";
        $result = $conn->query($query);

        if ($result === false) {
            die("Error in query: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            return "User Already Exists";
        }
    }

    return "Proceed";
}


// $username = "eduaord@gmail.com";
// $email = "";
// echo checkIfUsernameExistsInAllTables($username, $email);


/*=============DELETE STUDENT ACROSS ALL TABLES=======*/
function deleteStudentAll($studentID)
{
    global $conn;
    try {
        // Prepare the queries
        $sql1 = "DELETE FROM `absencerequests` WHERE StudentID = '$studentID'";
        $sql2 = "DELETE FROM `attendanceoverrides` WHERE StudentID = '$studentID'";
        $sql3 = "DELETE FROM `attendancerecords` WHERE StudentID = '$studentID'";
        $sql4 = "DELETE FROM `students` WHERE StudentID = '$studentID'";

        //execute queries

        mysqli_query($conn, $sql1);

        mysqli_query($conn, $sql2);

        mysqli_query($conn, $sql3);

        mysqli_query($conn, $sql4);

        // Commit the changes made in the transaction
        mysqli_commit($conn);

        return "yes";
    } catch (Exception $e) {
        // Rollback the transaction on error
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    } finally {
        // Enable autocommit again
        mysqli_autocommit($conn, true);
    }
}

/*=======EDIT TEACHER*/
function editteacher($id, $firstname, $lastname, $subject, $contact, $email, $image)
{
    global $conn;
    $sql = "UPDATE `teachers` SET `Image`='$image',`Firstname`='$firstname',`Lastname`='$lastname',`ContactNumber`='$contact',`Email`='$email',`SubjectID`='$subject' WHERE `TeacherID` = '$id'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

/*===================EDIT CLASSESS*/
function editClass($classID, $className, $year, $classTID)
{
    global $conn;
    $sql = "UPDATE `classes` SET `ClassName` = '$className', `Year` = '$year', `ClassTeacherID` = '$classTID' WHERE `ClassID` = '$classID'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

/*===================DELETE CLASSESS*/
function deleteClass($classID)
{
    global $conn;
    $sql = "DELETE FROM `classes` WHERE `ClassID` = '$classID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {

        return true;
    } else {
        return false;
    }
}

/*======EDIT TIMETABEL O-LEVEL======*/
function editOlevel($record_ID, $first_subject, $second_subject, $third_subject, $fourth_subject)
{
    global $conn;
    $sql = "UPDATE `o-level` SET `subject_1`='$first_subject',`subject_2`='$second_subject',`subject_3`='$third_subject',`subject_4`='$fourth_subject' WHERE `ID`='$record_ID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {

        return true;
    } else {
        return false;
    }
}

function editAlevel($record_ID, $first_subject, $second_subject, $third_subject, $fourth_subject)
{
    global $conn;
    $sql = "UPDATE `a-level` SET `subject_1`='$first_subject',`subject_2`='$second_subject',`subject_3`='$third_subject',`subject_4`='$fourth_subject' WHERE `ID`='$record_ID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function addScheduleAlevel($Day, $first_subject, $second_subject, $third_subject, $fourth_subject)
{
    global $conn;
    $sql = "INSERT INTO `a-level`(`Day`, `subject_1`, `subject_2`, `subject_3`, `subject_4`) 
    VALUES ('$Day','$first_subject','$second_subject','$third_subject','$fourth_subject')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function addScheduleOlevel($Day, $first_subject, $second_subject, $third_subject, $fourth_subject)
{
    global $conn;
    $sql = "INSERT INTO `o-level`(`Day`, `subject_1`, `subject_2`, `subject_3`, `subject_4`) 
    VALUES ('$Day','$first_subject','$second_subject','$third_subject','$fourth_subject')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function checkifDayExistsAlevel($Day)
{
    global $conn;
    $sql = "SELECT * FROM `a-level` WHERE `Day` = '$Day'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function checkifDayExistsOlevel($Day)
{
    global $conn;
    $sql = "SELECT * FROM `o-level` WHERE `Day` = '$Day'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function deleteAlevelschedule($record_id)
{
    global $conn;
    $sql = "DELETE FROM `a-level` WHERE ID = '$record_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

/*===ADMIN CRUD CHECKS AND INSERT===*/
function updateprofile($id, $firstname, $lastname, $contact, $email, $image)
{
    global $conn;
    $sql = "UPDATE `admin` SET `Firstname`='$firstname',`Lastname`='$lastname',`image`='$image',`Email`='$email',`Contact`='$contact' WHERE `AdminID`='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function updateCredentials($userid, $username, $password)
{
    global $conn;
    $newpass = md5($password);
    $sql = "UPDATE `admin` SET `username`='$username',`password`='$newpass' WHERE `AdminID`='$userid'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function checkIFusernameexists($email, $username, $tel)
{
    global $conn;
    $sql = "SELECT * FROM `admin` WHERE Email = '$email' OR username = '$username' OR Contact = '$tel'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}


function deleteOlevelschedule($record_id)
{
    global $conn;
    $sql = "DELETE FROM `o-level` WHERE ID = '$record_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function getAdminProfile($AdminID)
{
    global $conn;
    $sql = "SELECT * FROM `admin` WHERE `AdminID` = '$AdminID' ";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {

        $row = mysqli_fetch_assoc($res);

        return $row;
    }
    return false;
}

function getadmin($AdminID)
{
    global $conn;
    $sql = "SELECT * FROM `admin` WHERE AdminID != '$AdminID'";
    $res = mysqli_query($conn, $sql);

    $adminArray = [];
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_array($res)) {
            $adminArray[] = $row;
        }
    }
    return $adminArray;
}

function insertNewAdmin($fname, $lname, $image, $email, $tel, $username, $password)
{
    global $conn;
    $newpass = md5($password);
    $sql = "INSERT INTO `admin`(`Firstname`, `Lastname`, `image`, `Email`, `Contact`, `username`, `password`) 
    VALUES ('$fname','$lname','$image','$email','$tel','$username','$newpass')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        return true;
    } else {
        return false;
    }
}

function deleteAdmin($record_id)
{
    global $conn;
    $sql = "DELETE FROM `admin` WHERE `AdminID`='$record_id'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        return true;
    } else {
        return false;
    }
}

/* =====GET SUBJECTS CRUDS */
function fetchSubjects()
{
    global $conn;
    $sql = "SELECT * FROM `subjects`";
    $res = mysqli_query($conn, $sql);

    $subjects = [];

    while ($row = mysqli_fetch_assoc($res)) {
        $subjects[] = $row;
    }
    return $subjects;
}

//deleting a subject
function deleteSubject($subject_id)
{
    global $conn;
    $sql = "DELETE FROM `subjects` WHERE `SubjectID`='$subject_id'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        return true;
    } else {
        return false;
    }
}

//deleting a teaher who teachers that subject
function deleteTeacherwith_SubjectID($subject_id)
{
    global $conn;
    $sql = "DELETE FROM teachers WHERE SubjectID = '$subject_id'";
    $after_query = mysqli_query($conn, $sql);

    if ($after_query) {
        return true;
    } else {
        return false;
    }
}

function deleteSubjectfrom_0schedule($subject_name)
{
    global $conn;
    $sql = "DELETE FROM `o-level`
    WHERE subject_1 = '$subject_name' AND subject_2 = '$subject_name' AND subject_3 = '$subject_name' AND subject_4 = '$subject_name'";
    $after_query = mysqli_query($conn, $sql);

    if ($after_query) {
        return true;
    } else {
        return false;
    }
}

function deleteSubjectfrom_Aschedule($subject_name)
{
    global $conn;
    $sql = "DELETE FROM `a-level`
    WHERE subject_1 = '$subject_name' AND subject_2 = '$subject_name' AND subject_3 = '$subject_name' AND subject_4 = '$subject_name'";
    $after_query = mysqli_query($conn, $sql);

    if ($after_query) {
        return true;
    } else {
        return false;
    }
}

function eradicateSubjectFromSystem($subject_id, $subject_name)
{
    $fromSubject_table = deleteSubject($subject_id);
    $formTeachers_table = deleteTeacherwith_SubjectID($subject_id);
    $formOlevel_table = deleteSubjectfrom_0schedule($subject_name);
    $formAlevel_table = deleteSubjectfrom_Aschedule($subject_name);

    if ($fromSubject_table == true && $formTeachers_table == true && $formOlevel_table == true && $formAlevel_table == true) {
        return true;
    } else {
        return false;
    }
}

function insertsubjects($SubjectName)
{
    global $conn;
    $sql = "INSERT INTO `subjects`(`Subjectname`) VALUES ('$SubjectName')";
    $after_query = mysqli_query($conn, $sql);

    if ($after_query) {
        return true;
    } else {
        return false;
    }
}

function checkifsubjectAlreadyExists($SubjectName)
{
    global $conn;
    $sql = "SELECT * FROM `subjects` WHERE `Subjectname` = '$SubjectName'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function editSubjectName($id, $sub_name)
{
    global $conn;
    $sql = "UPDATE `subjects` SET `Subjectname`='$sub_name' WHERE `SubjectID`='$id'";
    $after_query = mysqli_query($conn, $sql);

    if ($after_query) {
        return true;
    } else {
        return false;
    }
}

function getStudentsAttendancebla()
{
    global $conn;
    $sql = "SELECT
    DISTINCT ar.StudentID, ar.IsPresent,
    s.FirstName,
    s.LastName,
    t.Firstname,
    t.Lastname,
    c.ClassName
    FROM `attendancerecords` as ar
    JOIN `students` AS s ON ar.StudentID = s.StudentID
    JOIN `teachers` AS t ON ar.TeacherID = t.TeacherID
    JOIN `classes` AS c on ar.ClassID = c.ClassID
    WHERE c.ClassID = 6";
    $result = mysqli_query($conn, $sql);

    $attendanceArray = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attendanceArray[] = $row;
        }
        return $attendanceArray;
    } else {
        return false;
    }
}

function getNotifications()
{
    global $conn;
    $sql = "SELECT * FROM `admin_notification` WHERE `status` = 0";
    $result = mysqli_query($conn, $sql);

    $notifications = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $notifications[] = $row;
        }
        return $notifications;
    } else {
        return "No Notifications Yet!";
    }
}

function get_Read_Notifications()
{
    global $conn;
    $sql = "SELECT * FROM `admin_notification` WHERE `status` = 1";
    $result = mysqli_query($conn, $sql);

    $notifications = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $notifications[] = $row;
        }
        return $notifications;
    } else {
        return "No Notifications Yet!";
    }
}

function delete_notification($recordID)
{
    global $conn;
    $sql = "DELETE FROM `admin_notification` WHERE record_id = '$recordID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "Deleted Successfully!";
    } else {
        return "Failure";
    }
}
