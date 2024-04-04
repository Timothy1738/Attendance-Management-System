-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 03, 2024 at 11:39 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `a-level`
--

DROP TABLE IF EXISTS `a-level`;
CREATE TABLE IF NOT EXISTS `a-level` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Day` varchar(50) NOT NULL,
  `subject_1` varchar(50) NOT NULL,
  `subject_2` varchar(50) NOT NULL,
  `subject_3` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `subject_4` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `a-level`
--

INSERT INTO `a-level` (`ID`, `Day`, `subject_1`, `subject_2`, `subject_3`, `subject_4`) VALUES
(1, 'Monday', 'Mathematics                                ', 'ICT', 'Chemistry', 'Biology'),
(2, 'Tuesday', 'Geography', 'History', 'Literature', 'Agriculture'),
(3, 'Wednesday', 'Entrepreneurship', 'Fine Art', 'Physics', 'ICT'),
(6, 'Thursday', 'CRE                                               ', 'Geography', 'Mathematics', 'Agriculture'),
(5, 'Friday', 'ICT', 'Geography', 'Physics', 'Fine Art');

-- --------------------------------------------------------

--
-- Table structure for table `absencerequests`
--

DROP TABLE IF EXISTS `absencerequests`;
CREATE TABLE IF NOT EXISTS `absencerequests` (
  `RequestID` int NOT NULL AUTO_INCREMENT,
  `StudentID` int NOT NULL,
  `RequestDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AbsenceDate` date NOT NULL,
  `Reasons` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `SubjectID` int NOT NULL,
  `status` varchar(50) NOT NULL,
  `ApproverID` int DEFAULT NULL,
  `Time_stamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`RequestID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absencerequests`
--

