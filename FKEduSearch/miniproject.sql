-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2023 at 04:58 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miniproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_status`
--

CREATE TABLE `academic_status` (
  `academicStatus_ID` int(10) NOT NULL,
  `academicStatus_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_status`
--

INSERT INTO `academic_status` (`academicStatus_ID`, `academicStatus_type`) VALUES
(1, 'Degree,Master'),
(2, 'Degree,Master'),
(3, 'Degree,Master'),
(4, 'Degree,Master'),
(5, 'Diploma,Degree'),
(6, 'Diploma,Degree,Master'),
(7, 'Degree,Master'),
(8, 'Degree,Master,Phd'),
(9, 'Master,Phd'),
(10, 'Diploma,Degree,Master,Phd');

-- --------------------------------------------------------

--
-- Table structure for table `academic_statususerexpert`
--

CREATE TABLE `academic_statususerexpert` (
  `user_ID` int(10) NOT NULL,
  `expert_ID` int(10) NOT NULL,
  `academicStatus_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_statususerexpert`
--

INSERT INTO `academic_statususerexpert` (`user_ID`, `expert_ID`, `academicStatus_ID`) VALUES
(0, 20171, 1),
(0, 20171, 2),
(0, 20171, 3),
(0, 20171, 4),
(0, 20172, 1),
(0, 20172, 2),
(0, 20172, 3),
(0, 20173, 1),
(0, 20173, 2),
(0, 20173, 3),
(0, 20174, 1),
(0, 20174, 2),
(0, 20174, 3),
(0, 20174, 4);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(10) NOT NULL,
  `admin_userName` varchar(50) NOT NULL,
  `admin_password` varchar(30) NOT NULL,
  `admin_email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_userName`, `admin_password`, `admin_email`) VALUES
(1, 'admin', '123456', 'admin@gmail.com'),
(5, '1', '1', '1'),
(6, '10', '10', '10');

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `approval_ID` int(20) NOT NULL,
  `approval_date` date NOT NULL,
  `approval_status` text NOT NULL,
  `reactivate_ID` int(20) NOT NULL,
  `admin_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `post_CommentsID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `post_ID` int(10) NOT NULL,
  `comments_description` varchar(100) NOT NULL,
  `comments_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`post_CommentsID`, `user_ID`, `post_ID`, `comments_description`, `comments_date`) VALUES
(40, 1245, 123, 'ok', '2023-06-18'),
(41, 1247, 123, 'Comment Madam', '2023-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `admin_ID` int(10) NOT NULL,
  `expert_ID` int(10) NOT NULL,
  `complaintStatus_ID` int(10) NOT NULL,
  `complaint_Date` date NOT NULL,
  `complaint_Time` time NOT NULL,
  `complaint_Type` varchar(30) NOT NULL,
  `complaint_Desc` varchar(50) NOT NULL,
  `post_AnswerID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_ID`, `user_ID`, `admin_ID`, `expert_ID`, `complaintStatus_ID`, `complaint_Date`, `complaint_Time`, `complaint_Type`, `complaint_Desc`, `post_AnswerID`) VALUES
(1, 12, 5, 20173, 3, '2023-06-12', '17:19:05', 'Other', 'huhuahudhuahad', 6),
(2, 1245, 1, 20173, 3, '2023-06-21', '05:34:50', 'Wrongly Assigned Research Area', 'tambah satu', 6),
(3, 1245, 1, 20172, 3, '2023-06-21', '05:39:15', 'Unsatisfied Expert Feedback', 'amin tak problem', 10),
(5, 1245, 1, 20174, 1, '2023-06-21', '10:04:19', 'Unsatisfied Expert Feedback', 'fdffd', 8);

-- --------------------------------------------------------

--
-- Table structure for table `complaint_reply`
--

