-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3308
-- Generation Time: Mar 24, 2020 at 07:16 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `a_id` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `a_name` varchar(30) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `password`, `a_name`) VALUES
('admin', 'admin', 'KINGMAKER');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `a_id` int(5) NOT NULL AUTO_INCREMENT,
  `a_sub` varchar(100) NOT NULL,
  `a_msg` varchar(500) NOT NULL,
  `mov_stat` int(2) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `Enroll` int(10) NOT NULL,
  `c_id` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` varchar(10) NOT NULL,
  `course_name` varchar(25) NOT NULL,
  `praccount` int(2) NOT NULL,
  `coursecount` int(2) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course_reg`
--

CREATE TABLE IF NOT EXISTS `course_reg` (
  `enroll` int(10) NOT NULL,
  `course4` varchar(10) NOT NULL,
  `course5` varchar(10) NOT NULL,
  `course6` varchar(10) NOT NULL,
  `course7` varchar(10) NOT NULL,
  `course1` varchar(10) NOT NULL,
  `course2` varchar(10) NOT NULL,
  `course3` varchar(10) NOT NULL,
  PRIMARY KEY (`enroll`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `date of birth` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `enrollment` varchar(30) NOT NULL,
  `uid` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mother_name` varchar(20) NOT NULL,
  `father_name` varchar(20) NOT NULL,
  `Address` varchar(75) NOT NULL,
  `parent_email` varchar(20) NOT NULL,
  `parent_phone` varchar(10) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `enrollment` (`enrollment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification_msg`
--

CREATE TABLE IF NOT EXISTS `notification_msg` (
  `NID` int(10) NOT NULL AUTO_INCREMENT,
  `message` varchar(300) NOT NULL,
  PRIMARY KEY (`NID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE IF NOT EXISTS `notify` (
  `NID` int(10) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'unread',
  `To_send` varchar(20) NOT NULL,
  `From1` varchar(20) NOT NULL,
  KEY `NID` (`NID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `teacher_name` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `emails` varchar(30) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `department` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `teacher_id` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
  `year` int(5) NOT NULL,
  `day` varchar(10) NOT NULL,
  `timeslot` varchar(5) NOT NULL,
  `batch` varchar(5) DEFAULT NULL,
  `prac_id` varchar(10) DEFAULT NULL,
  `course_id` varchar(10) DEFAULT NULL,
  `teach_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notify`
--
ALTER TABLE `notify`
  ADD CONSTRAINT `notify_ibfk_1` FOREIGN KEY (`NID`) REFERENCES `notification_msg` (`NID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