INSERT INTO `absencerequests` (`RequestID`, `StudentID`, `RequestDate`, `AbsenceDate`, `Reasons`, `SubjectID`, `status`, `ApproverID`, `Time_stamp`) VALUES
(1, 60, '2023-11-22 00:00:00', '2023-11-22', 'Good morning sir, i wont be in position to attend your lecture today because i have very important club activities i have carry out as a club president for the MDD club today. So i beg u pardon me and allow me to miss your lecture. I will try my best to learn from the rest on what has been covered!', 1, 'Approved', 10, '2023-11-22 05:37:24'),
(4, 66, '2023-11-22 00:00:00', '2023-11-22', 'Hello sir, I wont present for your lecture tomorrow because i have a field trip to aruu falls and have already paid in full so i cant miss. I must be there, please pardon me', 11, 'Approved', 17, '2023-11-22 08:52:24'),
(5, 68, '2023-11-22 00:00:00', '2023-11-22', 'Hello madame, i am currently at home still looking for fees so i wont attend all lectures for this entire week. I am hopeful that next week i will get the money for fees and join the rest of my colleagues and start attending lectures actively. Thank you!', 7, 'Approved', 28, '2023-11-22 09:23:11'),
(11, 60, '2024-04-03 14:15:07', '2024-04-05', 'Good morning sir, I wont be in position to attend your lecture tomorrow because I am gravely sick and currenlty taking medication. I will resume lectures next week, please accept my apology', 11, 'Denied', 17, '2024-04-03 14:15:07'),
(12, 60, '2024-04-03 14:18:55', '2024-04-05', 'Good morning sir, i wont be in position to attend your lecture today because i have very important club activities i have carry out as a club president for the MDD club today. So i beg u pardon me and allow me to miss your lecture. I will try my best to learn from the rest on what has been covered!', 12, 'Approved', 18, '2024-04-03 14:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `AdminID` int NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(50) NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Contact` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `Firstname`, `Lastname`, `image`, `Email`, `Contact`, `username`, `password`) VALUES
(1, 'Anganya', 'Timothy', 'admin_1.jpg', 'anganyatimothy@gmail.com', '0778907657', 'tim', '5531a5834816222280f20d1ef9e95f69'),
(3, 'Jimmy', 'Eduaord', 'PROFILE_IMG_3.jpg', 'eduaord@gmail.com', '0778172810', 'josh', '202cb962ac59075b964b07152d234b70'),
(4, 'Elon', 'Musk', 'dope bro.jpg', 'musk@gmail.com', '0776518290', 'musk', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notification`
--

DROP TABLE IF EXISTS `admin_notification`;
CREATE TABLE IF NOT EXISTS `admin_notification` (
  `record_id` int NOT NULL AUTO_INCREMENT,
  `message` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_notification`
--

INSERT INTO `admin_notification` (`record_id`, `message`, `status`, `user_id`) VALUES
(46, 'Teacher Zaria Emerson has taken attendance for Class S6', 0, 19),
(45, 'Teacher Haniya Zayeesh Approved Absence request!', 0, 18),
(9, 'Teacher Anna Bless has taken attendance, Extra Lesson for Class S2', 1, 16),
(10, 'Teacher Amaro Peace Evelyn has taken attendance, Extra Lesson for Class S6', 1, 7),
(11, 'Teacher Amaro Peace Evelyn has changed username and password!', 1, 7),
(12, 'Teacher Kisirisa Ben has edited his profile!', 1, 20),
(17, 'Teacher Okumu Reagan Approved Absence request!', 1, 10),
(18, 'Student Christine Salman just sent an absence request!', 1, 74),
(47, 'Teacher Haniya Zayeesh has taken attendance for Class S6', 0, 18),
(44, 'Teacher Freddy Posh Approved Absence request!', 0, 17),
(43, 'Student Elizabeth Greenjust sent an absence request!', 0, 60),
(42, 'Student Elizabeth Greenjust sent an absence request!', 0, 60),
(41, 'Teacher Zakariah Benson Approved Absence request!', 1, 15),
(40, 'Student Elizabeth Greenjust sent an absence request!', 1, 60),
(20, 'Student Randall Kigo just changed password and username!', 1, 66),
(21, 'Student Randall Kigojust sent an absence request!', 1, 66),
(22, 'Teacher Freddy Posh Denied Absence request!', 1, 17),
(23, 'Student Immy Maculate just changed password and username!', 1, 68),
(24, 'Student Immy Maculatejust sent an absence request!', 1, 68),
(25, 'Teacher McBeth Christine Approved Absence request!', 1, 28),
(32, 'Teacher Anna Bless just Edited Attendance of Immy Maculate', 1, 16),
(31, 'Teacher Anna Bless just Edited Attendance of Immy Maculate', 1, 16),
(30, 'Teacher Anna Bless just Edited Attendance of Murife Byron', 1, 16),
(29, 'Teacher Amaro Peace Evelyn just Edited Attendance in Extra Lessons of Ricardo Bryce', 1, 7),
(33, 'Teacher Amaro Peace Evelyn has taken attendance for Class S1', 1, 7),
(34, 'Teacher Amaro Peace Evelyn has taken attendance for Class S4', 1, 7),
(35, 'Teacher Amaro Peace Evelyn has taken attendance for Class S3', 1, 7),
(36, 'Teacher Amaro Peace Evelyn has taken attendance for Class S4', 1, 7),
(37, 'Teacher Ageno Jemmimah has changed username and password!', 1, 29),
(38, 'Teacher Opio Derrick has edited his profile!', 1, 6),
(48, 'Teacher Mariam Annet has taken attendance for Class S6', 0, 11),
(49, 'Teacher Freddy Posh has taken attendance for Class S6', 0, 17);

-- --------------------------------------------------------

--
-- Table structure for table `attendanceoverrides`
--

DROP TABLE IF EXISTS `attendanceoverrides`;
CREATE TABLE IF NOT EXISTS `attendanceoverrides` (
  `OverrideID` int NOT NULL AUTO_INCREMENT,
  `OverrideDate` date NOT NULL,
  `IsPresent` varchar(50) NOT NULL,
  `StudentID` int NOT NULL,
  `TeacherID` int NOT NULL,
  `SubjectID` int NOT NULL,
  `Time` time NOT NULL,
  `ClassID` int NOT NULL,
  PRIMARY KEY (`OverrideID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendanceoverrides`
--

INSERT INTO `attendanceoverrides` (`OverrideID`, `OverrideDate`, `IsPresent`, `StudentID`, `TeacherID`, `SubjectID`, `Time`, `ClassID`) VALUES
(1, '2023-11-21', ' present', 52, 28, 7, '13:30:37', 1),
(2, '2023-11-21', ' present', 54, 28, 7, '13:30:37', 1),
(3, '2023-11-21', ' present', 57, 28, 7, '13:30:37', 1),
(4, '2023-11-21', ' present', 70, 28, 7, '13:30:37', 1),
(5, '2023-11-21', ' present', 72, 28, 7, '13:30:37', 1),
(6, '2023-11-21', 'present', 73, 28, 7, '13:30:37', 1),
(7, '2023-11-22', ' present', 51, 16, 9, '10:25:49', 2),
(8, '2023-11-22', ' present', 63, 16, 9, '10:25:49', 2),
(9, '2023-11-22', ' present', 64, 16, 9, '10:25:49', 2),
(10, '2023-11-22', ' present', 71, 16, 9, '10:25:49', 2),
(11, '2023-11-22', 'absent ', 74, 16, 9, '10:25:49', 2),
(12, '2023-11-22', 'absent', 53, 7, 10, '10:29:38', 6),
(13, '2023-11-22', ' present', 60, 7, 10, '10:29:38', 6),
(14, '2023-11-22', ' present', 65, 7, 10, '10:29:38', 6),
(15, '2023-11-22', ' present', 52, 20, 3, '10:47:21', 1),
(16, '2023-11-22', ' present', 54, 20, 3, '10:47:21', 1),
(17, '2023-11-22', ' present', 57, 20, 3, '10:47:21', 1),
(18, '2023-11-22', ' present', 70, 20, 3, '10:47:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendancerecords`
--

DROP TABLE IF EXISTS `attendancerecords`;
CREATE TABLE IF NOT EXISTS `attendancerecords` (
  `RecordID` int NOT NULL AUTO_INCREMENT,
  `StudentID` int NOT NULL,
  `TeacherID` int NOT NULL,
  `SubjectID` int NOT NULL,
  `ClassID` int NOT NULL,
  `Date` date NOT NULL,
  `IsPresent` varchar(50) NOT NULL,
  `Period` int NOT NULL,
  PRIMARY KEY (`RecordID`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendancerecords`
--

INSERT INTO `attendancerecords` (`RecordID`, `StudentID`, `TeacherID`, `SubjectID`, `ClassID`, `Date`, `IsPresent`, `Period`) VALUES
(1, 52, 14, 4, 1, '2023-11-21', ' present', 1),
(2, 54, 14, 4, 1, '2023-11-21', ' present', 1),
(3, 57, 14, 4, 1, '2023-11-21', ' present', 1),
(4, 70, 14, 4, 1, '2023-11-21', ' present', 1),
(5, 72, 14, 4, 1, '2023-11-21', ' present', 1),
(6, 73, 14, 4, 1, '2023-11-21', 'present', 1),
(7, 51, 14, 4, 2, '2023-11-21', ' present', 1),
(8, 63, 14, 4, 2, '2023-11-21', ' present', 1),
(9, 64, 14, 4, 2, '2023-11-21', ' present', 1),
(10, 71, 14, 4, 2, '2023-11-21', ' present', 1),
(11, 74, 14, 4, 2, '2023-11-21', ' present', 1),
(12, 41, 14, 4, 3, '2023-11-21', ' present', 1),
(13, 61, 14, 4, 3, '2023-11-21', ' present', 1),
(14, 62, 14, 4, 3, '2023-11-21', ' present', 1),
(15, 44, 14, 4, 4, '2023-11-21', ' present', 1),
(16, 68, 14, 4, 4, '2023-11-21', ' present', 1),
(17, 69, 14, 4, 4, '2023-11-21', ' present', 1),
(18, 55, 14, 4, 5, '2023-11-21', ' present', 1),
(19, 66, 14, 4, 5, '2023-11-21', ' present', 1),
(73, 65, 19, 14, 6, '2024-04-03', ' present', 1),
(21, 53, 14, 4, 6, '2023-11-21', ' present', 1),
(22, 60, 14, 4, 6, '2023-11-21', ' present', 1),
(23, 65, 14, 4, 6, '2023-11-21', ' present', 1),
(24, 52, 16, 9, 1, '2023-11-22', ' present', 1),
(25, 54, 16, 9, 1, '2023-11-22', ' present', 1),
(71, 53, 19, 14, 6, '2024-04-03', ' present', 1),
(27, 70, 16, 9, 1, '2023-11-22', ' present', 1),
(28, 72, 16, 9, 1, '2023-11-22', ' present', 1),
(29, 73, 16, 9, 1, '2023-11-22', 'absent', 1),
(30, 53, 19, 14, 6, '2023-11-22', ' present', 1),
(31, 60, 19, 14, 6, '2023-11-22', ' present', 1),
(32, 65, 19, 14, 6, '2023-11-22', ' present', 1),
(33, 55, 19, 14, 5, '2023-11-22', 'absent ', 1),
(34, 66, 19, 14, 5, '2023-11-22', 'absent ', 1),
(72, 60, 19, 14, 6, '2024-04-03', ' present', 1),
(36, 44, 16, 9, 4, '2023-11-22', ' present', 1),
(37, 68, 16, 9, 4, '2023-11-22', 'present', 1),
(38, 69, 16, 9, 4, '2023-11-22', ' present', 1),
(39, 51, 16, 9, 2, '2023-11-22', ' present', 1),
(40, 63, 16, 9, 2, '2023-11-22', ' present', 1),
(41, 64, 16, 9, 2, '2023-11-22', ' present', 1),
(42, 71, 16, 9, 2, '2023-11-22', ' present', 1),
(43, 74, 16, 9, 2, '2023-11-22', ' present', 1),
(44, 41, 16, 9, 3, '2023-11-22', ' present', 1),
(45, 61, 16, 9, 3, '2023-11-22', ' present', 1),
(46, 62, 16, 9, 3, '2023-11-22', ' present', 1),
(47, 52, 7, 10, 1, '2023-11-22', ' present', 2),
(48, 54, 7, 10, 1, '2023-11-22', ' present', 2),
(49, 57, 7, 10, 1, '2023-11-22', ' present', 2),
(50, 70, 7, 10, 1, '2023-11-22', ' present', 2),
(51, 72, 7, 10, 1, '2023-11-22', ' present', 2),
(52, 73, 7, 10, 1, '2023-11-22', ' present', 2),
(53, 51, 7, 10, 2, '2023-11-22', ' present', 2),
(54, 63, 7, 10, 2, '2023-11-22', ' present', 2),
(55, 64, 7, 10, 2, '2023-11-22', ' present', 2),
(56, 71, 7, 10, 2, '2023-11-22', ' present', 2),
(57, 74, 7, 10, 2, '2023-11-22', ' present', 2),
(58, 41, 7, 10, 3, '2023-11-22', ' present', 2),
(59, 61, 7, 10, 3, '2023-11-22', ' present', 2),
(60, 62, 7, 10, 3, '2023-11-22', ' present', 2),
(61, 44, 7, 10, 4, '2023-11-22', ' present', 2),
(62, 68, 7, 10, 4, '2023-11-22', ' present', 2),
(63, 69, 7, 10, 4, '2023-11-22', ' present', 2),
(64, 52, 15, 13, 1, '2023-11-23', ' present', 1),
(65, 54, 15, 13, 1, '2023-11-23', ' present', 1),
(66, 57, 15, 13, 1, '2023-11-23', ' present', 1),
(67, 70, 15, 13, 1, '2023-11-23', ' present', 1),
(68, 72, 15, 13, 1, '2023-11-23', 'absent ', 1),
(69, 73, 15, 13, 1, '2023-11-23', 'absent ', 1),
(70, 76, 15, 13, 1, '2023-11-23', 'absent ', 1),
(74, 53, 18, 12, 6, '2024-04-03', ' present', 2),
(75, 60, 18, 12, 6, '2024-04-03', ' present', 2),
(76, 65, 18, 12, 6, '2024-04-03', ' present', 2),
(77, 53, 11, 2, 6, '2024-04-03', ' present', 3),
(78, 60, 11, 2, 6, '2024-04-03', 'absent ', 3),
(79, 65, 11, 2, 6, '2024-04-03', ' present', 3),
(80, 53, 17, 11, 6, '2024-04-03', ' present', 4),
(81, 60, 17, 11, 6, '2024-04-03', ' present', 4),
(82, 65, 17, 11, 6, '2024-04-03', ' present', 4);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `ClassID` int NOT NULL AUTO_INCREMENT,
  `ClassName` varchar(50) NOT NULL,
  `Year` int NOT NULL,
  `ClassTeacherID` int NOT NULL,
  PRIMARY KEY (`ClassID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`ClassID`, `ClassName`, `Year`, `ClassTeacherID`) VALUES
(1, 'S1', 2023, 24),
(2, 'S2', 2023, 5),
(3, 'S3', 2023, 6),
(4, 'S4', 2023, 7),
(5, 'S5', 2023, 8),
(6, 'S6', 2023, 12);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `MessageID` int NOT NULL AUTO_INCREMENT,
  `ClassID` int NOT NULL,
  `TeacherID` int NOT NULL,
  `Message` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Date` date NOT NULL,
  `SubjectID` int NOT NULL,
  `Time` time NOT NULL,
  PRIMARY KEY (`MessageID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`MessageID`, `ClassID`, `TeacherID`, `Message`, `Date`, `SubjectID`, `Time`) VALUES
(9, 1, 5, 'No lectures today! Use the time to read your books for the upcoming test.', '2024-04-03', 5, '13:23:01'),
(4, 3, 7, 'Go read chapter 6 and 7 in your text book. Its what we shall cover today.', '2023-10-23', 10, '05:16:14'),
(5, 5, 5, 'There will  a test tomorrow, so prepare in advance. The test will cover chapters 1 and two and it will be out of 40 marks. Good luck!', '2023-10-24', 5, '06:14:14'),
(6, 1, 6, 'Hello students, Mr Opini Francis will take my lecture tomorrow and i will take his on Monday. So lets meet on Thursday! Good Day', '2023-11-08', 6, '03:06:06'),
(7, 3, 19, 'Hello Students, Hope you are well. This message is to remind you to get ready for trip to the national theatre, we are setting of on the 12th dec. So ask your parents to pay in time for better preparation, Have a nice day', '2023-11-09', 14, '22:34:04'),
(8, 6, 7, 'Hell class, there will be a test tomorrow, so prepare in advance!', '2023-11-21', 10, '17:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `o-level`
--

DROP TABLE IF EXISTS `o-level`;
CREATE TABLE IF NOT EXISTS `o-level` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Day` varchar(50) NOT NULL,
  `subject_1` varchar(50) NOT NULL,
  `subject_2` varchar(50) NOT NULL,
  `subject_3` varchar(50) NOT NULL,
  `subject_4` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `o-level`
--

INSERT INTO `o-level` (`ID`, `Day`, `subject_1`, `subject_2`, `subject_3`, `subject_4`) VALUES
(1, 'Monday', 'Mathematics                                       ', 'English', 'Chemistry', 'Biology'),
(2, 'Tuesday', 'Geography', 'History', 'English', 'Agriculture'),
(3, 'Wednesday', 'Commerce', 'CRE', 'ICT', 'Fine Art'),
(4, 'Thursday', 'Literature', 'Entrepreneurship', 'Mathematics', 'Biology'),
(6, 'Friday', 'English                                ', 'Literature', 'Physics', 'Biology');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `StudentID` int NOT NULL AUTO_INCREMENT,
  `image` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `FirstName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `LastName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ClassID` int NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Gender` varchar(7) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `ContactNumber` varchar(15) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`StudentID`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `image`, `FirstName`, `LastName`, `ClassID`, `DateOfBirth`, `Gender`, `Address`, `ContactNumber`, `Email`, `password`, `username`) VALUES
(41, 'profile-3.jpg', 'Alice', 'Roberts                                           ', 3, '2002-07-25', 'Female ', 'Lira', '07781723819', 'roberts@gmail.com', '202cb962ac59075b964b07152d234b70', 'alice'),
(44, 'team-1.jpg', 'Odaga', 'Innocent                            ', 4, '2010-09-09', 'Male   ', 'Lira', '077836352718', 'innocent@gmail.com', '202cb962ac59075b964b07152d234b70', 'innocent'),
(51, 'lady_3.jpg', 'Missy', 'Aminah                            ', 2, '2009-06-16', 'Female ', 'Adjumani', '0778654321', 'aminah@gmail.com', '202cb962ac59075b964b07152d234b70', 'missy'),
(52, 'boy.jpg', 'Jimmy', 'Partey                            ', 1, '2008-11-13', 'Male   ', 'Fort-Portal', '0778172891', 'partey@gmail.com', '202cb962ac59075b964b07152d234b70', 'jimmy'),
(53, 'bryce.jpg', 'Ricardo', 'Bryce', 6, '2013-06-12', 'Male', 'Jinja', '0778907657', 'bryce@gmail.com', '202cb962ac59075b964b07152d234b70', 'bryce'),
(54, 'anad boy.jpg', 'Berry', 'Allen', 1, '2012-06-13', 'Male', 'Mukono', '0778361728', 'allen@gmail.com', 'a8047d24376e2ce5c62663d435629812', 'ST4'),
(55, 'this boy.jpg', 'John', 'Wick', 5, '2013-02-15', 'Male', 'Gulu', '0773628192', 'wick@gmail.com', '30f41bdee3c7ede12ec23ab49a2c8ec6', 'ST5'),
(57, 'muslim4.jpg', 'Miriam', 'Mace                            ', 1, '2011-06-13', 'Female ', 'Buduuda', '0778162738', 'mace@gmail.com', '202cb962ac59075b964b07152d234b70', 'mace'),
(60, 'testimonials-2.jpg', 'Elizabeth', 'Green', 6, '2012-06-05', 'Female', 'America', '0778192017', 'elizabeth@gmail.com', '202cb962ac59075b964b07152d234b70', 'lizabeth'),
(61, 'betsy riggins.jpg', 'Betsy', 'Riggins                                           ', 3, '2009-02-11', 'Female ', 'Kampala', '0776172899', 'betsy@gmail.com', 'ccf014626cbd3930f29590503f61c61f', 'ST7'),
(62, 'black ladit.jpg', 'Isma', 'Bidal', 3, '2009-11-26', 'Male', 'Lira', '0778615278', 'bidal@gmail.com', 'a813af3efbee8f125c9e3657219d28b9', 'ST8'),
(63, 'boy later.jpg', 'Josh', 'Hartnet', 2, '2009-10-21', 'Male', 'Kababe', '0778611729', 'hartnet@gmail.com', '71368223ae8c98ce64eb117e8d75d245', 'ST9'),
(64, 'cool son.jpg', 'Ryder', 'Posh Martini', 2, '2009-10-14', 'Male', 'Kisumu', '0776788511', 'poshmartini@gmail.com', '91c87f916d9fe19ad14d91e883948804', 'ST10'),
(65, 'PROFILE_IMG_5.jpg', 'Baby', 'Swiatek                            ', 6, '2002-02-06', 'Female ', 'Kitgum', '0777811720', 'swiatek@gmai.com', 'aead2bdbfba1f582dd1e891802aa53d6', 'ST11'),
(66, 'cool son2.jpg', 'Randall', 'Kigo', 5, '2007-02-07', 'Male', 'Soroti', '0776199999', 'kigo@gmail.com', '202cb962ac59075b964b07152d234b70', 'kigo'),
(68, 'st1lady.jpg', 'Immy', 'Maculate', 4, '2009-10-20', 'Female', 'Bundibugyo', '0778166281', 'maculate@gmail.com', '202cb962ac59075b964b07152d234b70', 'maculate'),
(69, 'lady4.jpg', 'Sally Merryline', 'Apollo                                            ', 4, '2008-10-14', 'Female ', 'Kigumba', '0725611111', 'apollo@gmail.com', 'ed7e70dd73df30fb37a43984f33d8472', 'apollo@gmail.com'),
(70, 'PROFILE_IMG_2.jpg', 'Alice', 'Grace                            ', 1, '2009-06-19', 'Female ', 'Jinja', '0725100000', 'grace@gmail.com', 'fe488a6b6fd49eee04bab1189b971205', 'grace@gmail.com'),
(71, 'st2.jpg', 'Lucky', 'Nobert', 2, '2009-07-19', 'Male', 'Arua', '0771890000', 'nobert@gmail.com', '202cb962ac59075b964b07152d234b70', 'nobert'),
(72, 'PROFILE_IMG_1.jpg', 'Joe', 'Becktet                            ', 1, '2012-02-01', 'Male   ', 'Kababe', '0771899222', 'becket@gmail.com', '202cb962ac59075b964b07152d234b70', 'becket'),
(73, 'PROFILE_IMG_3.jpg', 'Murife', 'Byron                            ', 1, '2011-06-21', 'Male   ', 'Obote-Avenue', '0771888111', 'byron@gmail.com', '202cb962ac59075b964b07152d234b70', 'byron'),
(74, 'PROFILE_IMG_4.jpg', 'Christine', 'Salman                            ', 2, '2012-06-13', 'Female ', 'Bundibugyo', '0771822000', 'salman@gmail.com', '202cb962ac59075b964b07152d234b70', 'salman'),
(76, 'betsy riggins.jpg', 'Merceline', 'Sharon', 1, '2012-06-13', 'Female', 'Kampala', '0778101111', 'merceline@gmail.com', '202cb962ac59075b964b07152d234b70', 'merceline');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `SubjectID` int NOT NULL AUTO_INCREMENT,
  `Subjectname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`SubjectID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`SubjectID`, `Subjectname`) VALUES
(1, 'Mathematics'),
(2, 'Physics'),
(3, 'Chemistry'),
(4, 'Geography'),
(5, 'Biology'),
(6, 'History'),
(7, 'English'),
(8, 'Agriculture'),
(9, 'Commerce'),
(10, 'CRE'),
(11, 'ICT'),
(12, 'Fine Art'),
(13, 'Literature'),
(14, 'Entrepreneurship'),
(16, 'Divinity');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `TeacherID` int NOT NULL AUTO_INCREMENT,
  `Image` varchar(200) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `ContactNumber` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `SubjectID` int NOT NULL,
  `password` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`TeacherID`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`TeacherID`, `Image`, `Firstname`, `Lastname`, `ContactNumber`, `Email`, `SubjectID`, `password`, `username`) VALUES
(5, 'gentleman.jpg', 'Opini', 'Francis', '0778536278', 'francis@gmail.com', 5, '202cb962ac59075b964b07152d234b70', 'francis'),
(6, 'boy-1.jpg', 'Opio', 'Derrick', '0778907657', 'derrick@gmail.com', 6, '202cb962ac59075b964b07152d234b70', 'derrick'),
(7, 'team-2.jpg', 'Amaro', 'Peace Evelyn', '0778352418', 'peace@gmail.com', 10, '5531a5834816222280f20d1ef9e95f69', 'evelyn'),
(8, 'Team-7.jpg', 'Olivia', 'Christine', '0778364810', 'christine@gmail.com', 3, '202cb962ac59075b964b07152d234b70', 'olivia'),
(12, 'lady_2', 'Cecilia', 'Madeline', '0778291726', 'madeline@gmail.com', 5, '202cb962ac59075b964b07152d234b70', 'madeline'),
(10, 'profile-2.jpg', 'Okumu', 'Reagan', '0776251839', 'reagan@gmail.com', 1, '202cb962ac59075b964b07152d234b70', 'reagan'),
(11, 'team-2.jpg', 'Mariam', 'Annet', '0773627182', 'annet@gmail.com', 2, '202cb962ac59075b964b07152d234b70', 'annet'),
(13, 'team-8.jpg', 'Rukidi', 'Mpuuga', '0778192610', 'mpuuga@gamil.com', 6, '202cb962ac59075b964b07152d234b70', 'mpuuga'),
(14, 'st2.jpg', 'John', 'Baptist', '0778271628', 'baptist@gmail.com', 4, '202cb962ac59075b964b07152d234b70', 'baptist'),
(15, 'OIP.jpeg', 'Zakariah', 'Benson', '07782192718', 'benson@gmail.com', 13, '202cb962ac59075b964b07152d234b70', 'benson'),
(16, 'lady.jfif', 'Anna', 'Bless', '07786516728', 'bless@gmail.com', 9, '202cb962ac59075b964b07152d234b70', 'bless'),
(17, 'satoru.jpg', 'Freddy', 'Posh', '0778951627', 'posh@gmail.com', 11, '202cb962ac59075b964b07152d234b70', 'posh'),
(18, 'muslim3.jpg', 'Haniya', 'Zayeesh', '0718201827', 'zayeesh@gmail.com', 12, '202cb962ac59075b964b07152d234b70', 'hani'),
(19, 'muslim4.jpg', 'Zaria', 'Emerson', '0788917281', 'kareem@gmail.com', 14, '202cb962ac59075b964b07152d234b70', 'kareem'),
(20, 'team-1.jpg', 'Kisirisa', 'Ben Hur', '07789076451', 'brian@gmail.com', 3, '202cb962ac59075b964b07152d234b70', 'ben'),
(31, 'team-4.jpg', 'Dandy', 'Dandre', '0778199001', 'dandy@gmail.com', 5, '81dc9bdb52d04dc20036dbd8313ed055', 'dandy'),
(24, 'gentle.jpg', 'Kagimu', 'Maxwell', '0778172009', 'maxwell@gmail.com', 7, '202cb962ac59075b964b07152d234b70', 'maxwell'),
(26, 'st1.jpg', 'Jamain', 'Finbogason', '0778617281', 'finbogason@gmail.com', 1, '202cb962ac59075b964b07152d234b70', 'fin'),
(27, 'boy-1.jpg', 'Mugume ', 'Don', '0778172890', 'don@gmail.com', 3, 'a813af3efbee8f125c9e3657219d28b9', 'don'),
(28, 'jolly teacher.jpg', 'McBeth', 'Christine', '0771711999', 'beth@gmail.com', 7, '202cb962ac59075b964b07152d234b70', 'mcbeth'),
(29, 'PROFILE_IMG_6.jpg', 'Ageno', 'Jemmimah', '0771011999', 'jemmimah@gmail.com', 11, '202cb962ac59075b964b07152d234b70', 'mima');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_notification`
--

DROP TABLE IF EXISTS `teacher_notification`;
CREATE TABLE IF NOT EXISTS `teacher_notification` (
  `record_id` int NOT NULL AUTO_INCREMENT,
  `Subject_ID` int NOT NULL,
  `StudentID` int NOT NULL,
  `notification` varchar(50) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teacher_notification`
--

INSERT INTO `teacher_notification` (`record_id`, `Subject_ID`, `StudentID`, `notification`, `status`) VALUES
(10, 13, 60, 'You have a new Absence request!', 1),
(7, 7, 74, 'You have a new Absence request!', 1),
(8, 11, 66, 'You have a new Absence request!', 1),
(9, 7, 68, 'You have a new Absence request!', 0),
(11, 11, 60, 'You have a new Absence request!', 1),
(12, 12, 60, 'You have a new Absence request!', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