CREATE TABLE `complaint_reply` (
  `CR_ID` int(11) NOT NULL,
  `admin_ID` int(10) NOT NULL,
  `complaint_ID` int(10) NOT NULL,
  `CR_reply` varchar(255) NOT NULL,
  `CR_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaint_reply`
--

INSERT INTO `complaint_reply` (`CR_ID`, `admin_ID`, `complaint_ID`, `CR_reply`, `CR_datetime`) VALUES
(17, 1, 93, 'sorry for the inconvenience', '2023-06-13 04:30:57'),
(18, 1, 2, 'ttttt', '2023-06-21 03:37:46'),
(19, 1, 1, 'yuuuuu', '2023-06-21 03:41:36'),
(20, 1, 3, 'ytytytytytytyt', '2023-06-21 03:42:31'),
(21, 1, 0, 'hff', '2023-06-21 03:59:30'),
(22, 1, 0, 'hh', '2023-06-21 03:59:54'),
(23, 1, 0, 'jk', '2023-06-21 04:00:41'),
(24, 1, 0, 'a', '2023-06-21 05:44:22'),
(25, 1, 0, 'a', '2023-06-21 05:44:45'),
(26, 1, 0, 'a', '2023-06-21 05:45:00'),
(27, 1, 0, 'fd', '2023-06-21 07:54:19'),
(28, 1, 0, 'hi', '2023-06-21 07:54:55'),
(29, 1, 4, 'soryy for the ', '2023-06-21 08:01:09');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_status`
--

CREATE TABLE `complaint_status` (
  `complaintStatus_ID` int(10) NOT NULL,
  `complaintStatus_type` varchar(30) NOT NULL,
  `complaintStatus_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaint_status`
--

INSERT INTO `complaint_status` (`complaintStatus_ID`, `complaintStatus_type`, `complaintStatus_description`) VALUES
(1, 'In Investigation', 'The complaint is currently being investigated.'),
(2, 'On Hold', 'The complaint is not currently being investigated.'),
(3, 'Resolved', 'The complaint has been resolved.');

-- --------------------------------------------------------

--
-- Table structure for table `expert`
--

CREATE TABLE `expert` (
  `expert_ID` int(10) NOT NULL,
  `expert_userName` varchar(50) NOT NULL,
  `expert_password` varchar(30) NOT NULL,
  `expert_email` varchar(100) NOT NULL,
  `expert_fullName` varchar(100) NOT NULL,
  `expert_profilePicture` blob NOT NULL,
  `expert_CV` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expert`
--

INSERT INTO `expert` (`expert_ID`, `expert_userName`, `expert_password`, `expert_email`, `expert_fullName`, `expert_profilePicture`, `expert_CV`) VALUES
(200, 'faris', '123', 'aminramli1998@gmail.com', 'faris', 0x6578706572742e6a7067, 0x6578706572742e6a7067),
(20171, 'expert', 'expert', 'expert@gmail.com', 'expert', '', ''),
(20172, '1', '123', '1@gmail.com', '1', 0x6578706572742e6a7067, ''),
(20173, '2', '123', '2@gmail.com', '2', '', ''),
(20174, '3', '123', '3@gmail.com', '3', '', ''),
(20175, '4', '4', '4@gmail.com', '4', 0x6e69206b652e706e67, 0x50534d203120536c696465202831292e70707478),
(20176, 'cuba', 'cuba', 'cuba@gmail.com', 'cuba', 0x50534d203120536c696465202831292e70707478, 0x50534d203120536c696465202831292e70707478),
(20177, '10', '10', '10', '10', 0x5541542053414d504c452e706e67, 0x5541542053414d504c45202e706e67),
(20178, '11', '11', '11', '11', 0x5541542053414d504c45202e706e67, 0x6e69206b652e706e67),
(20179, '12', '12', '12', '12', 0x6e69206b652e706e67, 0x6e69206b652e706e67),
(20180, 'faris', '1234', 'frshaneefa@gmail.com', 'faris', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `expert_publication`
--

CREATE TABLE `expert_publication` (
  `expert_ID` int(10) NOT NULL,
  `publication_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `admin_ID` int(10) NOT NULL,
  `expert_ID` int(10) NOT NULL,
  `post_answerID` int(10) NOT NULL,
  `feedback_content` varchar(100) NOT NULL,
  `feedback_answerDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_ID` int(10) NOT NULL,
  `admin_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `expert_ID` int(10) NOT NULL,
  `role_ID` int(10) NOT NULL,
  `login_userName` varchar(50) NOT NULL,
  `login_password` varchar(30) NOT NULL,
  `login_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_ID`, `admin_ID`, `user_ID`, `expert_ID`, `role_ID`, `login_userName`, `login_password`, `login_date`) VALUES
(1, 1, 0, 0, 1, 'admin', '123456', '2023-07-09'),
(2, 0, 0, 200, 2, 'faris', '123', '2023-07-09'),
(22, 0, 0, 20171, 2, 'expert', 'expert', '2023-06-26'),
(23, 0, 1245, 0, 3, 'user', 'user', '2023-06-21'),
(24, 5, 0, 0, 1, '1', '1', '2023-06-17'),
(25, 0, 0, 20172, 2, '1', '123', '2023-07-08'),
(26, 0, 0, 20173, 2, '2', '123', '2023-06-27'),
(27, 0, 0, 20174, 2, '3', '123', '2023-06-27'),
(28, 0, 1246, 0, 3, 'u1', '1', '2023-07-09'),
(29, 0, 0, 20175, 2, '4', '4', '2023-06-27'),
(30, 0, 0, 20176, 2, 'cuba', 'cuba', '2023-06-21'),
(32, 0, 0, 20177, 2, '10', '10', '2023-06-21'),
(33, 0, 0, 20178, 2, '11', '11', '2023-06-21'),
(34, 0, 0, 20179, 2, '12', '12', '2023-06-21'),
(35, 0, 0, 20180, 2, 'faris', '1234', '2023-06-21'),
(36, 0, 1247, 0, 3, 'u1', '1234', '2023-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `expert_ID` int(10) NOT NULL,
  `post_title` varchar(100) NOT NULL,
  `post_content` varchar(300) NOT NULL,
  `post_createdDate` date NOT NULL,
  `post_categories` varchar(25) NOT NULL,
  `post_remainingDuration` time NOT NULL,
  `post_likes` int(10) NOT NULL,
  `post_status` varchar(10) NOT NULL,
  `post_comments` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_ID`, `user_ID`, `expert_ID`, `post_title`, `post_content`, `post_createdDate`, `post_categories`, `post_remainingDuration`, `post_likes`, `post_status`, `post_comments`) VALUES
(123, 123, 12, 'Security', 'Dear Expert, I am facing a significant dilemma as I need to configure ACL in my skill-based 2 !!!!! Please ......>.<', '2023-06-02', 'Cyber Security', '13:10:08', 14, 'Accepted', 2),
(12345, 1234, 200, 'Networking', 'Hi! Can I have your opinions regarding network security for my website system. ', '2023-06-04', 'Networking', '16:33:55', 15, '', 0),
(20155, 10, 0, 'min', 'min', '2023-06-13', 'Networking', '00:00:00', 10, '', 0),
(20156, 10, 0, 'OK', 'Okey', '2023-06-13', 'Networking', '00:00:00', 10, '', 0),
(20157, 10, 0, 'Study', 'Studyyy', '2023-06-13', 'Networking', '00:00:00', 10, '', 0),
(20158, 10, 0, 'Web', 'Engineering', '2023-06-13', 'Networking', '00:00:00', 10, '', 0),
(20159, 10, 0, 'Networking', 'Study Networking', '2023-06-13', 'Networking', '00:00:00', 10, '', 0),
(20180, 1244, 0, 'ggg', 'ggg', '2023-06-17', 'Graphic and Multimedia', '00:00:00', 1, '', 0),
(20181, 1244, 0, 'min', 'min', '2023-06-17', 'Computer Systems and Netw', '00:00:00', 0, '', 0),
(20187, 1245, 0, 'softwared', 'softwared', '2023-06-18', 'Software Engineering', '00:00:00', 0, '', 0),
(20188, 1245, 0, 'min', 'min', '2023-06-18', 'Cyber Security', '00:00:00', 0, '', 0),
(20189, 1245, 0, 'SE', 'SE', '2023-06-17', 'Software Engineering', '00:00:00', 0, '', 0),
(20190, 1245, 0, 'cyber2', 'cyber2', '2023-06-17', 'Cyber Security', '00:00:00', 0, '', 0),
(20191, 1245, 0, 'min', 'diana', '2023-06-17', 'Software Engineering', '00:00:00', 1, '', 0),
(20192, 1245, 0, 'diana', 'diana', '2023-06-17', 'Software Engineering', '00:00:00', 0, '', 0),
(20193, 1245, 0, 'min', 'min min', '2023-06-17', 'Graphic and Multimedia', '00:00:00', 0, '', 0),
(20194, 1246, 0, 'min', 'min', '2023-06-18', 'Computer Systems and Netw', '00:00:00', 0, '', 0),
(20196, 1245, 0, 'mmin', 'min', '2023-06-21', 'Software Engineering', '00:00:00', 0, '', 0),
(20198, 1247, 0, 'se madam', 'se madam', '2023-06-21', 'Software Engineering', '00:00:00', 0, '', 0),
(20199, 1247, 0, 'cs madam', 'cs madam', '2023-06-21', 'Cyber Security', '00:00:00', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_answer`
--

CREATE TABLE `post_answer` (
  `post_AnswerID` int(10) NOT NULL,
  `postAssigned_ID` int(10) NOT NULL,
  `complaint_ID` int(10) NOT NULL,
  `expert_ID` int(10) NOT NULL,
  `post_answer` varchar(500) NOT NULL,
  `post_status` varchar(10) NOT NULL,
  `answer_createdDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_answer`
--

INSERT INTO `post_answer` (`post_AnswerID`, `postAssigned_ID`, `complaint_ID`, `expert_ID`, `post_answer`, `post_status`, `answer_createdDate`) VALUES
(5, 0, 0, 20173, '2', '', '0000-00-00'),
(6, 22, 2, 20173, '3', '', '0000-00-00'),
(7, 18, 4, 20172, 'good job', '', '0000-00-00'),
(8, 17, 5, 20174, 'min', '', '0000-00-00'),
(9, 16, 0, 20171, 'okay', '', '0000-00-00'),
(10, 24, 3, 20172, 'min', '', '0000-00-00'),
(11, 20, 0, 20172, 'good job', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `post_assigned`
--

CREATE TABLE `post_assigned` (
  `postAssigned_ID` int(10) NOT NULL,
  `post_ID` int(10) NOT NULL,
  `expert_ID` int(10) NOT NULL,
  `date_assigned` date NOT NULL,
  `postAssigned_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_assigned`
--

INSERT INTO `post_assigned` (`postAssigned_ID`, `post_ID`, `expert_ID`, `date_assigned`, `postAssigned_status`) VALUES
(16, 20187, 20171, '2023-06-17', 'Completed'),
(17, 20188, 20174, '2023-06-17', 'Completed'),
(18, 20189, 20172, '2023-06-17', 'Completed'),
(19, 20190, 20174, '2023-06-17', 'Accepted'),
(20, 20191, 20172, '2023-06-17', 'Completed'),
(21, 20192, 20172, '2023-06-17', 'Accepted'),
(22, 20193, 20173, '2023-06-17', 'Completed'),
(23, 20195, 20171, '2023-06-18', 'Accepted'),
(24, 20196, 20172, '2023-06-21', 'Completed'),
(25, 20197, 20171, '2023-06-21', 'Accepted'),
(26, 20198, 20179, '2023-06-21', 'Accepted'),
(27, 20199, 20174, '2023-06-21', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `like_ID` int(10) NOT NULL,
  `post_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`like_ID`, `post_ID`, `user_ID`) VALUES
(4, 20191, 1245),
(5, 123, 1247),
(6, 123, 1246);

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE `publication` (
  `publication_ID` int(10) NOT NULL,
  `expert_ID` int(10) NOT NULL,
  `publicationTitle` varchar(100) NOT NULL,
  `publicationDate` date NOT NULL,
  `publisherName` varchar(100) NOT NULL,
  `publicationType` varchar(50) NOT NULL,
  `publicationFile` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publication`
--

INSERT INTO `publication` (`publication_ID`, `expert_ID`, `publicationTitle`, `publicationDate`, `publisherName`, `publicationType`, `publicationFile`) VALUES
(60, 20171, 'min', '2023-06-17', 'min', 'Networking', 0x70726f66696c655f64656661756c742e706e67),
(61, 20174, 'min', '2023-06-18', 'min', 'Networking', 0x70756c61752070657268656e7469616e2e6a7067),
(62, 20173, 'min', '2023-06-18', 'diana', 'Software Engineering', 0x696e7465726e6174696f6e616c5f666f6f642e6a7067),
(64, 20172, '1', '2023-06-21', 'min', 'Software Engineering', 0x50534d203120536c696465202831292e70707478);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_ID` int(10) NOT NULL,
  `expert_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `post_answerID` int(10) NOT NULL,
  `postAssigned_ID` int(10) NOT NULL,
  `rating_value` int(10) NOT NULL,
  `rating_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_ID`, `expert_ID`, `user_ID`, `post_answerID`, `postAssigned_ID`, `rating_value`, `rating_Date`) VALUES
(191, 20173, 1245, 0, 0, 5, '0000-00-00'),
(192, 20172, 1245, 0, 0, 5, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `reactivate`
--

CREATE TABLE `reactivate` (
  `reactivate_ID` int(20) NOT NULL,
  `reactivate_date` date NOT NULL,
  `expert_ID` int(10) NOT NULL,
  `reactivate_reason` varchar(100) NOT NULL,
  `admin_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `research_area`
--

CREATE TABLE `research_area` (
  `researchArea_ID` int(10) NOT NULL,
  `researchAreaName` varchar(100) NOT NULL,
  `researchAreaDescription` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `research_area`
--

INSERT INTO `research_area` (`researchArea_ID`, `researchAreaName`, `researchAreaDescription`) VALUES
(1, 'Computer Systems and Networking', ''),
(2, 'Software Engineering', ''),
(3, 'Graphic and Multimedia', ''),
(4, 'Cyber Security', '');

-- --------------------------------------------------------

--
-- Table structure for table `research_areauserexpert`
--

CREATE TABLE `research_areauserexpert` (
  `researchArea_ID` int(10) NOT NULL,
  `expert_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `research_areauserexpert`
--

INSERT INTO `research_areauserexpert` (`researchArea_ID`, `expert_ID`, `user_ID`) VALUES
(1, 20171, 0),
(2, 20172, 0),
(3, 20173, 0),
(4, 20174, 0),
(1, 20176, 0),
(1, 20175, 0),
(4, 20177, 0),
(2, 20178, 0),
(2, 20179, 0),
(2, 0, 1245);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_ID` int(10) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_ID`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Expert'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `socialmedia`
--

CREATE TABLE `socialmedia` (
  `socialMedia_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `expert_ID` int(10) NOT NULL,
  `instagram_userName` varchar(100) NOT NULL,
  `linkedin_userName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `socialmedia`
--

INSERT INTO `socialmedia` (`socialMedia_ID`, `user_ID`, `expert_ID`, `instagram_userName`, `linkedin_userName`) VALUES
(49, 0, 20171, 'expert', 'expert'),
(50, 0, 20172, '12', '12'),
(51, 0, 20173, '2', '2'),
(52, 0, 20174, '3', '3'),
(55, 0, 20176, 'cuba', 'cuba'),
(56, 0, 20176, 'cuba', 'cuba'),
(57, 0, 20175, '4', '4'),
(58, 0, 20177, '10', '10'),
(59, 0, 20178, 'bn', 'n'),
(60, 0, 20179, '12', '12'),
(61, 1245, 0, '2', 'ddsds');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(10) NOT NULL,
  `user_userName` varchar(50) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_fullName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `user_userName`, `user_password`, `user_email`, `user_fullName`) VALUES
(1245, 'user', 'user', 'user@gmail.com', 'user'),
(1246, 'u1', '1', 'u1', 'u1'),
(1247, 'u1', '1234', 'aminramli1998@gmail.com', 'u1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_status`
--
ALTER TABLE `academic_status`
  ADD PRIMARY KEY (`academicStatus_ID`);

--
-- Indexes for table `academic_statususerexpert`
--
ALTER TABLE `academic_statususerexpert`
  ADD KEY `academicStatus_ID` (`academicStatus_ID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`approval_ID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`post_CommentsID`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_ID`);

--
-- Indexes for table `complaint_reply`
--
ALTER TABLE `complaint_reply`
  ADD PRIMARY KEY (`CR_ID`),
  ADD KEY `admin_ID` (`admin_ID`),
  ADD KEY `complaint_ID` (`complaint_ID`);

--
-- Indexes for table `complaint_status`
--
ALTER TABLE `complaint_status`
  ADD PRIMARY KEY (`complaintStatus_ID`);

--
-- Indexes for table `expert`
--
ALTER TABLE `expert`
  ADD PRIMARY KEY (`expert_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_ID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_ID`);

--
-- Indexes for table `post_answer`
--
ALTER TABLE `post_answer`
  ADD PRIMARY KEY (`post_AnswerID`);

--
-- Indexes for table `post_assigned`
--
ALTER TABLE `post_assigned`
  ADD PRIMARY KEY (`postAssigned_ID`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`like_ID`);

--
-- Indexes for table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`publication_ID`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_ID`);

--
-- Indexes for table `reactivate`
--
ALTER TABLE `reactivate`
  ADD PRIMARY KEY (`reactivate_ID`);

--
-- Indexes for table `research_area`
--
ALTER TABLE `research_area`
  ADD PRIMARY KEY (`researchArea_ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_ID`);

--
-- Indexes for table `socialmedia`
--
ALTER TABLE `socialmedia`
  ADD PRIMARY KEY (`socialMedia_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_status`
--
ALTER TABLE `academic_status`
  MODIFY `academicStatus_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `approval_ID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `post_CommentsID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `complaint_reply`
--
ALTER TABLE `complaint_reply`
  MODIFY `CR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `complaint_status`
--
ALTER TABLE `complaint_status`
  MODIFY `complaintStatus_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `expert`
--
ALTER TABLE `expert`
  MODIFY `expert_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20181;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20200;

--
-- AUTO_INCREMENT for table `post_answer`
--
ALTER TABLE `post_answer`
  MODIFY `post_AnswerID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `post_assigned`
--
ALTER TABLE `post_assigned`
  MODIFY `postAssigned_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `like_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `publication`
--
ALTER TABLE `publication`
  MODIFY `publication_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `reactivate`
--
ALTER TABLE `reactivate`
  MODIFY `reactivate_ID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `research_area`
--
ALTER TABLE `research_area`
  MODIFY `researchArea_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `socialmedia`
--
ALTER TABLE `socialmedia`
  MODIFY `socialMedia_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1248;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
