-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2018 at 11:41 AM
-- Server version: 5.6.38
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myassign_core_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

CREATE TABLE `activations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activations`
--

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'RCsr7Qt1bBMqFwlW4bBVvtu02UBBQ0hr', 1, '2015-07-11 06:09:31', '2015-07-11 06:09:31', '2015-07-11 06:09:31'),
(18, 25, 'AHYuR5Dmxk3eEUWixycp18CLTyxQGhTz', 1, '2018-05-03 12:51:02', '2018-05-03 12:51:02', '2018-05-03 12:51:02'),
(21, 28, 'Lx0iYgalyehIKnC34hg9H90deZ67muNe', 1, '2018-05-10 15:36:16', '2018-05-10 15:36:16', '2018-05-10 15:36:16'),
(22, 30, 'YFEoXGDQxA955aSk6bHo5TgWffxXOF51', 1, '2018-05-10 15:39:10', '2018-05-10 15:39:10', '2018-05-10 15:39:10'),
(24, 32, 'v0OReRft3SaI3dmDxd8Na2IV5Ui9CGM3', 1, '2018-05-10 15:42:10', '2018-05-10 15:42:10', '2018-05-10 15:42:10'),
(25, 33, 'PBrYVxlSeq1usY8EXXNj8gep4gOsItHL', 1, '2018-05-14 13:22:12', '2018-05-14 13:22:12', '2018-05-14 13:22:12'),
(26, 34, 'p3j0jjfoxq4n7teQ7WvmVle3m9Iomwv5', 1, '2018-05-14 13:22:45', '2018-05-14 13:22:45', '2018-05-14 13:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_request`
--

CREATE TABLE `assignment_request` (
  `id` int(11) NOT NULL,
  `studentName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNo` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `advance` int(11) NOT NULL,
  `studentAttachment` text NOT NULL,
  `type` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `assignto` int(11) DEFAULT '0',
  `assignDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `completeDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `progress` int(11) NOT NULL,
  `adminDiscrption` text NOT NULL,
  `adminAttachment` text NOT NULL,
  `writerAttachment` text NOT NULL,
  `writerImages` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deadline` date NOT NULL,
  `wordcount` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `othernote` varchar(500) NOT NULL,
  `topic` varchar(200) NOT NULL,
  `reference` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment_request`
--

INSERT INTO `assignment_request` (`id`, `studentName`, `email`, `phoneNo`, `price`, `advance`, `studentAttachment`, `type`, `status`, `assignto`, `assignDate`, `completeDate`, `progress`, `adminDiscrption`, `adminAttachment`, `writerAttachment`, `writerImages`, `created_at`, `updated_at`, `deleted_at`, `deadline`, `wordcount`, `level`, `othernote`, `topic`, `reference`) VALUES
(3, 'jhhgjgh', 'kasun@gmail.com', '077511564', 5000, 0, '', 'IT', 2, 24, '2018-05-09 10:15:57', '2018-05-03 10:16:46', 0, '<br>', '', '', '', '2018-04-25 05:38:19', '2018-05-09 10:15:57', NULL, '0000-00-00', 0, '', '', '', ''),
(4, 'fghfhgf', 'hgfhgfhgf', '1548484', 5000, 12, '', 'Account', 1, 24, '2018-05-09 10:18:54', '2018-05-03 10:04:32', 0, 'sfdsfdsfdsfdsfds<br>', 'newmodi.pdf', '', '', '2018-04-25 13:03:11', '2018-05-09 10:31:18', NULL, '0000-00-00', 0, '', '', '', ''),
(5, 'test', 'test@gmail.com', '0115115169', 1000, 0, '', '', 3, 24, '2018-05-10 03:41:25', '0000-00-00 00:00:00', 100, '<br>', '', '', '', '2018-05-10 03:36:27', '2018-05-10 04:59:42', NULL, '0000-00-00', 0, '', '', '', ''),
(6, 'test', 'test@gmail.com', '0778458963', 100, 0, '', '', 3, 34, '2018-05-15 03:12:03', '0000-00-00 00:00:00', 100, '<br>', '', '17796374_1901287006821347_2362593859642676997_n.jpg', 'sdfsf.png', '2018-05-10 04:54:44', '2018-05-15 03:28:59', NULL, '0000-00-00', 0, '', '', '', ''),
(7, 'tesa2', 'test2@gmail.com', '011990081', 0, 0, '', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-10 04:54:44', '2018-05-11 11:21:20', '2018-05-11 11:21:20', '0000-00-00', 0, '', '', '', ''),
(8, 'doc(63).pdf', 'sdf@gmai.com', '071632884848', 4000, 30000, 'abc.txt', 'ICT', 0, 24, '2018-05-11 05:54:13', '0000-00-00 00:00:00', 0, 'mmfk', '', '', '', '2018-05-10 04:18:20', '2018-05-11 05:54:13', NULL, '0000-00-00', 45, 'MBA', 'fghgfh', '', ''),
(9, 'nimesh gayanga', 'sdf@gmai.com', '071632884848', 0, 0, 'doc(57).pdf', 'ICT', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-10 04:20:35', '2018-05-11 11:21:11', '2018-05-11 11:21:11', '0000-00-00', 45, 'MBA', 'fghgfh', '', ''),
(10, 'chathuranga fonseka', 'chath@gmail.com', '476456786', 0, 0, 'doc(63).pdf', 'Buisness Studies', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-10 04:23:40', '2018-05-13 17:08:44', '2018-05-13 17:08:44', '0000-00-00', 56, 'HND', 'fghgfh', '', ''),
(11, 'kasun weththasingha', 'kasun@gmail.com', '0716484584', 0, 0, 'NumberChange_Activation_Deactivation_OwnershipTransfer_Points_Transfer_S.pdf', 'ICT', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-10 04:27:21', '2018-05-13 17:08:57', '2018-05-13 17:08:57', '0000-00-00', 50, 'MBA', 'fghgfh', '', ''),
(12, 'nimesh gayanga', 'sdf@gmai.com', '071632884848', 0, 0, 'doc(58).pdf', 'Buisness Studies', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-10 04:37:01', '2018-05-13 17:09:09', '2018-05-13 17:09:09', '0000-00-00', 78, 'MBA', 'fghgfh', '', ''),
(13, 'fsdfsdfsd', 'dfsf@dfgd.com', 'sdfdsfsdf', 2500, 1000, 'download.png', 'Buisness Studies', 0, 24, '2018-05-11 07:24:05', '0000-00-00 00:00:00', 0, 'Test Assingment', 'download.png', '', '', '2018-05-10 05:08:26', '2018-05-11 07:24:05', NULL, '0000-00-00', 4, 'MBA', 'sdfdsfds', '', ''),
(14, '', '', '', 0, 0, '14.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-10 22:04:09', '2018-05-13 17:09:20', '2018-05-13 17:09:20', '0000-00-00', 56, 'MBA', 'this is a palty hksdfbg nsdfhh vsdfu bsdvgfjksd bsdf bnsdfjsd ', 'topic documnet', 'Harward'),
(15, 'kasun Batagoda', 'kasun@gmail.com', '071699541', 0, 0, '15.zip', 'Course Work', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-10 22:12:13', '2018-05-13 17:09:42', '2018-05-13 17:09:42', '0000-00-00', 45, 'Diploma', 'abcabc', 'kasuns', 'Chicago'),
(16, 'nimesh gayanga', 'nimesh@gmail.com', '07111111', 0, 0, '16.zip', 'Course Work', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-10 22:24:28', '2018-05-13 17:09:59', '2018-05-13 17:09:59', '0000-00-00', 45, 'MBA', 'asdasd asd asd ', 'abc', 'Turobian'),
(17, 'nimesh gayanga', 'nimesh@gmail.com', '07111111', 0, 0, '17.zip', 'Course Work', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-10 22:26:33', '2018-05-13 17:11:30', '2018-05-13 17:11:30', '0000-00-00', 45, 'MBA', 'asdasd asd asd ', 'abc', 'Turobian'),
(18, 'nimesh gayanga', 'sdf@gmai.com', '071632884848', 0, 0, '18.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-10 22:27:48', '2018-05-13 17:11:50', '2018-05-13 17:11:50', '0000-00-00', 45, 'PHD', 'sgfdfgdfg sdfgdfgdfg', 'abc', 'APA'),
(19, 'nimesh gayanga', 'sdf@gmai.com', '071632884848', 0, 0, '19.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-10 22:32:24', '2018-05-13 17:11:59', '2018-05-13 17:11:59', '0000-00-00', 45, 'PHD', 'sgfdfgdfg sdfgdfgdfg', 'abc', 'APA'),
(20, 'kasun weththasingha', 'kasun@gmail.com', '119', 0, 0, '20.zip', 'Research', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-10 22:41:38', '2018-05-13 17:12:21', '2018-05-13 17:12:21', '0000-00-00', 45, 'Bachelor Degree', 'sdgdfgdfgfdg', 'kasuns', 'MLA'),
(21, 'jhon cena', 'cena@ymail.com', '0743423213', 0, 0, '21.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-11 02:10:37', '2018-05-13 17:12:34', '2018-05-13 17:12:34', '0000-00-00', 67, 'Bachelor Degree', 'abc', 'bms', 'Harward'),
(22, 'jhon cena', 'cena@ymail.com', '0743423213', 0, 0, '22.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-11 02:58:11', '2018-05-13 17:12:46', '2018-05-13 17:12:46', '0000-00-00', 67, 'Bachelor Degree', 'abc', 'bms', 'Harward'),
(23, 'nimesh gayanga', 'sdf@gmai.com', 'sdf', 0, 0, '23.zip', 'Course Work', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-11 04:37:56', '2018-05-13 17:13:27', '2018-05-13 17:13:27', '0000-00-00', 45, 'MBA', 'fthgfh gh gfh', 'abc', 'Chicago'),
(24, 'nimesh gayanga', 'sdf@gmai.com', 'sdf', 0, 0, '24.zip', 'Course Work', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-11 04:42:21', '2018-05-13 17:13:39', '2018-05-13 17:13:39', '0000-00-00', 45, 'MBA', 'fthgfh gh gfh', 'abc', 'Chicago'),
(25, 'abc', 'sdf@gmai.com', '071632884848', 0, 0, '25.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-11 04:44:19', '2018-05-13 17:13:48', '2018-05-13 17:13:48', '2018-05-12', 45, 'Bachelor Degree', 'fghfgh', 'kasuns', 'Chicago'),
(26, 'nimesh gayanga', 'sdf@gmai.com', '0716328848', 0, 0, '26.zip', 'Course Work', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-11 04:54:39', '2018-05-13 17:13:58', '2018-05-13 17:13:58', '2018-05-12', 45, 'MBA', 'ssdd', 'abc', 'APA'),
(27, 'nimesh gayanga', 'sdf@gmai.com', '07111111', 0, 0, '27.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-11 05:05:20', '2018-05-13 17:17:06', '2018-05-13 17:17:06', '2018-05-12', 45, 'MBA', 'sdgfsd sdfsdf sdfsdf', 'kasuns', 'Chicago'),
(28, 'nnnnnn', 'nimesh@gmail.com', '07111111', 0, 0, '28.zip', 'Course Work', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-11 05:08:45', '2018-05-13 17:17:18', '2018-05-13 17:17:18', '2018-05-19', 45, 'MBA', 'asdhjuasdf bhsdf', 'kasuns', 'Chicago'),
(29, 'nimesh gayanga', 'sdf@gmai.com', '071632884', 0, 0, '29.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-11 05:31:04', '2018-05-13 17:17:28', '2018-05-13 17:17:28', '2018-05-19', 45, 'PHD', 'xcvdgfsdfgdfg', 'abc', 'APA'),
(30, 'nimesh gayanga', 'sdf@gmai.com', '07111111', 0, 0, '30.zip', 'Research', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-11 05:39:17', '2018-05-13 17:17:43', '2018-05-13 17:17:43', '2018-05-12', 45, 'PHD', 'fghjgfhgfh', 'abc', 'MLA'),
(31, 'Test Assingment', 'thilina25091987@gmail.com', '0769053062', 0, 0, '31.zip', 'Research', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-11 05:53:16', '2018-05-14 07:36:36', '2018-05-14 07:36:36', '0000-00-00', 50000, 'PHD', '', 'Test', 'MLA'),
(32, 'nimesh gayanga', 'sdf@gmai.com', '07111111', 0, 0, '32.zip', 'Course Work', 0, 24, '2018-05-14 09:11:19', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-11 05:57:36', '2018-05-14 09:11:19', NULL, '2018-05-24', 45, 'Bachelor Degree', 'hjkhjkhjkhjk', 'abc', 'Chicago'),
(33, 'nimesh gayanga', 'sdf@gmai.com', '07111111', 100, 500, '33.zip', 'Course Work', 0, 24, '2018-05-14 11:11:24', '0000-00-00 00:00:00', 0, '<br>', '', '', '', '2018-05-11 05:58:35', '2018-05-14 11:11:24', NULL, '2018-05-12', 45, 'MBA', 'gfhjhj', 'abc', 'APA'),
(34, 'Test Assignment 002', 'thilina25091987@gmail.com', '0769035062', 0, 0, '34.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-11 06:08:34', '2018-05-14 12:57:33', '2018-05-14 12:57:33', '2017-05-11', 200, 'PHD', 'dfsfdsf', 'Test', 'MLA'),
(35, 'Test Assignment 003', 'thilina25091987@gmail.com', '0769035062', 98, 0, '35.zip', 'Case Study', 0, 24, '2018-05-14 11:47:33', '0000-00-00 00:00:00', 0, '<br>', '', '', '', '2018-05-11 06:13:47', '2018-05-14 11:47:33', NULL, '2018-05-12', 500, 'PHD', 'sdfdsf', 'sdfdsf', 'MLA'),
(36, 'Kasun Kalya Peiris', 'thilina_25c@yahoo.com', '0769035062', 5000, 2000, '36.zip', 'Case Study', 1, 34, '2018-05-15 03:13:09', '0000-00-00 00:00:00', 0, 'fsdfsfsdfds', 'PBSS-Logo.jpg', '', '', '2018-05-13 06:36:55', '2018-05-15 03:15:32', NULL, '2018-05-14', 50000, 'PHD', 'sdfsfsfsd', 'Assignment', 'MLA'),
(37, 'jhon cena', 'cena@ymail.com', '0743423213', 0, 0, '37.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-13 20:43:39', '2018-05-14 12:57:26', '2018-05-14 12:57:26', '2018-05-15', 456, 'MBA', 'wwtwer rtret', 'bms', 'Turobian'),
(38, 'ghgh', 'cena@ymail.com', '0743423213', 0, 0, '38.zip', 'Course Work', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-13 20:46:34', '2018-05-14 12:57:18', '2018-05-14 12:57:18', '2018-05-15', 34, 'MBA', '34r43t34 wrt43t4', 'bms', 'Turobian'),
(39, 'ghgh', 'cena@ymail.com', '0743423213', 0, 0, '39.zip', 'Course Work', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-13 20:51:24', '2018-05-14 12:57:11', '2018-05-14 12:57:11', '2018-05-15', 34, 'MBA', '34r43t34 wrt43t4', 'bms', 'Turobian'),
(40, 'ghgh', 'cena@ymail.com', '0743423213', 0, 0, '40.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-13 20:57:42', '2018-05-14 12:57:04', '2018-05-14 12:57:04', '2018-05-15', 456, 'Bachelor Degree', 'asdfds fsdfdsf', 'bms', 'APA'),
(41, 'jhons cena', 'cena@ymail.com', '0743423213', 5500, 2000, '41.zip', 'Course Work', 0, 24, '2018-05-14 07:38:31', '0000-00-00 00:00:00', 0, '<br>', '', '', '', '2018-05-13 21:00:59', '2018-05-14 07:38:31', NULL, '2018-05-15', 650, 'MBA', 'asafsfdgh thdhgf', 'bms', 'APA'),
(42, 'jhon cena', 'cena@ymail.com', '0743423213', 0, 0, '42.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-13 21:12:25', '2018-05-14 07:36:54', '2018-05-14 07:36:54', '2018-05-15', 555, 'MBA', 'sesrr gugug', 'bms', 'APA'),
(43, 'jhon cena', 'cena@ymail.com', '0743423213', 676767, 1000, '43.zip', 'Research', 0, 24, '2018-05-14 12:52:35', '0000-00-00 00:00:00', 0, 'EWWRWEREWR<br>', 'myassignment-girl.png', '', '', '2018-05-13 23:26:00', '2018-05-14 12:52:35', NULL, '2018-05-15', 45, 'MBA', '3erwwfger ergerg', 'bms', 'APA'),
(44, 'ghgh', 'cena@ymail.com', '0743423213', 0, 0, '44.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-13 23:44:25', '2018-05-14 12:56:56', '2018-05-14 12:56:56', '2018-05-15', 568, 'Diploma', 'drrfdr tfhtgf', 'bms', 'APA'),
(45, 'jhon cena', 'cena@ymail.com', '0774327345', 0, 0, '45.zip', 'Course Work', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-14 01:20:48', '2018-05-14 12:56:48', '2018-05-14 12:56:48', '2018-05-15', 789, 'MBA', 'qwhduwqh wahduqwhduqw eofuhsdafua', 'bms', 'APA'),
(46, 'jhon cena', 'nimeshgayanga@gmail.com', '0774327345', 0, 0, '46.zip', 'Course Work', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-14 01:24:37', '2018-05-14 12:56:38', '2018-05-14 12:56:38', '2018-05-15', 789, 'MBA', 'qwhduwqh wahduqwhduqw eofuhsdafua', 'bms', 'APA'),
(47, 'jhon cena', 'nimeshgayanga@gmail.com', '0774327345', 0, 0, '47.zip', 'Course Work', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-14 01:33:27', '2018-05-14 12:56:29', '2018-05-14 12:56:29', '2018-05-15', 789, 'MBA', 'qwhduwqh wahduqwhduqw eofuhsdafua', 'bms', 'APA'),
(48, 'jhon cena', 'nimeshgayanga@gmail.com', '0774327345', 10000, 5000, '48.zip', 'Course Work', 0, 31, '2018-05-14 12:53:16', '0000-00-00 00:00:00', 0, 'WEWEF<br>', 'myassignment-girl.png', '', '', '2018-05-14 01:34:17', '2018-05-14 12:53:16', NULL, '2018-05-15', 789, 'MBA', 'qwhduwqh wahduqwhduqw eofuhsdafua', 'bms', 'APA'),
(49, 'jhon cena', 'cena@ymail.com', '0743423213', 0, 0, '49.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-14 01:34:55', '2018-05-14 12:52:50', '2018-05-14 12:52:50', '2018-05-15', 450, 'Bachelor Degree', 'gjhgj ', 'bms', 'Chicago'),
(50, 'jhon cena', 'nimeshgayanga@gmail.com', '0743423213', 1000, 200, '50.zip', 'Course Work', 0, 31, '2018-05-14 12:52:07', '0000-00-00 00:00:00', 0, 'SFSDFSFDS<br>', 'myassignment-girl.png', '', '', '2018-05-14 01:36:56', '2018-05-14 12:52:07', NULL, '2018-05-15', 890, 'Bachelor Degree', 'gdghhyjfjyy', 'bms', 'Chicago'),
(51, 'ghgh', 'nimeshgayanga@gmail.com', '0774327345', 5000, 1500, '51.zip', 'Essay', 0, 31, '2018-05-14 12:42:33', '0000-00-00 00:00:00', 0, 'this need be done before <br>', 'myassignment-girl.png', '', '', '2018-05-14 01:38:47', '2018-05-14 12:42:33', NULL, '2018-05-15', 789, 'Diploma', 'fdgdhgchg', 'bms', 'APA'),
(52, 'Test Assignment 001', 'test001@mail.com', '0775997607', 5000, 500, '52.zip', 'Case Study', 1, 34, '2018-05-14 13:23:35', '0000-00-00 00:00:00', 0, 'sdfsfs', 'Attendance device employee enroll.png', '', '', '2018-05-14 03:38:44', '2018-05-14 13:24:49', NULL, '2018-05-14', 123456, 'PHD', 'sdfsf', 'Test', 'MLA'),
(53, 'kalya', 'kasun.kalya@gmail.com', '0775115163', 1000, 0, '53.zip', 'Course Work', 1, 34, '2018-05-15 03:24:45', '0000-00-00 00:00:00', 0, '<br>', '', '', '', '2018-05-14 17:54:14', '2018-05-15 03:24:59', NULL, '2018-05-31', 20, 'PHD', 'adfdsfdsf', 'test', 'APA'),
(54, 'testtt', 'kasun.kalya@gmail.com', '0775115136', 1000, 0, '54.zip', 'Case Study', 1, 34, '2018-05-15 03:26:47', '0000-00-00 00:00:00', 0, '<br>', '', '', '', '2018-05-14 17:56:13', '2018-05-15 03:27:02', NULL, '2018-05-31', 20, 'PHD', 'fdsfs', 'test', 'APA'),
(55, 'ghgh', 'cena@ymail.com', '0743423213', 0, 0, '55.zip', 'Case Study', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', '', '', '2018-05-14 19:20:48', '0000-00-00 00:00:00', NULL, '2018-05-17', 678, 'PHD', 'dttd jytjytyj', 'bms', 'Turobian');

-- --------------------------------------------------------

--
-- Table structure for table `common`
--

CREATE TABLE `common` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `discription` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `common`
--

INSERT INTO `common` (`id`, `type`, `discription`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'video', '29HZtqQu23M', '2016-07-02 06:53:19', '2016-07-02 19:23:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fonts-list`
--

CREATE TABLE `fonts-list` (
  `id` int(15) NOT NULL,
  `type` varchar(30) DEFAULT NULL,
  `icon` varchar(30) DEFAULT NULL,
  `unicode` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fonts-list`
--

INSERT INTO `fonts-list` (`id`, `type`, `icon`, `unicode`) VALUES
(1, 'fa', 'fa-adjust', '&#xf042;'),
(2, 'fa', 'fa-adn', '&#xf170;'),
(3, 'fa', 'fa-align-center', '&#xf037;'),
(4, 'fa', 'fa-align-justify', '&#xf039;'),
(5, 'fa', 'fa-align-left', '&#xf036;'),
(6, 'fa', 'fa-align-right', '&#xf038;'),
(7, 'fa', 'fa-ambulance', '&#xf0f9;'),
(8, 'fa', 'fa-anchor', '&#xf13d;'),
(9, 'fa', 'fa-android', '&#xf17b;'),
(10, 'fa', 'fa-angellist', '&#xf209;'),
(11, 'fa', 'fa-angle-double-down', '&#xf103;'),
(12, 'fa', 'fa-angle-double-left', '&#xf100;'),
(13, 'fa', 'fa-angle-double-right', '&#xf101;'),
(14, 'fa', 'fa-angle-double-up', '&#xf102;'),
(15, 'fa', 'fa-angle-down', '&#xf107;'),
(16, 'fa', 'fa-angle-left', '&#xf104;'),
(17, 'fa', 'fa-angle-right', '&#xf105;'),
(18, 'fa', 'fa-angle-up', '&#xf106;'),
(19, 'fa', 'fa-apple', '&#xf179;'),
(20, 'fa', 'fa-archive', '&#xf187;'),
(21, 'fa', 'fa-area-chart', '&#xf1fe;'),
(22, 'fa', 'fa-arrow-circle-down', '&#xf0ab;'),
(23, 'fa', 'fa-arrow-circle-left', '&#xf0a8;'),
(24, 'fa', 'fa-arrow-circle-o-down', '&#xf01a;'),
(25, 'fa', 'fa-arrow-circle-o-left', '&#xf190;'),
(26, 'fa', 'fa-arrow-circle-o-right', '&#xf18e;'),
(27, 'fa', 'fa-arrow-circle-o-up', '&#xf01b;'),
(28, 'fa', 'fa-arrow-circle-right', '&#xf0a9;'),
(29, 'fa', 'fa-arrow-circle-up', '&#xf0aa;'),
(30, 'fa', 'fa-arrow-down', '&#xf063;'),
(31, 'fa', 'fa-arrow-left', '&#xf060;'),
(32, 'fa', 'fa-arrow-right', '&#xf061;'),
(33, 'fa', 'fa-arrow-up', '&#xf062;'),
(34, 'fa', 'fa-arrows', '&#xf047;'),
(35, 'fa', 'fa-arrows-alt', '&#xf0b2;'),
(36, 'fa', 'fa-arrows-h', '&#xf07e;'),
(37, 'fa', 'fa-arrows-v', '&#xf07d;'),
(38, 'fa', 'fa-asterisk', '&#xf069;'),
(39, 'fa', 'fa-at', '&#xf1fa;'),
(40, 'fa', 'fa-automobile(alias)', '&#xf1b9;'),
(41, 'fa', 'fa-backward', '&#xf04a;'),
(42, 'fa', 'fa-ban', '&#xf05e;'),
(43, 'fa', 'fa-bank(alias)', '&#xf19c;'),
(44, 'fa', 'fa-bar-chart', '&#xf080;'),
(45, 'fa', 'fa-bar-chart-o(alias)', '&#xf080;'),
(46, 'fa', 'fa-barcode', '&#xf02a;'),
(47, 'fa', 'fa-bars', '&#xf0c9;'),
(48, 'fa', 'fa-bed', '&#xf236;'),
(49, 'fa', 'fa-beer', '&#xf0fc;'),
(50, 'fa', 'fa-behance', '&#xf1b4;'),
(51, 'fa', 'fa-behance-square', '&#xf1b5;'),
(52, 'fa', 'fa-bell', '&#xf0f3;'),
(53, 'fa', 'fa-bell-o', '&#xf0a2;'),
(54, 'fa', 'fa-bell-slash', '&#xf1f6;'),
(55, 'fa', 'fa-bell-slash-o', '&#xf1f7;'),
(56, 'fa', 'fa-bicycle', '&#xf206;'),
(57, 'fa', 'fa-binoculars', '&#xf1e5;'),
(58, 'fa', 'fa-birthday-cake', '&#xf1fd;'),
(59, 'fa', 'fa-bitbucket', '&#xf171;'),
(60, 'fa', 'fa-bitbucket-square', '&#xf172;'),
(61, 'fa', 'fa-bitcoin(alias)', '&#xf15a;'),
(62, 'fa', 'fa-bold', '&#xf032;'),
(63, 'fa', 'fa-bolt', '&#xf0e7;'),
(64, 'fa', 'fa-bomb', '&#xf1e2;'),
(65, 'fa', 'fa-book', '&#xf02d;'),
(66, 'fa', 'fa-bookmark', '&#xf02e;'),
(67, 'fa', 'fa-bookmark-o', '&#xf097;'),
(68, 'fa', 'fa-briefcase', '&#xf0b1;'),
(69, 'fa', 'fa-btc', '&#xf15a;'),
(70, 'fa', 'fa-bug', '&#xf188;'),
(71, 'fa', 'fa-building', '&#xf1ad;'),
(72, 'fa', 'fa-building-o', '&#xf0f7;'),
(73, 'fa', 'fa-bullhorn', '&#xf0a1;'),
(74, 'fa', 'fa-bullseye', '&#xf140;'),
(75, 'fa', 'fa-bus', '&#xf207;'),
(76, 'fa', 'fa-buysellads', NULL),
(77, 'fa', 'fa-cab(alias)', NULL),
(78, 'fa', 'fa-calculator', NULL),
(79, 'fa', 'fa-calendar', NULL),
(80, 'fa', 'fa-calendar-o', NULL),
(81, 'fa', 'fa-camera', NULL),
(82, 'fa', 'fa-camera-retro', NULL),
(83, 'fa', 'fa-car', NULL),
(84, 'fa', 'fa-caret-down', NULL),
(85, 'fa', 'fa-caret-left', NULL),
(86, 'fa', 'fa-caret-right', NULL),
(87, 'fa', 'fa-caret-square-o-down', NULL),
(88, 'fa', 'fa-caret-square-o-left', NULL),
(89, 'fa', 'fa-caret-square-o-right', NULL),
(90, 'fa', 'fa-caret-square-o-up', NULL),
(91, 'fa', 'fa-caret-up', NULL),
(92, 'fa', 'fa-cart-arrow-down', NULL),
(93, 'fa', 'fa-cart-plus', NULL),
(94, 'fa', 'fa-cc', NULL),
(95, 'fa', 'fa-cc-amex', NULL),
(96, 'fa', 'fa-cc-discover', NULL),
(97, 'fa', 'fa-cc-mastercard', NULL),
(98, 'fa', 'fa-cc-paypal', NULL),
(99, 'fa', 'fa-cc-stripe', NULL),
(100, 'fa', 'fa-cc-visa', NULL),
(101, 'fa', 'fa-certificate', NULL),
(102, 'fa', 'fa-chain(alias)', NULL),
(103, 'fa', 'fa-chain-broken', NULL),
(104, 'fa', 'fa-check', NULL),
(105, 'fa', 'fa-check-circle', NULL),
(106, 'fa', 'fa-check-circle-o', NULL),
(107, 'fa', 'fa-check-square', NULL),
(108, 'fa', 'fa-check-square-o', NULL),
(109, 'fa', 'fa-chevron-circle-down', NULL),
(110, 'fa', 'fa-chevron-circle-left', NULL),
(111, 'fa', 'fa-chevron-circle-right', NULL),
(112, 'fa', 'fa-chevron-circle-up', NULL),
(113, 'fa', 'fa-chevron-down', NULL),
(114, 'fa', 'fa-chevron-left', NULL),
(115, 'fa', 'fa-chevron-right', NULL),
(116, 'fa', 'fa-chevron-up', NULL),
(117, 'fa', 'fa-child', NULL),
(118, 'fa', 'fa-circle', NULL),
(119, 'fa', 'fa-circle-o', NULL),
(120, 'fa', 'fa-circle-o-notch', NULL),
(121, 'fa', 'fa-circle-thin', NULL),
(122, 'fa', 'fa-clipboard', NULL),
(123, 'fa', 'fa-clock-o', NULL),
(124, 'fa', 'fa-close(alias)', NULL),
(125, 'fa', 'fa-cloud', NULL),
(126, 'fa', 'fa-cloud-download', NULL),
(127, 'fa', 'fa-cloud-upload', NULL),
(128, 'fa', 'fa-cny(alias)', NULL),
(129, 'fa', 'fa-code', NULL),
(130, 'fa', 'fa-code-fork', NULL),
(131, 'fa', 'fa-codepen', NULL),
(132, 'fa', 'fa-coffee', NULL),
(133, 'fa', 'fa-cog', NULL),
(134, 'fa', 'fa-cogs', NULL),
(135, 'fa', 'fa-columns', NULL),
(136, 'fa', 'fa-comment', NULL),
(137, 'fa', 'fa-comment-o', NULL),
(138, 'fa', 'fa-comments', NULL),
(139, 'fa', 'fa-comments-o', NULL),
(140, 'fa', 'fa-compass', NULL),
(141, 'fa', 'fa-compress', NULL),
(142, 'fa', 'fa-connectdevelop', NULL),
(143, 'fa', 'fa-copy(alias)', NULL),
(144, 'fa', 'fa-copyright', NULL),
(145, 'fa', 'fa-credit-card', NULL),
(146, 'fa', 'fa-crop', NULL),
(147, 'fa', 'fa-crosshairs', NULL),
(148, 'fa', 'fa-css3', NULL),
(149, 'fa', 'fa-cube', NULL),
(150, 'fa', 'fa-cubes', NULL),
(151, 'fa', 'fa-cut(alias)', NULL),
(152, 'fa', 'fa-cutlery', NULL),
(153, 'fa', 'fa-dashboard(alias)', NULL),
(154, 'fa', 'fa-dashcube', NULL),
(155, 'fa', 'fa-database', NULL),
(156, 'fa', 'fa-dedent(alias)', NULL),
(157, 'fa', 'fa-delicious', NULL),
(158, 'fa', 'fa-desktop', NULL),
(159, 'fa', 'fa-deviantart', NULL),
(160, 'fa', 'fa-diamond', NULL),
(161, 'fa', 'fa-digg', NULL),
(162, 'fa', 'fa-dollar(alias)', NULL),
(163, 'fa', 'fa-dot-circle-o', NULL),
(164, 'fa', 'fa-download', NULL),
(165, 'fa', 'fa-dribbble', NULL),
(166, 'fa', 'fa-dropbox', NULL),
(167, 'fa', 'fa-drupal', NULL),
(168, 'fa', 'fa-edit(alias)', NULL),
(169, 'fa', 'fa-eject', NULL),
(170, 'fa', 'fa-ellipsis-h', NULL),
(171, 'fa', 'fa-ellipsis-v', NULL),
(172, 'fa', 'fa-empire', NULL),
(173, 'fa', 'fa-envelope', NULL),
(174, 'fa', 'fa-envelope-o', NULL),
(175, 'fa', 'fa-envelope-square', NULL),
(176, 'fa', 'fa-eraser', NULL),
(177, 'fa', 'fa-eur', NULL),
(178, 'fa', 'fa-euro(alias)', NULL),
(179, 'fa', 'fa-exchange', NULL),
(180, 'fa', 'fa-exclamation', NULL),
(181, 'fa', 'fa-exclamation-circle', NULL),
(182, 'fa', 'fa-exclamation-triangle', NULL),
(183, 'fa', 'fa-expand', NULL),
(184, 'fa', 'fa-external-link', NULL),
(185, 'fa', 'fa-external-link-square', NULL),
(186, 'fa', 'fa-eye', NULL),
(187, 'fa', 'fa-eye-slash', NULL),
(188, 'fa', 'fa-eyedropper', NULL),
(189, 'fa', 'fa-facebook', NULL),
(190, 'fa', 'fa-facebook-f(alias)', NULL),
(191, 'fa', 'fa-facebook-official', NULL),
(192, 'fa', 'fa-facebook-square', NULL),
(193, 'fa', 'fa-fast-backward', NULL),
(194, 'fa', 'fa-fast-forward', NULL),
(195, 'fa', 'fa-fax', NULL),
(196, 'fa', 'fa-female', NULL),
(197, 'fa', 'fa-fighter-jet', NULL),
(198, 'fa', 'fa-file', NULL),
(199, 'fa', 'fa-file-archive-o', NULL),
(200, 'fa', 'fa-file-audio-o', NULL),
(201, 'fa', 'fa-file-code-o', NULL),
(202, 'fa', 'fa-file-excel-o', NULL),
(203, 'fa', 'fa-file-image-o', NULL),
(204, 'fa', 'fa-file-movie-o(alias)', NULL),
(205, 'fa', 'fa-file-o', NULL),
(206, 'fa', 'fa-file-pdf-o', NULL),
(207, 'fa', 'fa-file-photo-o(alias)', NULL),
(208, 'fa', 'fa-file-picture-o(alias)', NULL),
(209, 'fa', 'fa-file-powerpoint-o', NULL),
(210, 'fa', 'fa-file-sound-o(alias)', NULL),
(211, 'fa', 'fa-file-text', NULL),
(212, 'fa', 'fa-file-text-o', NULL),
(213, 'fa', 'fa-file-video-o', NULL),
(214, 'fa', 'fa-file-word-o', NULL),
(215, 'fa', 'fa-file-zip-o(alias)', NULL),
(216, 'fa', 'fa-files-o', NULL),
(217, 'fa', 'fa-film', NULL),
(218, 'fa', 'fa-filter', NULL),
(219, 'fa', 'fa-fire', NULL),
(220, 'fa', 'fa-fire-extinguisher', NULL),
(221, 'fa', 'fa-flag', NULL),
(222, 'fa', 'fa-flag-checkered', NULL),
(223, 'fa', 'fa-flag-o', NULL),
(224, 'fa', 'fa-flash(alias)', NULL),
(225, 'fa', 'fa-flask', NULL),
(226, 'fa', 'fa-flickr', NULL),
(227, 'fa', 'fa-floppy-o', NULL),
(228, 'fa', 'fa-folder', NULL),
(229, 'fa', 'fa-folder-o', NULL),
(230, 'fa', 'fa-folder-open', NULL),
(231, 'fa', 'fa-folder-open-o', NULL),
(232, 'fa', 'fa-font', NULL),
(233, 'fa', 'fa-forumbee', NULL),
(234, 'fa', 'fa-forward', NULL),
(235, 'fa', 'fa-foursquare', NULL),
(236, 'fa', 'fa-frown-o', NULL),
(237, 'fa', 'fa-futbol-o', NULL),
(238, 'fa', 'fa-gamepad', NULL),
(239, 'fa', 'fa-gavel', NULL),
(240, 'fa', 'fa-gbp', NULL),
(241, 'fa', 'fa-ge(alias)', NULL),
(242, 'fa', 'fa-gear(alias)', NULL),
(243, 'fa', 'fa-gears(alias)', NULL),
(244, 'fa', 'fa-genderless(alias)', NULL),
(245, 'fa', 'fa-gift', NULL),
(246, 'fa', 'fa-git', NULL),
(247, 'fa', 'fa-git-square', NULL),
(248, 'fa', 'fa-github', NULL),
(249, 'fa', 'fa-github-alt', NULL),
(250, 'fa', 'fa-github-square', NULL),
(251, 'fa', 'fa-gittip(alias)', NULL),
(252, 'fa', 'fa-glass', NULL),
(253, 'fa', 'fa-globe', NULL),
(254, 'fa', 'fa-google', NULL),
(255, 'fa', 'fa-google-plus', NULL),
(256, 'fa', 'fa-google-plus-square', NULL),
(257, 'fa', 'fa-google-wallet', NULL),
(258, 'fa', 'fa-graduation-cap', NULL),
(259, 'fa', 'fa-gratipay', NULL),
(260, 'fa', 'fa-group(alias)', NULL),
(261, 'fa', 'fa-h-square', NULL),
(262, 'fa', 'fa-hacker-news', NULL),
(263, 'fa', 'fa-hand-o-down', NULL),
(264, 'fa', 'fa-hand-o-left', NULL),
(265, 'fa', 'fa-hand-o-right', NULL),
(266, 'fa', 'fa-hand-o-up', NULL),
(267, 'fa', 'fa-hdd-o', NULL),
(268, 'fa', 'fa-header', NULL),
(269, 'fa', 'fa-headphones', NULL),
(270, 'fa', 'fa-heart', NULL),
(271, 'fa', 'fa-heart-o', NULL),
(272, 'fa', 'fa-heartbeat', NULL),
(273, 'fa', 'fa-history', NULL),
(274, 'fa', 'fa-home', NULL),
(275, 'fa', 'fa-hospital-o', NULL),
(276, 'fa', 'fa-hotel(alias)', NULL),
(277, 'fa', 'fa-html5', NULL),
(278, 'fa', 'fa-ils', NULL),
(279, 'fa', 'fa-image(alias)', NULL),
(280, 'fa', 'fa-inbox', NULL),
(281, 'fa', 'fa-indent', NULL),
(282, 'fa', 'fa-info', NULL),
(283, 'fa', 'fa-info-circle', NULL),
(284, 'fa', 'fa-inr', NULL),
(285, 'fa', 'fa-instagram', NULL),
(286, 'fa', 'fa-institution(alias)', NULL),
(287, 'fa', 'fa-ioxhost', NULL),
(288, 'fa', 'fa-italic', NULL),
(289, 'fa', 'fa-joomla', NULL),
(290, 'fa', 'fa-jpy', NULL),
(291, 'fa', 'fa-jsfiddle', NULL),
(292, 'fa', 'fa-key', NULL),
(293, 'fa', 'fa-keyboard-o', NULL),
(294, 'fa', 'fa-krw', NULL),
(295, 'fa', 'fa-language', NULL),
(296, 'fa', 'fa-laptop', NULL),
(297, 'fa', 'fa-lastfm', NULL),
(298, 'fa', 'fa-lastfm-square', NULL),
(299, 'fa', 'fa-leaf', NULL),
(300, 'fa', 'fa-leanpub', NULL),
(301, 'fa', 'fa-legal(alias)', NULL),
(302, 'fa', 'fa-lemon-o', NULL),
(303, 'fa', 'fa-level-down', NULL),
(304, 'fa', 'fa-level-up', NULL),
(305, 'fa', 'fa-life-bouy(alias)', NULL),
(306, 'fa', 'fa-life-buoy(alias)', NULL),
(307, 'fa', 'fa-life-ring', NULL),
(308, 'fa', 'fa-life-saver(alias)', NULL),
(309, 'fa', 'fa-lightbulb-o', NULL),
(310, 'fa', 'fa-line-chart', NULL),
(311, 'fa', 'fa-link', NULL),
(312, 'fa', 'fa-linkedin', NULL),
(313, 'fa', 'fa-linkedin-square', NULL),
(314, 'fa', 'fa-linux', NULL),
(315, 'fa', 'fa-list', NULL),
(316, 'fa', 'fa-list-alt', NULL),
(317, 'fa', 'fa-list-ol', NULL),
(318, 'fa', 'fa-list-ul', NULL),
(319, 'fa', 'fa-location-arrow', NULL),
(320, 'fa', 'fa-lock', NULL),
(321, 'fa', 'fa-long-arrow-down', NULL),
(322, 'fa', 'fa-long-arrow-left', NULL),
(323, 'fa', 'fa-long-arrow-right', NULL),
(324, 'fa', 'fa-long-arrow-up', NULL),
(325, 'fa', 'fa-magic', NULL),
(326, 'fa', 'fa-magnet', NULL),
(327, 'fa', 'fa-mail-forward(alias)', NULL),
(328, 'fa', 'fa-mail-reply(alias)', NULL),
(329, 'fa', 'fa-mail-reply-all(alias)', NULL),
(330, 'fa', 'fa-male', NULL),
(331, 'fa', 'fa-map-marker', NULL),
(332, 'fa', 'fa-mars', NULL),
(333, 'fa', 'fa-mars-double', NULL),
(334, 'fa', 'fa-mars-stroke', NULL),
(335, 'fa', 'fa-mars-stroke-h', NULL),
(336, 'fa', 'fa-mars-stroke-v', NULL),
(337, 'fa', 'fa-maxcdn', NULL),
(338, 'fa', 'fa-meanpath', NULL),
(339, 'fa', 'fa-medium', NULL),
(340, 'fa', 'fa-medkit', NULL),
(341, 'fa', 'fa-meh-o', NULL),
(342, 'fa', 'fa-mercury', NULL),
(343, 'fa', 'fa-microphone', NULL),
(344, 'fa', 'fa-microphone-slash', NULL),
(345, 'fa', 'fa-minus', NULL),
(346, 'fa', 'fa-minus-circle', NULL),
(347, 'fa', 'fa-minus-square', NULL),
(348, 'fa', 'fa-minus-square-o', NULL),
(349, 'fa', 'fa-mobile', NULL),
(350, 'fa', 'fa-mobile-phone(alias)', NULL),
(351, 'fa', 'fa-money', NULL),
(352, 'fa', 'fa-moon-o', NULL),
(353, 'fa', 'fa-mortar-board(alias)', NULL),
(354, 'fa', 'fa-motorcycle', NULL),
(355, 'fa', 'fa-music', NULL),
(356, 'fa', 'fa-navicon(alias)', NULL),
(357, 'fa', 'fa-neuter', NULL),
(358, 'fa', 'fa-newspaper-o', NULL),
(359, 'fa', 'fa-openid', NULL),
(360, 'fa', 'fa-outdent', NULL),
(361, 'fa', 'fa-pagelines', NULL),
(362, 'fa', 'fa-paint-brush', NULL),
(363, 'fa', 'fa-paper-plane', NULL),
(364, 'fa', 'fa-paper-plane-o', NULL),
(365, 'fa', 'fa-paperclip', NULL),
(366, 'fa', 'fa-paragraph', NULL),
(367, 'fa', 'fa-paste(alias)', NULL),
(368, 'fa', 'fa-pause', NULL),
(369, 'fa', 'fa-paw', NULL),
(370, 'fa', 'fa-paypal', NULL),
(371, 'fa', 'fa-pencil', NULL),
(372, 'fa', 'fa-pencil-square', NULL),
(373, 'fa', 'fa-pencil-square-o', NULL),
(374, 'fa', 'fa-phone', NULL),
(375, 'fa', 'fa-phone-square', NULL),
(376, 'fa', 'fa-photo(alias)', NULL),
(377, 'fa', 'fa-picture-o', NULL),
(378, 'fa', 'fa-pie-chart', NULL),
(379, 'fa', 'fa-pied-piper', NULL),
(380, 'fa', 'fa-pied-piper-alt', NULL),
(381, 'fa', 'fa-pinterest', NULL),
(382, 'fa', 'fa-pinterest-p', NULL),
(383, 'fa', 'fa-pinterest-square', NULL),
(384, 'fa', 'fa-plane', NULL),
(385, 'fa', 'fa-play', NULL),
(386, 'fa', 'fa-play-circle', NULL),
(387, 'fa', 'fa-play-circle-o', NULL),
(388, 'fa', 'fa-plug', NULL),
(389, 'fa', 'fa-plus', NULL),
(390, 'fa', 'fa-plus-circle', NULL),
(391, 'fa', 'fa-plus-square', NULL),
(392, 'fa', 'fa-plus-square-o', NULL),
(393, 'fa', 'fa-power-off', NULL),
(394, 'fa', 'fa-print', NULL),
(395, 'fa', 'fa-puzzle-piece', NULL),
(396, 'fa', 'fa-qq', NULL),
(397, 'fa', 'fa-qrcode', NULL),
(398, 'fa', 'fa-question', NULL),
(399, 'fa', 'fa-question-circle', NULL),
(400, 'fa', 'fa-quote-left', NULL),
(401, 'fa', 'fa-quote-right', NULL),
(402, 'fa', 'fa-ra(alias)', NULL),
(403, 'fa', 'fa-random', NULL),
(404, 'fa', 'fa-rebel', NULL),
(405, 'fa', 'fa-recycle', NULL),
(406, 'fa', 'fa-reddit', NULL),
(407, 'fa', 'fa-reddit-square', NULL),
(408, 'fa', 'fa-refresh', NULL),
(409, 'fa', 'fa-remove(alias)', NULL),
(410, 'fa', 'fa-renren', NULL),
(411, 'fa', 'fa-reorder(alias)', NULL),
(412, 'fa', 'fa-repeat', NULL),
(413, 'fa', 'fa-reply', NULL),
(414, 'fa', 'fa-reply-all', NULL),
(415, 'fa', 'fa-retweet', NULL),
(416, 'fa', 'fa-rmb(alias)', NULL),
(417, 'fa', 'fa-road', NULL),
(418, 'fa', 'fa-rocket', NULL),
(419, 'fa', 'fa-rotate-left(alias)', NULL),
(420, 'fa', 'fa-rotate-right(alias)', NULL),
(421, 'fa', 'fa-rouble(alias)', NULL),
(422, 'fa', 'fa-rss', NULL),
(423, 'fa', 'fa-rss-square', NULL),
(424, 'fa', 'fa-rub', NULL),
(425, 'fa', 'fa-ruble(alias)', NULL),
(426, 'fa', 'fa-rupee(alias)', NULL),
(427, 'fa', 'fa-save(alias)', NULL),
(428, 'fa', 'fa-scissors', NULL),
(429, 'fa', 'fa-search', NULL),
(430, 'fa', 'fa-search-minus', NULL),
(431, 'fa', 'fa-search-plus', NULL),
(432, 'fa', 'fa-sellsy', NULL),
(433, 'fa', 'fa-send(alias)', NULL),
(434, 'fa', 'fa-send-o(alias)', NULL),
(435, 'fa', 'fa-server', NULL),
(436, 'fa', 'fa-share', NULL),
(437, 'fa', 'fa-share-alt', NULL),
(438, 'fa', 'fa-share-alt-square', NULL),
(439, 'fa', 'fa-share-square', NULL),
(440, 'fa', 'fa-share-square-o', NULL),
(441, 'fa', 'fa-shekel(alias)', NULL),
(442, 'fa', 'fa-sheqel(alias)', NULL),
(443, 'fa', 'fa-shield', NULL),
(444, 'fa', 'fa-ship', NULL),
(445, 'fa', 'fa-shirtsinbulk', NULL),
(446, 'fa', 'fa-shopping-cart', NULL),
(447, 'fa', 'fa-sign-in', NULL),
(448, 'fa', 'fa-sign-out', NULL),
(449, 'fa', 'fa-signal', NULL),
(450, 'fa', 'fa-simplybuilt', NULL),
(451, 'fa', 'fa-sitemap', NULL),
(452, 'fa', 'fa-skyatlas', NULL),
(453, 'fa', 'fa-skype', NULL),
(454, 'fa', 'fa-slack', NULL),
(455, 'fa', 'fa-sliders', NULL),
(456, 'fa', 'fa-slideshare', NULL),
(457, 'fa', 'fa-smile-o', NULL),
(458, 'fa', 'fa-soccer-ball-o(alias)', NULL),
(459, 'fa', 'fa-sort', NULL),
(460, 'fa', 'fa-sort-alpha-asc', NULL),
(461, 'fa', 'fa-sort-alpha-desc', NULL),
(462, 'fa', 'fa-sort-amount-asc', NULL),
(463, 'fa', 'fa-sort-amount-desc', NULL),
(464, 'fa', 'fa-sort-asc', NULL),
(465, 'fa', 'fa-sort-desc', NULL),
(466, 'fa', 'fa-sort-down(alias)', NULL),
(467, 'fa', 'fa-sort-numeric-asc', NULL),
(468, 'fa', 'fa-sort-numeric-desc', NULL),
(469, 'fa', 'fa-sort-up(alias)', NULL),
(470, 'fa', 'fa-soundcloud', NULL),
(471, 'fa', 'fa-space-shuttle', NULL),
(472, 'fa', 'fa-spinner', NULL),
(473, 'fa', 'fa-spoon', NULL),
(474, 'fa', 'fa-spotify', NULL),
(475, 'fa', 'fa-square', NULL),
(476, 'fa', 'fa-square-o', NULL),
(477, 'fa', 'fa-stack-exchange', NULL),
(478, 'fa', 'fa-stack-overflow', NULL),
(479, 'fa', 'fa-star', NULL),
(480, 'fa', 'fa-star-half', NULL),
(481, 'fa', 'fa-star-half-empty(alias)', NULL),
(482, 'fa', 'fa-star-half-full(alias)', NULL),
(483, 'fa', 'fa-star-half-o', NULL),
(484, 'fa', 'fa-star-o', NULL),
(485, 'fa', 'fa-steam', NULL),
(486, 'fa', 'fa-steam-square', NULL),
(487, 'fa', 'fa-step-backward', NULL),
(488, 'fa', 'fa-step-forward', NULL),
(489, 'fa', 'fa-stethoscope', NULL),
(490, 'fa', 'fa-stop', NULL),
(491, 'fa', 'fa-street-view', NULL),
(492, 'fa', 'fa-strikethrough', NULL),
(493, 'fa', 'fa-stumbleupon', NULL),
(494, 'fa', 'fa-stumbleupon-circle', NULL),
(495, 'fa', 'fa-subscript', NULL),
(496, 'fa', 'fa-subway', NULL),
(497, 'fa', 'fa-suitcase', NULL),
(498, 'fa', 'fa-sun-o', NULL),
(499, 'fa', 'fa-superscript', NULL),
(500, 'fa', 'fa-support(alias)', NULL),
(501, 'fa', 'fa-table', NULL),
(502, 'fa', 'fa-tablet', NULL),
(503, 'fa', 'fa-tachometer', NULL),
(504, 'fa', 'fa-tag', NULL),
(505, 'fa', 'fa-tags', NULL),
(506, 'fa', 'fa-tasks', NULL),
(507, 'fa', 'fa-taxi', NULL),
(508, 'fa', 'fa-tencent-weibo', NULL),
(509, 'fa', 'fa-terminal', NULL),
(510, 'fa', 'fa-text-height', NULL),
(511, 'fa', 'fa-text-width', NULL),
(512, 'fa', 'fa-th', NULL),
(513, 'fa', 'fa-th-large', NULL),
(514, 'fa', 'fa-th-list', NULL),
(515, 'fa', 'fa-thumb-tack', NULL),
(516, 'fa', 'fa-thumbs-down', NULL),
(517, 'fa', 'fa-thumbs-o-down', NULL),
(518, 'fa', 'fa-thumbs-o-up', NULL),
(519, 'fa', 'fa-thumbs-up', NULL),
(520, 'fa', 'fa-ticket', NULL),
(521, 'fa', 'fa-times', NULL),
(522, 'fa', 'fa-times-circle', NULL),
(523, 'fa', 'fa-times-circle-o', NULL),
(524, 'fa', 'fa-tint', NULL),
(525, 'fa', 'fa-toggle-down(alias)', NULL),
(526, 'fa', 'fa-toggle-left(alias)', NULL),
(527, 'fa', 'fa-toggle-off', NULL),
(528, 'fa', 'fa-toggle-on', NULL),
(529, 'fa', 'fa-toggle-right(alias)', NULL),
(530, 'fa', 'fa-toggle-up(alias)', NULL),
(531, 'fa', 'fa-train', NULL),
(532, 'fa', 'fa-transgender', NULL),
(533, 'fa', 'fa-transgender-alt', NULL),
(534, 'fa', 'fa-trash', NULL),
(535, 'fa', 'fa-trash-o', NULL),
(536, 'fa', 'fa-tree', NULL),
(537, 'fa', 'fa-trello', NULL),
(538, 'fa', 'fa-trophy', NULL),
(539, 'fa', 'fa-truck', NULL),
(540, 'fa', 'fa-try', NULL),
(541, 'fa', 'fa-tty', NULL),
(542, 'fa', 'fa-tumblr', NULL),
(543, 'fa', 'fa-tumblr-square', NULL),
(544, 'fa', 'fa-turkish-lira(alias)', NULL),
(545, 'fa', 'fa-twitch', NULL),
(546, 'fa', 'fa-twitter', NULL),
(547, 'fa', 'fa-twitter-square', NULL),
(548, 'fa', 'fa-umbrella', NULL),
(549, 'fa', 'fa-underline', NULL),
(550, 'fa', 'fa-undo', NULL),
(551, 'fa', 'fa-university', NULL),
(552, 'fa', 'fa-unlink(alias)', NULL),
(553, 'fa', 'fa-unlock', NULL),
(554, 'fa', 'fa-unlock-alt', NULL),
(555, 'fa', 'fa-unsorted(alias)', NULL),
(556, 'fa', 'fa-upload', NULL),
(557, 'fa', 'fa-usd', NULL),
(558, 'fa', 'fa-user', NULL),
(559, 'fa', 'fa-user-md', NULL),
(560, 'fa', 'fa-user-plus', NULL),
(561, 'fa', 'fa-user-secret', NULL),
(562, 'fa', 'fa-user-times', NULL),
(563, 'fa', 'fa-users', NULL),
(564, 'fa', 'fa-venus', NULL),
(565, 'fa', 'fa-venus-double', NULL),
(566, 'fa', 'fa-venus-mars', NULL),
(567, 'fa', 'fa-viacoin', NULL),
(568, 'fa', 'fa-video-camera', NULL),
(569, 'fa', 'fa-vimeo-square', NULL),
(570, 'fa', 'fa-vine', NULL),
(571, 'fa', 'fa-vk', NULL),
(572, 'fa', 'fa-volume-down', NULL),
(573, 'fa', 'fa-volume-off', NULL),
(574, 'fa', 'fa-volume-up', NULL),
(575, 'fa', 'fa-warning(alias)', NULL),
(576, 'fa', 'fa-wechat(alias)', NULL),
(577, 'fa', 'fa-weibo', NULL),
(578, 'fa', 'fa-weixin', NULL),
(579, 'fa', 'fa-whatsapp', NULL),
(580, 'fa', 'fa-wheelchair', NULL),
(581, 'fa', 'fa-wifi', NULL),
(582, 'fa', 'fa-windows', NULL),
(583, 'fa', 'fa-won(alias)', NULL),
(584, 'fa', 'fa-wordpress', NULL),
(585, 'fa', 'fa-wrench', NULL),
(586, 'fa', 'fa-xing', NULL),
(587, 'fa', 'fa-xing-square', NULL),
(588, 'fa', 'fa-yahoo', NULL),
(589, 'fa', 'fa-yelp', NULL),
(590, 'fa', 'fa-yen(alias)', NULL),
(591, 'fa', 'fa-youtube', NULL),
(592, 'fa', 'fa-youtube-play', NULL),
(593, 'fa', 'fa-youtube-square', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `lft` int(11) NOT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `label`, `link`, `icon`, `parent`, `permissions`, `lft`, `rgt`, `depth`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Root Menu', '', NULL, NULL, NULL, 1, 8, 0, 1, '2015-10-16 08:30:50', '2018-05-10 05:17:13'),
(3, 'Menu Management', '#', 'fa fa-bars', 1, '[\"menu.add\",\"menu.list\",\"menu.edit\",\"menu.status\",\"menu.delete\"]', 6, 43, 1, 1, '2015-10-16 08:47:17', '2018-05-10 05:17:13'),
(4, 'Add Menu', 'menu/add', '', 3, '[\"menu.add\"]', 39, 40, 2, 1, '2015-10-16 08:48:19', '2018-05-10 05:17:13'),
(5, 'Menu List', 'menu/list', '', 3, '[\"menu.list\",\"menu.edit\",\"menu.status\",\"menu.delete\"]', 41, 42, 2, 1, '2015-10-16 08:48:46', '2018-05-10 05:17:13'),
(6, 'User Management', '#', 'fa fa-users', 1, '[\"writer.add\",\"user.add\",\"user.edit\",\"user.delete\",\"user.list\",\"writer.edit\"]', 7, 25, 1, 1, '2015-10-16 14:16:32', '2018-05-10 05:17:13'),
(7, 'Permissions', '#', '', 6, '[\"permission.add\"]', 1, 10, 2, 1, '2015-10-16 14:17:46', '2018-05-10 05:17:13'),
(10, 'User Roles', '#', '', 6, '[\"user.role.add\"]', 13, 18, 2, 1, '2015-10-16 14:44:21', '2018-05-10 05:17:13'),
(11, 'Add Role', 'user/role/add', '0', 10, '[\"user.add\"]', 14, 15, 3, 1, '2015-10-16 14:45:20', '2018-05-10 05:17:13'),
(12, 'Users', '#', '', 6, '[\"user.add\",\"writer.add\"]', 7, 25, 2, 1, '2015-10-16 14:48:40', '2018-05-10 05:17:13'),
(13, 'Add User', 'user/add', '', 12, '[\"user.add\"]', 20, 21, 3, 1, '2015-10-16 14:49:46', '2018-05-10 05:17:13'),
(14, 'User List', 'user/list', '', 12, '[\"user.edit\",\"user.delete\",\"user.list\"]', 22, 23, 3, 1, '2015-10-16 14:50:48', '2018-05-10 05:17:13'),
(15, 'Permission Groups', 'permission/group', '0', 7, '[\"menu.add\"]', 182, 183, 3, 0, '2015-10-17 10:01:10', '2018-05-10 05:17:13'),
(16, 'Roles List', 'user/role/list', '0', 10, '[\"user.add\"]', 16, 17, 3, 1, '2015-10-17 10:13:52', '2018-05-10 05:17:13'),
(17, 'Add Permission ', 'permission/add', '', 7, '[\"permission.add\"]', 6, 12, 2, 1, '2018-04-24 04:43:47', '2018-05-10 05:17:13'),
(18, 'Permissions List', 'permission/list', '', 7, '[\"menu.add\"]', 8, 7, 3, 1, '2015-10-16 14:43:36', '2018-05-10 05:17:13'),
(19, 'home', '/', 'fa fa-home', 1, '[\"assignment.list\"]', 1, 26, 1, 1, '2018-05-02 10:57:15', '2018-05-10 05:17:13'),
(20, 'New Projects', '/', 'fa fa-square-o', 1, '[\"common.menu\"]', 2, 10, 0, 1, '2018-05-03 12:32:02', '2018-05-10 05:17:13'),
(21, 'Running Projects', '/runingprojects', 'fa fa-refresh', 1, '[\"common.menu\"]', 4, 185, 1, 1, '2018-05-03 12:35:34', '2018-05-10 05:17:13'),
(22, 'Rejected Projects', '/rejectedProjects', 'fa fa-times', 1, '[\"common.menu\"]', 6, 187, 1, 1, '2018-05-03 12:37:00', '2018-05-10 05:17:13'),
(23, 'Completed Projects', '/completeProjects', 'fa fa-check', 1, '[\"common.menu\"]', 6, 189, 1, 1, '2018-05-03 12:38:47', '2018-05-10 05:17:13'),
(24, 'Add Writer', 'user/addwriter', '', 12, '[\"writer.add\"]', 7, 21, 3, 1, '2015-10-16 09:19:46', '2018-05-10 05:17:13'),
(25, 'Writer List', 'user/listWriter', '', 12, '[\"writer.edit\",\"writer.delete\",\"writer.view\"]', 7, 23, 3, 1, '2015-10-16 09:20:48', '2018-05-10 05:17:13'),
(26, 'Assigned Projects', '/assignedProjects', 'fa fa-briefcase', 1, '[\"common.menu\"]', 3, 10, 0, 1, '2018-05-03 07:02:02', '2018-05-10 05:17:13'),
(27, 'Waiting for Complete', '/writercomplete', 'fa fa-clock-o', 1, '[\"common.menu\",\"admin\"]', 5, 10, 1, 1, '2018-05-03 07:02:02', '2018-05-10 05:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2012_12_06_225921_migration_cartalyst_sentry_install_users', 1),
('2012_12_06_225929_migration_cartalyst_sentry_install_groups', 1),
('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot', 1),
('2012_12_06_225988_migration_cartalyst_sentry_install_throttle', 1),
('2015_05_16_172701_create_tables', 1),
('2015_05_16_180134_alter_users_table', 2),
('2015_05_25_211027_create_menu_table', 3),
('2015_05_26_103954_alter_menu_table', 4),
('2015_05_26_114356_alter_menu_table', 5),
('2014_07_02_230147_migration_cartalyst_sentinel', 6);

-- --------------------------------------------------------

--
-- Table structure for table `open`
--

CREATE TABLE `open` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `discription` text NOT NULL,
  `place` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `open`
--

INSERT INTO `open` (`id`, `title`, `discription`, `place`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test open', 'adfdsfsdfdsf<br>', 2, '2016-06-20', '2016-06-18 03:09:55', '2016-06-18 02:21:10', NULL),
(2, 'sdfsdffdgfdgfdg', 'sdfsdfdsfdfgdfgfdg<br>', 3, '2016-07-01', '2016-06-18 04:44:23', '2016-06-18 04:44:23', NULL),
(3, 'sdfsdfsdfdsfsdfds', '<p align=\"left\">Not only will you get to experience the vibrant, exciting environment\n you’ll be studying in, you’ll also be able to chat to lecturers, go on a\n tour of Liverpool and get the inside scoop from some of our current \nstudents about what being a student here is really like.<br></p><br>', 1, '2016-07-21', '2016-06-18 06:20:13', '2016-06-18 03:13:04', NULL),
(4, 'sdfsdfsdfdsfsdfdssfssd', '<p align=\"left\">Not only will you get to experience the vibrant, exciting environment\n you’ll be studying in, you’ll also be able to chat to lecturers, go on a\n tour of Liverpool and get the inside scoop from some of our current \nstudents about what being a student here is really like.<br></p><br>', 1, '2016-07-23', '2016-06-18 06:20:10', '2016-06-18 05:43:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'menu.add', NULL, 1, 1, '2015-07-25 01:30:00', '2015-12-03 09:32:41'),
(3, 'menu.list', NULL, 1, 1, '2015-07-25 01:30:00', '2015-12-02 06:24:54'),
(4, 'menu.edit', NULL, 1, 1, '2015-07-25 01:30:00', '2015-12-02 06:24:57'),
(5, 'menu.status', NULL, 1, 1, '2015-07-25 01:30:00', '2015-12-02 06:25:01'),
(6, 'admin', 'Super Admin Permission', 1, 1, '2015-07-25 01:30:00', '2015-07-25 01:30:00'),
(7, 'index', 'Home Page Permission', 1, 1, '2015-07-25 01:30:00', '2015-12-02 06:25:03'),
(8, 'menu.delete', NULL, 1, 1, '2015-09-06 16:00:06', '2015-09-06 16:00:09'),
(9, 'user.add', NULL, 1, 1, '2015-10-16 01:30:00', '2015-10-16 01:30:00'),
(10, 'user.edit', NULL, 1, 1, '2015-10-16 01:30:00', '2015-10-16 01:30:00'),
(11, 'user.delete', NULL, 1, 1, '2015-10-16 01:30:00', '2015-10-16 01:30:00'),
(12, 'user.list', NULL, 1, 1, '2015-10-20 01:30:00', '2015-10-20 21:31:57'),
(13, 'user.role.add', NULL, 1, 1, '2015-10-22 01:30:00', '2015-10-22 01:30:00'),
(14, 'user.role.edit', NULL, 1, 1, '2015-10-22 01:30:00', '2015-10-22 01:30:00'),
(15, 'user.role.list', NULL, 1, 1, '2015-10-22 01:30:00', '2015-10-22 01:30:00'),
(16, 'user.role.delete', NULL, 1, 1, '2015-10-22 01:30:00', '2015-10-22 01:30:00'),
(17, 'permission.add', NULL, 1, 1, '2015-10-22 01:30:00', '2015-10-22 01:30:00'),
(18, 'permission.edit', NULL, 1, 1, '2015-10-22 01:30:00', '2015-10-22 01:30:00'),
(19, 'permission.delete', NULL, 1, 1, '2015-10-22 01:30:00', '2015-10-22 01:30:00'),
(20, 'permission.list', NULL, 1, 1, '2015-10-22 01:30:00', '2015-10-22 01:30:00'),
(21, 'permission.group.add', NULL, 1, 1, '2015-10-22 01:30:00', '2015-10-22 01:30:00'),
(22, 'permission.group.edit', NULL, 1, 1, '2015-10-22 01:30:00', '2015-10-22 01:30:00'),
(23, 'permission.group.list', NULL, 1, 1, '2015-10-22 01:30:00', '2015-10-22 01:30:00'),
(24, 'permission.group.delete', NULL, 1, 1, '2015-10-22 01:30:00', '2015-10-22 01:30:00'),
(46, 'menu.delete', NULL, 1, 1, '2015-12-03 09:00:30', '2015-12-03 09:00:30'),
(50, 'writer.allocate', 'writer allocate', 1, 0, '2018-05-02 03:34:18', '2018-05-02 03:34:18'),
(51, 'assignment.description', 'Assignment description Add', 1, 0, '2018-05-02 03:35:09', '2018-05-02 03:35:09'),
(52, 'assignment.admin.attachment', 'Admin attachment add', 1, 0, '2018-05-02 03:42:31', '2018-05-02 03:42:31'),
(53, 'writer.attachment', 'writer attachment add', 1, 0, '2018-05-02 03:43:41', '2018-05-02 05:15:03'),
(82, 'assignment.list', 'Assignment list', 1, 0, '2018-05-02 10:16:33', '2018-05-02 10:16:33'),
(83, 'all.assignment.access', 'All assignment access ', 1, NULL, '2018-05-08 18:30:00', NULL),
(84, 'add.complete', NULL, 1, NULL, '2018-05-08 18:30:00', NULL),
(85, 'common.menu', NULL, 1, NULL, '2018-05-15 18:30:00', NULL),
(86, 'price.add', 'price add', 1, NULL, '2018-05-08 18:30:00', NULL),
(87, 'advance.add', 'advance add', 1, NULL, '2018-05-09 18:30:00', NULL),
(88, 'writer.add', 'writer.add', 1, NULL, NULL, NULL),
(89, 'writer.view', 'writer.view', 1, NULL, NULL, NULL),
(90, 'writer.edit', 'writer.edit', 1, NULL, NULL, NULL),
(91, 'writer.delete', 'writer.delete', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `persistences`
--

CREATE TABLE `persistences` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `persistences`
--

INSERT INTO `persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(1, 1, '0q0ygX6vhRbhWLfDVMQjCpuVVi4Uv21m', '2015-07-11 06:09:55', '2015-07-11 06:09:55'),
(2, 1, 'efBjwoN42yjE5Pbbbn3NOvAQMh6Hc47p', '2015-07-13 04:42:45', '2015-07-13 04:42:45'),
(4, 1, 'dkYUwD816i7YeZLaLmENn7b7qXyRV6jE', '2015-07-13 09:43:07', '2015-07-13 09:43:07'),
(5, 1, 'fsVkzYpy5e5SIno5317Viix318Ipevum', '2015-07-14 09:12:12', '2015-07-14 09:12:12'),
(7, 1, 'BYdFxgUBhE9H2BqP6PEg5tQXjQvapGkk', '2015-07-14 13:23:52', '2015-07-14 13:23:52'),
(8, 1, 'UuheCz7Zmb1WM2zsJVnJv3yMtHrCZXZP', '2015-07-18 14:05:42', '2015-07-18 14:05:42'),
(9, 1, 'ugwMinnLII8pAvdX48uibN4tCfFncKxL', '2015-07-25 07:14:39', '2015-07-25 07:14:39'),
(10, 1, '6sv5Vmes7x5zzF5kp9BIiF0e3J7uatEA', '2015-07-25 16:02:42', '2015-07-25 16:02:42'),
(12, 1, 'AAPH0gv7ueGmg1GHT3CDDb8CuqliETTr', '2015-07-27 03:30:05', '2015-07-27 03:30:05'),
(17, 1, 'EvOMH9hGBkW3nS9TJjtnZOajBh8b2nH8', '2015-08-13 15:29:00', '2015-08-13 15:29:00'),
(18, 1, 'sgY1xcvVRC3q8s2Qe5IgY6k4NVdw8Bw2', '2015-08-13 15:30:50', '2015-08-13 15:30:50'),
(19, 1, 'smRBCmpzbBL4RTXJZcaAW5Wr4quWzvnA', '2015-08-14 04:38:36', '2015-08-14 04:38:36'),
(20, 1, 'C1xwzvvNREHhtx6JqQEZSTEPMbzY7J6F', '2015-08-14 04:43:16', '2015-08-14 04:43:16'),
(23, 1, '0XUcBHFDSxUgWDZsdPt9Oigx5cIfQ5KR', '2015-08-14 10:19:04', '2015-08-14 10:19:04'),
(24, 1, 'LeqsntX9HwB19oOzfqFICR3TB2xHZt5c', '2015-08-14 15:46:49', '2015-08-14 15:46:49'),
(25, 1, 'ZRilkZu1axOqoPqkAbNzA4ZPQccDHLEf', '2015-08-15 08:49:49', '2015-08-15 08:49:49'),
(26, 1, 'fHHSkcipQkFfpeTYIcxmFqKS2IKL0ozJ', '2015-08-17 04:11:53', '2015-08-17 04:11:53'),
(27, 1, 'Gev3KH0ERZX7UFA6QASlHd4wW9Tm47cz', '2015-08-17 07:52:08', '2015-08-17 07:52:08'),
(28, 1, 'Pu0bSNJwO7XEhfmr8Ubg28c5HWp2BCfN', '2015-08-18 03:31:21', '2015-08-18 03:31:21'),
(29, 1, 'FkavnjEGjcidC4hGsJwf5JepGpglq09u', '2015-08-18 05:33:49', '2015-08-18 05:33:49'),
(30, 1, 'GfVyVFbRB7yBaekFtBu3l16pB95iDYyv', '2015-08-18 12:41:28', '2015-08-18 12:41:28'),
(32, 1, '7Qa9ckHVYsRkTgnZNSQ9szqJ7ORRwqqP', '2015-08-19 14:13:25', '2015-08-19 14:13:25'),
(34, 1, '7gzkQXDRziKCU3V6YN3os6oty3ZYmm3V', '2015-08-20 05:10:32', '2015-08-20 05:10:32'),
(35, 1, 'PPni5OZ4t4Ukf7GqJhJTowQUbG1BKTCO', '2015-08-24 11:32:19', '2015-08-24 11:32:19'),
(39, 1, '1Vq5gtTDFk3uhKn9AHMOnWwQxiNq8eNm', '2015-08-24 15:02:07', '2015-08-24 15:02:07'),
(40, 1, '9tal1AP1HQ4usfTnI3Q0kXSrPzScKtnz', '2015-08-25 07:26:55', '2015-08-25 07:26:55'),
(41, 1, 'FDkLOdsEvF0HzB1XvBQ8GKAQZ9oq80xS', '2015-08-25 13:20:00', '2015-08-25 13:20:00'),
(42, 1, 'LW0maecSnWGHR1uvR1ev67CmiePNeYQb', '2015-08-26 03:13:11', '2015-08-26 03:13:11'),
(43, 1, 'c7UCeZhd2AdNOrNIrzFeP8Z2xHSPBOat', '2015-08-26 07:51:39', '2015-08-26 07:51:39'),
(44, 1, 'DmiuJhBD8ndKrxeQzYUgKJ0qdr5VfgEp', '2015-08-26 07:53:05', '2015-08-26 07:53:05'),
(45, 1, 'EvLSeVbZ4LpQHpIwn3ESkPmKiHZYqChR', '2015-08-26 14:13:08', '2015-08-26 14:13:08'),
(46, 1, 'ZaFHszTHVJxdXVHyYyDUiVrjDsVLF2os', '2015-08-27 03:20:53', '2015-08-27 03:20:53'),
(47, 1, 'E26Ajf3IuoSAQBDRGUnJxBXuLWf45qTE', '2015-08-28 05:30:55', '2015-08-28 05:30:55'),
(48, 1, '6gvIBqAaNqIHUC1GXGnvpobgXDqyGFWV', '2015-08-28 08:52:35', '2015-08-28 08:52:35'),
(49, 1, 'C9iOcAwSX8vcFZVUkRrnb7BTEmFfb1lW', '2015-08-28 11:24:30', '2015-08-28 11:24:30'),
(50, 1, 'm8HlkBppqVOmVtvm8WXn1gflqnpxZ7ZX', '2015-08-28 15:43:47', '2015-08-28 15:43:47'),
(51, 1, 'Ga2L52MViQQHOjQmC0B3NIwKoFoeC5LU', '2015-08-29 06:56:46', '2015-08-29 06:56:46'),
(52, 1, 'pEnesSMPpp8XwoXBGc0AQIxG8a0NlJL7', '2015-08-29 10:11:51', '2015-08-29 10:11:51'),
(53, 1, 'DOyCW9LubRxZlUZI1VM9VWmwEHFqEtuy', '2015-08-30 08:15:08', '2015-08-30 08:15:08'),
(54, 1, 'hQnXdF66aT6GWv1bjMfdQlrFzXCKzPaD', '2015-09-01 12:43:49', '2015-09-01 12:43:49'),
(55, 1, 'SofbScd28GADuBXJkBe02t4wNesj1pyc', '2015-09-02 03:46:21', '2015-09-02 03:46:21'),
(58, 1, 'S9zBLvLOtfn86jn2YZ7o4cDDIXir5odO', '2015-09-06 11:03:49', '2015-09-06 11:03:49'),
(59, 1, 'jhnFLwdIIq3akmuFjwNT5hXRbskFN8Cv', '2015-09-07 03:30:41', '2015-09-07 03:30:41'),
(65, 1, 'Yzp3Ic2rJbT21gHfSHQAyNH9sySMzNx8', '2015-09-17 07:08:02', '2015-09-17 07:08:02'),
(66, 1, 'FPxtt7aeMIpDuoEEIrFeXfS289y6YyrI', '2015-09-17 07:10:28', '2015-09-17 07:10:28'),
(67, 1, 'DE0xeUB6zv2l9VC7hlbHeVKZdNVgba2k', '2015-09-17 07:12:20', '2015-09-17 07:12:20'),
(68, 1, 'VSigkljclaPzU2jbUTnEPb7uAqbq7OO4', '2015-09-17 07:16:25', '2015-09-17 07:16:25'),
(69, 1, 'u1u64fxr5E8cVetPE2xfwXXlZg8ETdMt', '2015-09-17 07:18:29', '2015-09-17 07:18:29'),
(70, 1, 'IsPKSyDwN4yyBDpHDCQTFIA9cb9tDvho', '2015-09-17 07:20:56', '2015-09-17 07:20:56'),
(71, 1, 'Mqwwg7Ji564GosYUs8ew6p56lVqTNggm', '2015-09-17 07:21:06', '2015-09-17 07:21:06'),
(72, 1, 'ReDZfYlXcI3vckn50feKIYFukwEIaJxW', '2015-09-17 07:25:47', '2015-09-17 07:25:47'),
(73, 1, '1zPiFaCd2KentN0BEVayuoIqOfxi3lMS', '2015-09-17 07:26:15', '2015-09-17 07:26:15'),
(75, 1, 'FiS9P7LCFRk2i3wnNHZJqODlZaBMPBsH', '2015-09-17 07:27:16', '2015-09-17 07:27:16'),
(77, 1, 'w6afABnpTAwYkETiZ1LpLEG31RUMR9J9', '2015-09-17 07:44:14', '2015-09-17 07:44:14'),
(80, 1, 'zEQJ08oNoKnzyenYvSBPlGNkYrQRb9iU', '2015-09-17 09:38:48', '2015-09-17 09:38:48'),
(81, 1, 'ngBYUNkxL2QkLY5Lj7EHCsAY8VRUPIss', '2015-09-17 10:37:24', '2015-09-17 10:37:24'),
(82, 1, 'qPnddeucFgMvXEyCDsm99LGWgtiKQJI0', '2015-09-17 11:07:58', '2015-09-17 11:07:58'),
(83, 1, 'y8KppplOMITXfiYtuU10r96MmBw2fn4Z', '2015-09-17 11:24:17', '2015-09-17 11:24:17'),
(87, 1, '1O0lJH2OdlZ5JYPb7OzU95hN9DD9D08f', '2015-09-18 05:47:44', '2015-09-18 05:47:44'),
(91, 1, 'F2EASmRV02xRfOorilcer2HPJR0ff10w', '2015-09-21 03:23:43', '2015-09-21 03:23:43'),
(93, 1, 'XtZHW8aWJtnVDHLcFpJjfzuFQCI4BarH', '2015-09-21 03:31:03', '2015-09-21 03:31:03'),
(94, 1, '4MvhjQuFQMa3d3kTpaMJIhrHIqrpd0Ud', '2015-09-21 03:34:16', '2015-09-21 03:34:16'),
(95, 1, 'wIeSvojnWxVdqc8Ko2g4wSlgadyT46HX', '2015-09-21 13:16:41', '2015-09-21 13:16:41'),
(96, 1, 'IfNOgaDeoIHRgr1wMMQvzGO2zyedyHzQ', '2015-10-16 04:25:25', '2015-10-16 04:25:25'),
(97, 1, 'xb49Au965edKpfxust8QyV2A1ZtN1Jir', '2015-10-16 07:59:38', '2015-10-16 07:59:38'),
(98, 1, '8KKqFXos72faML2g6w1gZK8GecSR2A7B', '2015-10-16 08:25:28', '2015-10-16 08:25:28'),
(99, 1, 'IrxeYFpjWjhZdazrZz7tp253etqZlkuh', '2015-10-16 10:39:25', '2015-10-16 10:39:25'),
(100, 1, 'iuuX2Q6nvfyKfiNLDjOHJ0Jnmd3ZHLEM', '2015-10-17 06:28:06', '2015-10-17 06:28:06'),
(102, 1, 'vQW13aw7kJoovALydds8W9175IqZq7sh', '2015-10-20 08:45:41', '2015-10-20 08:45:41'),
(103, 1, 'kznRgyUivNAxj1LolOUloaV52kxc1TOg', '2015-10-20 14:19:12', '2015-10-20 14:19:12'),
(104, 1, 'UMqlxsaazj72vwRmCVfv5qB5oujn5eO1', '2015-10-20 14:20:38', '2015-10-20 14:20:38'),
(105, 1, 'xpjJT8wJEAA4xe0WNP9UbGPlEbwgZi7L', '2015-10-21 03:28:35', '2015-10-21 03:28:35'),
(106, 1, 'PMf4A3yNtiDOJzYEA2Pi58STBrJpYzi9', '2015-10-21 03:36:54', '2015-10-21 03:36:54'),
(107, 1, 'ix4iaApoo9ohGbwkBNcYyHv3nSkYMuOJ', '2015-10-21 14:51:23', '2015-10-21 14:51:23'),
(108, 1, 'klm8QxxO7mIG6Ljj5liFWR1qikUv3y1H', '2015-10-22 02:47:41', '2015-10-22 02:47:41'),
(109, 1, 'TMTs9AXiVGg3Dn8AmaXt5EZS4Z4WeVgp', '2015-10-26 03:48:24', '2015-10-26 03:48:24'),
(110, 1, 'gihggqvhu0ngRD3ZMkeBhMLMNW6uKXHJ', '2015-10-28 04:39:40', '2015-10-28 04:39:40'),
(111, 1, 'KDNzGA42AWdXV63AG90IhJF6Q36pmtpE', '2015-10-28 13:38:36', '2015-10-28 13:38:36'),
(112, 1, '35yTDDYO1IYhs9ujWXGWfAS9cxXIs4Hj', '2015-11-04 03:13:06', '2015-11-04 03:13:06'),
(113, 1, 'FE2s4HBsv9RoBO7oUsUT7KxFTaXqdpUs', '2015-11-06 09:06:44', '2015-11-06 09:06:44'),
(115, 1, 'a35iqeHc7BvGEbgIx9t357tFXklT9bqO', '2015-11-06 10:38:06', '2015-11-06 10:38:06'),
(116, 1, 'eE6SkzCzg1FtCi2E24UNmFm7OBVLWORs', '2015-11-07 11:02:42', '2015-11-07 11:02:42'),
(117, 1, 't71JCTd8yKBblCePz7bWznuSpkU2XqDv', '2015-11-07 11:27:44', '2015-11-07 11:27:44'),
(119, 1, 'ECMvGKmUgYm2qtMN0OMrPqpaDn5jx08d', '2015-11-18 17:33:17', '2015-11-18 17:33:17'),
(120, 1, 'PtyWimBS6rsnKlRxj96BDq9L7SDKG2rk', '2015-11-18 18:13:11', '2015-11-18 18:13:11'),
(121, 1, 'l9FIuW4AIkJij7BhzeiSEfzU4VyTWHMv', '2015-11-18 18:56:41', '2015-11-18 18:56:41'),
(122, 1, 'bFb85D3SNEMRAoWExKagngxrR9mpWG9a', '2015-11-18 21:26:32', '2015-11-18 21:26:32'),
(123, 1, 'SXL5MRTMSjhUxM2hHtJlZTUCbqgFF5dp', '2015-11-18 21:36:15', '2015-11-18 21:36:15'),
(124, 1, 'xe3efdBNBGu5Ftyzf6SBg1IpUjzMiODv', '2015-11-18 23:47:47', '2015-11-18 23:47:47'),
(125, 1, 'H0KI9TFvutyqksX9WFdo7ltXlIdi6LBO', '2015-11-19 06:31:04', '2015-11-19 06:31:04'),
(126, 1, 'b5U0MlNhXnSybtPBfB6OOmx2UD0jp3rK', '2015-11-19 17:26:33', '2015-11-19 17:26:33'),
(127, 1, 'aY5cfsCbK3SIOhyIfqn5swgMpi7DdOaH', '2015-11-19 18:18:16', '2015-11-19 18:18:16'),
(128, 1, 'LFMf9yFQYkV1iEc4MPSmy2cPyAlIBI7e', '2015-11-20 01:26:45', '2015-11-20 01:26:45'),
(129, 1, 'RzLW8COzh7iRkoCA0sY3VAejSmQbAFGS', '2015-11-20 17:13:07', '2015-11-20 17:13:07'),
(130, 1, 'QyjXCs2H1KLaiSveWaBenK05uG6Z0S8D', '2015-11-20 21:58:30', '2015-11-20 21:58:30'),
(131, 1, '9wrIGqqTTScbdXWxrxsu4mPGI30xTTJn', '2015-11-20 23:52:41', '2015-11-20 23:52:41'),
(132, 1, 'bBc9L5jexsFXL5iGZV8sIlgiyiEpvCo1', '2015-11-23 17:24:24', '2015-11-23 17:24:24'),
(134, 1, 'MVm2uIPKGoClnBOtPnZLeMne0cxqm79A', '2015-11-23 19:06:16', '2015-11-23 19:06:16'),
(135, 1, 'UdEhb1HUGGFeNUAHSzSEAd28LBtML6ti', '2015-11-24 00:54:58', '2015-11-24 00:54:58'),
(136, 1, 'CZGAahPMZICfT9C2pz8DKf3N9XLZpzwT', '2015-11-24 01:14:32', '2015-11-24 01:14:32'),
(138, 1, 'ZS8C30f5fheTscPSyKKcwnHFzwJi5YUg', '2015-11-24 16:47:44', '2015-11-24 16:47:44'),
(139, 1, 'hviLwIVE77jiFjpRBx6DmB29nDCTiEoa', '2015-11-24 17:51:06', '2015-11-24 17:51:06'),
(140, 1, 'k4YjDklmjCK3XOheyFj5tZRgkgQLcvPZ', '2015-11-24 18:44:04', '2015-11-24 18:44:04'),
(141, 1, 'Q0pgzUMaw1jbbjbJ76ZEoiPNHbvEaGhb', '2015-11-24 20:39:15', '2015-11-24 20:39:15'),
(142, 1, 'j1Ll3vyCfxk8WYrfGRWbLcFlmmB5gvuf', '2015-11-25 01:27:11', '2015-11-25 01:27:11'),
(143, 1, '36OdiItmKntFhhusCsOxRDRUmRLi3aIk', '2015-11-26 16:40:45', '2015-11-26 16:40:45'),
(144, 1, 'EY00OQByVxbkksjXJeB779sTw0PVBwQo', '2015-11-26 17:01:33', '2015-11-26 17:01:33'),
(145, 1, 'wFYXrcHs2VT8JxpVeu2nkYpEDIiyveCi', '2015-11-26 22:06:39', '2015-11-26 22:06:39'),
(146, 1, 'fnPGwFNPFaup09Pi8h3HRZkW7g2o89UB', '2015-11-26 22:40:49', '2015-11-26 22:40:49'),
(147, 1, 'EoByZX0seoP71TO3mh5YkAiMw41dQjfI', '2015-11-27 16:56:43', '2015-11-27 16:56:43'),
(148, 1, 'N4O3wiGd7DlOZPPsiXQnU3GaIUDVs0pk', '2015-11-27 17:05:49', '2015-11-27 17:05:49'),
(149, 1, 'wvrtqymHww86JtFR4ySTB7PRMVe6CYyZ', '2015-11-30 18:59:39', '2015-11-30 18:59:39'),
(150, 1, '0c1cjjzAmVVAFRwhzEBmL2fBR2a0cZ47', '2015-11-30 19:04:17', '2015-11-30 19:04:17'),
(151, 1, 'wXdvBHnlVA6VxrKWojj4MPaQ15WIDALo', '2015-11-30 20:14:11', '2015-11-30 20:14:11'),
(152, 1, '6KgSa5WB6Fcd1RhTQe4bpnc3NLRc4jKs', '2015-12-01 04:01:40', '2015-12-01 04:01:40'),
(153, 1, 'b9DvbCSyCVGeHps05XTN3kDLjG9i6UID', '2015-12-01 16:50:21', '2015-12-01 16:50:21'),
(154, 1, 'V1ebekY9wLdVXEXYaDXiDKizKIwV2YoZ', '2015-12-01 19:05:33', '2015-12-01 19:05:33'),
(155, 1, 'U1TDvsp3l7S50HKZJilwD8kolj3oKMZY', '2015-12-01 20:14:31', '2015-12-01 20:14:31'),
(156, 1, 'tWGlxczBI5ISqJsyb8i4t1GAGLVmCxdg', '2015-12-02 17:57:48', '2015-12-02 17:57:48'),
(157, 1, 'sX9s0vE8zk12ZJkKZOj53is0FOSzm3h5', '2015-12-02 18:36:14', '2015-12-02 18:36:14'),
(158, 1, 'YZ1T4vrGkxVOS91okt3lSiz7OFyibEWY', '2015-12-02 18:45:44', '2015-12-02 18:45:44'),
(160, 1, '0asRo8XZo9ictz6mNc941GyW81j7mqnY', '2015-12-03 01:12:18', '2015-12-03 01:12:18'),
(161, 1, 'FVal7sFDex7QqJibHPmQ3BqJOjMxY4zG', '2015-12-03 01:57:27', '2015-12-03 01:57:27'),
(162, 1, 'R82HDrmisEFi9HDBpF4Cb6Ffg8r9o3RI', '2015-12-03 02:32:32', '2015-12-03 02:32:32'),
(163, 1, 'bYRhi5W5Z5sShoOXorpyq9PTzruV4ISR', '2015-12-03 17:43:08', '2015-12-03 17:43:08'),
(164, 1, '6wFdYiPTSZW4ldZn62NgTYaTQrAyMRFW', '2015-12-03 19:40:42', '2015-12-03 19:40:42'),
(165, 1, '7Zpc8lp11v5CtWyMWGlonBNEHCsQCWhi', '2015-12-07 17:34:48', '2015-12-07 17:34:48'),
(166, 1, '9vbkG1yJuNrxJbPccH6inExHABpHtQMU', '2015-12-07 18:56:07', '2015-12-07 18:56:07'),
(167, 1, 'O61lttpy7l77lwEm2vQBpYftms5BbuWz', '2015-12-07 18:57:47', '2015-12-07 18:57:47'),
(168, 1, 'z1BKohUNT9iUIx0QDiNHknohKyQLxgwR', '2015-12-07 21:21:57', '2015-12-07 21:21:57'),
(169, 1, 'mgVr1Yf3SmYFFQXcfSOiiMUrEOXYtyIE', '2015-12-09 08:46:01', '2015-12-09 08:46:01'),
(170, 1, 'wXfKhftDNmcd1lzcpHbdVAupEwg6iPB1', '2015-12-10 02:48:39', '2015-12-10 02:48:39'),
(171, 1, 'M9nOfyMiWOS6MPeHAEPLQHu3O6eguDfM', '2015-12-10 03:54:35', '2015-12-10 03:54:35'),
(172, 1, '6QcNXZKplIK2jyczEiemKi9vMNGNpJPa', '2015-12-10 04:18:30', '2015-12-10 04:18:30'),
(173, 1, 'PHVC2vv8srnBVTgUAmazGtlEnNFH9lDX', '2015-12-11 03:35:47', '2015-12-11 03:35:47'),
(174, 1, 'aLp2cFvLETFgzkfvua809J6yQUckdN7e', '2015-12-11 05:12:47', '2015-12-11 05:12:47'),
(175, 1, '5oFbIXEcnkel8NA4C5R7lIDMH3HwQHnt', '2015-12-11 09:03:38', '2015-12-11 09:03:38'),
(176, 1, 'fk2KAeFqE2GQszTHBqPr4S64ryqZqgzg', '2015-12-13 13:54:51', '2015-12-13 13:54:51'),
(177, 1, 'mbfY5qVCITuKC4WQkdjniuI92hOHAV8Z', '2015-12-14 03:44:54', '2015-12-14 03:44:54'),
(178, 1, 'vfNyRsl8cIkSa7fZlab46JHuU39hlm5p', '2015-12-14 05:00:11', '2015-12-14 05:00:11'),
(179, 1, 'FJrEUlzhmsra1XOAhBH9L2Yveu7CTDrO', '2015-12-14 06:49:46', '2015-12-14 06:49:46'),
(180, 1, 'dR0lcMYVGQ5NavQ7yjj1ZttyqczZFBDP', '2015-12-15 03:59:54', '2015-12-15 03:59:54'),
(181, 1, 'WvCBF4ChPmoYCjsXkmqQabpjNs3P4Roj', '2015-12-15 06:33:40', '2015-12-15 06:33:40'),
(182, 1, 'cXLo2Sz4ZcHz31xinnouNEz8agXbjyNl', '2015-12-15 07:53:56', '2015-12-15 07:53:56'),
(183, 1, 'SGFAwgxhjPTZUhotuj6ZqiksCJfXWbGW', '2015-12-30 11:36:26', '2015-12-30 11:36:26'),
(193, 1, 'Xi8juR5OnearI5j8Whv3lHSfmOVeNy1u', '2016-01-04 18:59:38', '2016-01-04 18:59:38'),
(194, 1, 'm0NAfjq8jV4iQ2w9CmeABpbT15USJ5Lv', '2016-01-04 19:06:07', '2016-01-04 19:06:07'),
(195, 1, 'cDxATu2kaeGbJngKJVf3cq2BQBL8vyrP', '2016-01-04 20:12:19', '2016-01-04 20:12:19'),
(196, 1, 'Mitbr4TRSkeZKxA52930PEfuXvCUzSHd', '2016-01-04 20:42:26', '2016-01-04 20:42:26'),
(197, 1, 'f3Qm582Nvxdyvqwge6SwW989o0dUqOMk', '2016-01-04 21:11:54', '2016-01-04 21:11:54'),
(198, 1, '3HiRq9fTEHCbBfjHd9nMWZ3cMDDQ8gnF', '2016-01-04 21:58:02', '2016-01-04 21:58:02'),
(199, 1, 'wCjyPtk90aAqqc701xXWJ6Ma4TrXhfcd', '2016-01-04 22:00:06', '2016-01-04 22:00:06'),
(200, 1, 'yV2G0q3iQdrgVhcmczPGx1xxqALxxR8q', '2016-01-04 22:09:56', '2016-01-04 22:09:56'),
(201, 1, 'M8VI2wJ8UjAhkgnFb64qWzjlWpgJ5J6g', '2016-01-05 16:55:17', '2016-01-05 16:55:17'),
(202, 1, '8N5V1UScnEVwJFM097DzNc82FGpRk4VO', '2016-01-05 16:59:51', '2016-01-05 16:59:51'),
(203, 1, 'zcqaGWaZbSc3KrcyJiZEtEvLkDh4v6w8', '2016-01-05 17:55:29', '2016-01-05 17:55:29'),
(204, 1, 'YJ1PWXqkBA79XDFAtBiPkK5dLnuzUFFB', '2016-01-05 19:46:08', '2016-01-05 19:46:08'),
(205, 1, 'zvSrKkwNqrs2kO4kHpJQVLcBFiZVrV9i', '2016-01-05 23:05:29', '2016-01-05 23:05:29'),
(206, 1, 'PYBcBPTpt3odA2LLDisodYemWNIZwFhy', '2016-01-05 23:19:43', '2016-01-05 23:19:43'),
(207, 1, 'aHbUrAKoTsDG2NFSDDjUbuFY9lAxCoUb', '2016-01-06 16:53:20', '2016-01-06 16:53:20'),
(208, 1, 'PeQMLl9BLEoOYoj6o3eq5p63gqJl0JYN', '2016-01-06 19:16:58', '2016-01-06 19:16:58'),
(209, 1, 'SSwIK6a1GFojIzXT16XEbguILUoNZC9t', '2016-01-06 20:11:57', '2016-01-06 20:11:57'),
(210, 1, 'dQEFaqn6lU6XRE7Q6ck6jThkHkeZtfKp', '2016-01-06 20:14:43', '2016-01-06 20:14:43'),
(211, 1, 'NbGLx0Df1cZbjR10tSx9waemGE6kWCPW', '2016-01-06 21:55:41', '2016-01-06 21:55:41'),
(212, 1, 'u4lutAY5ubGz8fY2LR3j3UpqbeReOxQ3', '2016-01-06 22:10:13', '2016-01-06 22:10:13'),
(213, 1, 'YYfOawHDAYJm95DvBOYgIb4mpM5kK6Mq', '2016-01-06 23:18:36', '2016-01-06 23:18:36'),
(214, 1, 'F0qT9xIhjtk9w0pfxKwBN572ZiwJemsw', '2016-01-07 15:49:08', '2016-01-07 15:49:08'),
(218, 1, 'IvzWvhfdKSFVP8obZBs7xPC7Z00ghe7S', '2016-04-06 03:15:31', '2016-04-06 03:15:31'),
(219, 1, 'g3Ycuxf90fT5REB9rYRxzwWw5wcsAZsJ', '2016-04-06 05:17:42', '2016-04-06 05:17:42'),
(225, 1, 'XpHM3aa7XSDA8pfBZmZjdhfbbc0Q0Zl3', '2016-04-09 03:45:38', '2016-04-09 03:45:38'),
(229, 1, 'XYaumMorcCtI8tHNKaHbgtKWKibU9VzO', '2016-04-11 04:23:43', '2016-04-11 04:23:43'),
(230, 1, 'F6qPFU2DZ0Mog4LdWcawGyvMNgR3hAva', '2016-04-11 08:35:09', '2016-04-11 08:35:09'),
(232, 1, 'bFGPaZ7fjzYsftQZOMS17Fk2aSIfAGtO', '2016-04-20 04:28:09', '2016-04-20 04:28:09'),
(233, 1, 'PCU5XNBAUrMrURkb2nsmqjVfNQZb5Jw6', '2016-04-21 10:16:39', '2016-04-21 10:16:39'),
(234, 1, 'CP7BQfBbEYRPaeWeS7TkHb2x3gX9LLfl', '2016-04-23 03:11:38', '2016-04-23 03:11:38'),
(236, 1, 'LCb7S2tRdlg2KUEW5WGlahbpAA0qlwAB', '2016-04-23 11:08:20', '2016-04-23 11:08:20'),
(281, 1, 'GcyheyWdCO1jvYM4XesG9bUKuL81YtHi', '2016-04-27 08:10:05', '2016-04-27 08:10:05'),
(282, 1, '90g3CyJEAv4WnyfqYErwXzvokER8oht1', '2016-04-28 06:38:37', '2016-04-28 06:38:37'),
(283, 1, '59T16b6HKRjf5ojQj39INfvFU3gjYCSr', '2016-04-28 08:58:51', '2016-04-28 08:58:51'),
(284, 1, 'cyoLX5rpWCjeEh6BcQwtm66ouDcpNpJ9', '2016-05-03 08:13:10', '2016-05-03 08:13:10'),
(285, 1, 'nZYySGysHGCuVOCHTof4J5IPdyhicCff', '2016-05-04 03:46:48', '2016-05-04 03:46:48'),
(286, 1, '9hPRPHccm2nbHy8kQmyo6bQKQpb4Y0Vd', '2016-05-16 11:56:37', '2016-05-16 11:56:37'),
(287, 1, 'pMT5OvSEGlYUsSwtlTGa2OFyfKayjdv7', '2016-05-24 10:09:32', '2016-05-24 10:09:32'),
(288, 1, '43PRSi3SlMNeoGH3nhzqdpjEZcntqxwA', '2016-05-26 03:29:17', '2016-05-26 03:29:17'),
(289, 1, '4p5YtCt9GmuSmTZlcoki5g5G8NCmLsig', '2016-05-27 03:03:01', '2016-05-27 03:03:01'),
(290, 1, 'v6WW2KCT4I40nbEbvzblxUnTiyY7bE5O', '2016-05-27 04:59:56', '2016-05-27 04:59:56'),
(291, 1, '8MnSUOKICh0y9jStwjJ7zwJk60WplbSW', '2016-06-01 21:26:56', '2016-06-01 21:26:56'),
(292, 1, 'LQtgDrnwPA3X6MC0CXAWEL8DZZtGjcgR', '2016-06-02 16:02:01', '2016-06-02 16:02:01'),
(293, 1, 'qM5xUgBIlNiordo3kYCuU8YMUVDEkoGN', '2016-06-02 23:45:14', '2016-06-02 23:45:14'),
(294, 1, 'cOWjPDWsBnQItcvtnYpZN7jaRYCVSOD9', '2016-06-04 15:27:31', '2016-06-04 15:27:31'),
(295, 1, 'LHG1LBNr1zWTqIvRGvkQr8iNP6ip3f9i', '2016-06-06 21:59:59', '2016-06-06 21:59:59'),
(296, 1, 'Ft2srLvEW3F1uJbTqhixGlZAA59oIyGW', '2016-06-08 04:32:31', '2016-06-08 04:32:31'),
(297, 1, 'DpSFWxahYmRr4gQVnezOySB0ec7rVe9d', '2016-06-14 03:12:18', '2016-06-14 03:12:18'),
(298, 1, 'bct6B1mryKFcF4ci4exfPfThrJGUFZad', '2016-06-15 11:19:39', '2016-06-15 11:19:39'),
(299, 1, 'i5351m316q2iMddJ4TMZV6vR8cFNpaKv', '2016-06-16 04:41:48', '2016-06-16 04:41:48'),
(300, 1, 'oCe0pHNKxARF9NWOaaBLsTuVNcT28liO', '2016-06-16 10:12:04', '2016-06-16 10:12:04'),
(301, 1, 'DyfRXjSzBlBGAsxQ7JsK6rbaNehQ93hL', '2016-06-17 03:36:33', '2016-06-17 03:36:33'),
(302, 1, 'uZSmDqSkJz7g2CKFmZUQya8AhQXqyjDl', '2016-06-18 04:25:22', '2016-06-18 04:25:22'),
(303, 1, 'jOOh6S4Shf66kbuOoTIL8ySrryMHJJR3', '2016-06-20 04:56:51', '2016-06-20 04:56:51'),
(304, 1, 'sxjAxhEpCraJV2eTEFpZOJCEOCpN1Y1T', '2016-06-20 05:02:41', '2016-06-20 05:02:41'),
(305, 1, '3NHElvDZNvs8Ec0iY6LtuCT5qufuencs', '2016-06-21 19:43:59', '2016-06-21 19:43:59'),
(306, 1, 'Wrgu0NCUfqy7WkUABV3hP3kcOCn4zxjY', '2016-06-28 00:54:29', '2016-06-28 00:54:29'),
(307, 1, 'aMJ3Pnk7mxZIGm51KK4fMwDUeFcFDxoa', '2016-06-28 15:43:52', '2016-06-28 15:43:52'),
(308, 1, 'LkYqqKpr3Nu30Xu89zpEJHKQqEqkLWKq', '2016-06-28 18:36:02', '2016-06-28 18:36:02'),
(309, 1, 'PwhqQS2qX2Md7mm9vu3Fa6DGuJGxqAzq', '2016-06-29 19:34:43', '2016-06-29 19:34:43'),
(311, 1, 'plMaiXLojMRfxdQwrEvP1pDInVhbE64a', '2016-07-01 22:28:12', '2016-07-01 22:28:12'),
(312, 1, 'Y8pQEa3Fb3bvosszqiwXgXbDnsc1lgC9', '2016-07-02 18:39:30', '2016-07-02 18:39:30'),
(314, 1, 'GyiBUHOY0o5hErP4QsNH0iHW7KySzUGY', '2016-07-06 01:16:32', '2016-07-06 01:16:32'),
(315, 1, 'aVbCnIFBn5atFdplWNl4rVHFGCg6gvMZ', '2016-07-06 01:18:26', '2016-07-06 01:18:26'),
(316, 1, '4UbsdZB1S36o0kB6gwUZZLvr2tBfulYh', '2016-07-06 15:54:18', '2016-07-06 15:54:18'),
(317, 1, 'lBnHV4skjyGtutRJYIcAKhsxNS878Utg', '2016-07-06 23:18:38', '2016-07-06 23:18:38'),
(318, 1, 'aF0IYb4DAZFnJcvW0skEzRV2gm18h8oL', '2016-07-07 15:50:48', '2016-07-07 15:50:48'),
(319, 1, 'g7IIGpWGNAQPrXVL6D54125oAWQuISpR', '2016-07-07 19:13:06', '2016-07-07 19:13:06'),
(320, 1, 'pOJmh7V1Y9ebL5pmy2WjIHIsV8hJpVsy', '2016-07-08 03:05:23', '2016-07-08 03:05:23'),
(321, 1, 't9eZFYdp32aDAHgoRMpcf8FDjVyyN90j', '2016-07-08 18:12:37', '2016-07-08 18:12:37'),
(322, 1, 'hFjTDO4lqfSn1yCTKWuzyu0Nbf7kAzg8', '2016-07-11 16:45:47', '2016-07-11 16:45:47'),
(323, 1, 'dZqrz9oTc3dZkX0ug6KF8o9DpL6AkQ3l', '2016-07-11 18:21:32', '2016-07-11 18:21:32'),
(324, 1, 'mHmXA0iLvGTgWu7Qxo3u3lpIAI3uRBGH', '2016-07-11 23:30:23', '2016-07-11 23:30:23'),
(325, 1, 'knzXs2iN9cfELp7h3eJ8mJx7ihYPbYeX', '2016-07-12 21:01:12', '2016-07-12 21:01:12'),
(326, 1, 'vKmgFdEiHpFHyLNDxdURHiEEM9qsRG4n', '2016-07-13 16:18:51', '2016-07-13 16:18:51'),
(332, 1, 'NYreQp0fktESuJTdpLYl6VZPjDLfMU6B', '2016-07-15 18:56:04', '2016-07-15 18:56:04'),
(333, 1, 'SpT1STfgGrZxE5wLVlBG40Hh35qVlLCr', '2016-07-15 22:17:54', '2016-07-15 22:17:54'),
(334, 1, '5jSudxw9aHDXhmJ7rWVMYMD8qEKDVWQG', '2016-07-16 15:56:22', '2016-07-16 15:56:22'),
(335, 1, 'T6xRmL22oflVVTg0kzFXzqhS4XxCbco6', '2016-07-16 20:29:11', '2016-07-16 20:29:11'),
(336, 1, 'X2kWnXdrPFRCBA5xS3jSqtWq3vXoW5BR', '2016-07-18 16:21:53', '2016-07-18 16:21:53'),
(337, 1, 'Zzpz8N9sUnBg0Rndv2zuHirCJPkN8NjV', '2016-07-18 23:26:43', '2016-07-18 23:26:43'),
(338, 1, 'WxlEOqP1xxKpa7z4dvLYpGAYp7EiutYz', '2016-07-19 01:34:15', '2016-07-19 01:34:15'),
(339, 1, 'hvHJUXgYKDtb4oSjqZEZKsO6fZ9MNxvE', '2016-07-20 19:15:39', '2016-07-20 19:15:39'),
(340, 1, 'WInXl5beE6iNl8UzvbPuuOMJCAUzshoz', '2016-07-22 03:37:06', '2016-07-22 03:37:06'),
(341, 1, 'DQOxYTT968mhcfXWvy4lKTrwaoqKHkkD', '2016-07-22 19:32:47', '2016-07-22 19:32:47'),
(342, 1, 'HRsr4HZ6Env9XuZCr8vOHCxP6bOyaS30', '2016-07-23 20:44:22', '2016-07-23 20:44:22'),
(343, 1, '34OFBFQEvxdcaswuG9HVyso5rzSQQQQB', '2016-07-27 20:26:23', '2016-07-27 20:26:23'),
(344, 1, 'ehEVcur4xjN2XjC77UlJavjpNgU980Be', '2016-07-28 20:07:50', '2016-07-28 20:07:50'),
(350, 1, 'B3YQkVCGqWdtEs4Gxe9fzLXq5lqcd0wS', '2016-07-28 23:49:31', '2016-07-28 23:49:31'),
(353, 1, 'kdGzfxUYaonbqgHFGA1ljiCRcjb4tRix', '2016-07-29 16:01:59', '2016-07-29 16:01:59'),
(354, 1, 'VvHlgxB7c8ZKxlERVVeceZKCCofnfhLA', '2016-07-30 16:35:44', '2016-07-30 16:35:44'),
(355, 1, 'CYrDj4y0Q2g1ZqXJh4nmHRNN4hRDThtm', '2016-08-01 18:07:20', '2016-08-01 18:07:20'),
(356, 1, 'pcrVQkqQ8KBHD0f9yIT0jNyxnK3wY0Tr', '2016-08-02 15:18:46', '2016-08-02 15:18:46'),
(357, 1, 'QFwHq77h2bhr3VUWZ4drk3am5ido0U90', '2016-08-02 23:32:46', '2016-08-02 23:32:46'),
(358, 1, 'ub0c2ADp2Np9p7HOCF2nZZmK7wHQLg4P', '2016-08-05 17:38:03', '2016-08-05 17:38:03'),
(359, 1, 'NQc1KFOVEp8MFxzX2tML89AJca40215g', '2016-08-05 21:16:26', '2016-08-05 21:16:26'),
(360, 1, '9FHDdVRgzwrz2mtPXuk6C1Rz91mBEzbD', '2016-08-08 03:20:01', '2016-08-08 03:20:01'),
(361, 1, 'Wd4OBSF1sMzsnP1NpLdncavfByp8yC7t', '2016-08-10 17:38:55', '2016-08-10 17:38:55'),
(362, 1, 'JmQqcXjvV2txs02sMNjfVuEeUbJU36dZ', '2016-08-12 19:38:59', '2016-08-12 19:38:59'),
(363, 1, 'Sk2gnTYPYcpCubpDD7J4rpYMiF7i7Fb8', '2016-08-14 05:45:01', '2016-08-14 05:45:01'),
(364, 1, 'XCRjeyoAWHmSG7divdG6d89phS6uR8ZC', '2016-08-18 21:47:18', '2016-08-18 21:47:18'),
(365, 1, 'YsMvmaUbswJPwnzeABi6nBlDADTp5e0S', '2016-08-19 21:54:24', '2016-08-19 21:54:24'),
(366, 1, 'SI5o589POLXIiLdJXc4lHPT7McbaGe3i', '2016-08-27 17:59:28', '2016-08-27 17:59:28'),
(367, 1, '2MfscYProhkJetHALFX8stZU4y8vrqzD', '2016-08-29 16:02:08', '2016-08-29 16:02:08'),
(368, 1, '6Gi5hGbjtq30JnlgCnp7QKolyhGMIVQi', '2016-08-29 20:39:19', '2016-08-29 20:39:19'),
(369, 1, 'q04Dhw9gZsPoNQeXBRyfDyZSDG6IUFD0', '2016-08-30 00:02:55', '2016-08-30 00:02:55'),
(372, 1, 'a22XtkPurLky9zhOqkg5ZPENNiSSLZr6', '2016-08-31 17:03:42', '2016-08-31 17:03:42'),
(373, 1, 'dRu1un475lhUaiil9fyNcECcQJmH81K9', '2016-09-01 00:44:31', '2016-09-01 00:44:31'),
(374, 1, 'IjZ5ki3Gji4CKYO9GY7ZsBvKjCC3m5Zk', '2016-09-01 18:30:01', '2016-09-01 18:30:01'),
(375, 1, 'mPK4bki1FOdnP26gCYyeZTv2TCB2Hepp', '2016-09-02 16:22:18', '2016-09-02 16:22:18'),
(376, 1, 'eJMCRniJ03pvcNDSL1PaXa3bEnb3qxae', '2016-09-03 00:37:47', '2016-09-03 00:37:47'),
(377, 1, 's61DIKYiD0lyHuQx0tASb68EoH4nznQI', '2016-09-03 15:39:51', '2016-09-03 15:39:51'),
(379, 1, 'QUtUQMkiGLin5TLbmXZG10EHm7wH6297', '2016-09-05 20:52:55', '2016-09-05 20:52:55'),
(380, 1, 'DjcZQOmfqSm3qduoCjWsEnAIcqk9Gkgd', '2016-09-06 01:35:24', '2016-09-06 01:35:24'),
(381, 1, 'LVmCT909mDG2l5RHHDtnZ92b03vFeUwG', '2016-09-06 15:55:32', '2016-09-06 15:55:32'),
(382, 1, 'qkrbU7soBVlrxTtdCx6uXJYObkHUA7UL', '2016-09-09 00:09:54', '2016-09-09 00:09:54'),
(383, 1, 'Y1cdJIaxdz51wOw7SMjn9kg4by7v0a8y', '2016-09-10 20:25:48', '2016-09-10 20:25:48'),
(384, 1, 'm1xYNPdi7qoECnKv5oLFqATgFDkTvH8v', '2016-09-12 16:44:15', '2016-09-12 16:44:15'),
(385, 1, '4J5vsjEJpaEwSowkNArCGTEQbzJ0w96n', '2016-09-14 17:52:34', '2016-09-14 17:52:34'),
(386, 1, 'C3wDoi8rDyGdKYZJgCGI5d3H6XfrMjbD', '2016-09-15 00:46:18', '2016-09-15 00:46:18'),
(387, 1, 'mBpBvbgdPYfIsks9xko4eZIcB0gfV0eS', '2016-09-15 15:31:45', '2016-09-15 15:31:45'),
(388, 1, 'txfBj99hcNpDVZoCCgK15Qno1DM9v28F', '2016-09-16 00:44:06', '2016-09-16 00:44:06'),
(389, 1, 'sApV6ubgYCjUCJmLwPUTEQZ9PamTfWMz', '2016-09-16 05:41:29', '2016-09-16 05:41:29'),
(390, 1, '0kCCrzDFxfmEAt3DH0HCIB7GD0qcDkMJ', '2016-09-17 19:41:20', '2016-09-17 19:41:20'),
(391, 1, '6IBBDrn9JVZey7GR2ldSrIC7mQD6DFh7', '2016-09-19 23:57:12', '2016-09-19 23:57:12'),
(392, 1, 'LGkD3D66nID1b2yP7tOhkn0VecDsM6tQ', '2016-09-20 03:19:17', '2016-09-20 03:19:17'),
(393, 1, 'qFJh6uyZp0pJds30tojGcOUiflz1DjnY', '2016-09-24 00:55:31', '2016-09-24 00:55:31'),
(395, 1, 'UeXEdXGOH08bAdL2EBz8OFx8MVI62Jip', '2016-09-26 15:48:59', '2016-09-26 15:48:59'),
(396, 1, '18M1d4kO10F2vmVx3w68WdDpbQRg0UCX', '2016-09-27 18:03:44', '2016-09-27 18:03:44'),
(397, 1, 'ijv4ZXR2FRQVw760nAjDn49EM84jMBjZ', '2016-09-29 22:58:03', '2016-09-29 22:58:03'),
(398, 1, 'FH9PEDxdcYRwqEynOvxDysM73iPlkJ8H', '2016-09-30 21:43:57', '2016-09-30 21:43:57'),
(399, 1, 'n9yjB4Q7IM8QDHEbp6wzgelcc1zja5Gt', '2016-10-01 21:30:23', '2016-10-01 21:30:23'),
(400, 1, '2Dfp2oGHwlwCVFwsp1dkMcacr8Vyd11A', '2016-10-05 18:45:42', '2016-10-05 18:45:42'),
(401, 1, 'Apc52bubZFEya1S60MgVuYRqk3s7gzDW', '2018-04-09 05:24:18', '2018-04-09 05:24:18'),
(402, 1, 'wrHOsFGx9fMqV5amaYIVDZzGzcZF3C5g', '2018-04-09 06:19:29', '2018-04-09 06:19:29'),
(406, 1, 'VpWxCLHAuVHksl0gigTSTPINYPLQm7hB', '2018-04-25 04:45:01', '2018-04-25 04:45:01'),
(407, 1, '2CqFPaxjwLgbYbAaXUORHEGm9NhMBwWz', '2018-04-26 04:35:00', '2018-04-26 04:35:00'),
(408, 1, 'Gj1OT3wTw0G1EG8j9P6ISb9zSctWFdqf', '2018-05-01 03:05:13', '2018-05-01 03:05:13'),
(409, 1, '4Cb14ohYzFQwg3Pnmb8ABiSyyUcRDjWy', '2018-05-01 06:29:55', '2018-05-01 06:29:55'),
(410, 1, 'RtALKp8yJrvrWppOCeCpWXGFy1Ks5mK0', '2018-05-01 12:32:09', '2018-05-01 12:32:09'),
(424, 1, 'HDmeSGAfP3Y22Vt7jsuQW6MXAbMwhTnW', '2018-05-02 12:15:01', '2018-05-02 12:15:01'),
(428, 25, 'Fr2e7cBK6W9VXr3ihcPxWrvdt2GqmDqX', '2018-05-03 12:51:20', '2018-05-03 12:51:20'),
(429, 1, 'Cm4QDb6azI4kZQ5ySW0KuO2VunzOYgRM', '2018-05-04 05:09:18', '2018-05-04 05:09:18'),
(436, 1, 's9R4VcpN931WVghAsICAbq2hDMMuEdNr', '2018-05-06 06:11:51', '2018-05-06 06:11:51'),
(438, 25, 'x0Xco8hsazy9lvUyOR0N9XTb6Ws1E0ik', '2018-05-08 08:56:24', '2018-05-08 08:56:24'),
(440, 25, 'oLoxAJMIEuu8QRYXfCBFD3WbFu3IYa3s', '2018-05-09 04:09:51', '2018-05-09 04:09:51'),
(444, 1, 'LToKgAyKrCr0FGRV8zcFhFyTfEi48vHM', '2018-05-10 05:15:54', '2018-05-10 05:15:54'),
(448, 25, 'mtCgwO403pthzTDszWxbufUxeLurfIF8', '2018-05-10 14:26:24', '2018-05-10 14:26:24'),
(457, 25, 'gDBJFCgneu81qMKJEMACwxRNRUjZhbVv', '2018-05-11 05:42:44', '2018-05-11 05:42:44'),
(458, 25, '9bqQTk2b5fYFE9lsTvQIQOxibzFphEyG', '2018-05-11 05:53:54', '2018-05-11 05:53:54'),
(460, 32, 'KO8HvgaO5IzEt0MXq24k1id1XowJCeHQ', '2018-05-11 07:27:23', '2018-05-11 07:27:23'),
(461, 25, '4y1J5OVN3fXdwhJZGsMHWIi3MZHvn7wn', '2018-05-11 08:11:51', '2018-05-11 08:11:51'),
(463, 30, 'aMsdHSmYjuZbMbCfpZF0YA8QlsprRpIy', '2018-05-11 15:39:02', '2018-05-11 15:39:02'),
(464, 30, 'Hbt9u2qO0rlRylWutdCbiQCCXAz8omw9', '2018-05-13 17:07:28', '2018-05-13 17:07:28'),
(467, 25, 'LrESyO0SEwxVlus3DTl9RLYoT5kPqfzg', '2018-05-14 10:58:31', '2018-05-14 10:58:31'),
(475, 34, 'EYSYVqZ8qMyJpwIxj3KwNiAzymeAEEfj', '2018-05-14 13:24:13', '2018-05-14 13:24:13'),
(476, 25, 'eBuWIt01Y7B0iFSVGZAbDiKGWTIouUFF', '2018-05-14 15:27:32', '2018-05-14 15:27:32'),
(477, 25, 'nbwINeSLODhiWM9pyc4ReGNmZw3uQo4G', '2018-05-14 19:20:50', '2018-05-14 19:20:50'),
(479, 34, 'AwFPgzTDv5uN0xQu4WXPV1Khb1YhH9hi', '2018-05-15 03:08:59', '2018-05-15 03:08:59'),
(480, 25, 'ZiJDgNeXWWF2rH5Qu3nmxGs9nJvjVS6C', '2018-05-15 04:47:53', '2018-05-15 04:47:53'),
(481, 30, 'nOAuj7PKNTBHhL2e8ZHv2muddMGmFfFd', '2018-05-15 04:51:25', '2018-05-15 04:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_by` int(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', '{\"admin\":true,\"menu.add\":true,\"user.add\":true,\"user.edit\":true,\"menu.edit\":true,\"index\":true,\"permission.edit\":true,\"permission.add\":true,\"assignment.admin.attachment\":true,\"writer.allocate\":true,\"assignment.description\":true,\"writer.attachment\":true,\"assignment.list\":true,\"all.assignment.access\":true,\"add.complete\":true,\"common.menu\":true}', 1, '2015-10-26 04:16:31', '2018-05-02 11:33:49'),
(8, 'Program manager', 'Program manager', '{\n\"assignment.admin.attachment\":true,\n\"writer.allocate\":true,\n\"assignment.description\":true,\n\"assignment.list\":true,\n\"all.assignment.access\":true,\n\"add.complete\":true,\n\"common.menu\":true,\n\"price.add\":true,\n\"advance.add\":true,\n\"writer.edit\":true,\n\"writer.add\":true,\"writer.delete\":true,\n\"writer.view\":true\n}', 1, '2018-05-02 18:30:00', '2018-05-02 18:30:00'),
(9, 'Writer', 'Writer', '{\"index\":true,\"admin\":true,\"writer.attachment\":true,\"assignment.list\":true,\"common.menu\":true}', 1, '2018-05-02 05:49:36', '2018-05-02 10:17:22'),
(10, 'Coordinator', 'Coordinator', '{\n\"assignment.admin.attachment\":true,\n\"writer.allocate\":true,\n\"assignment.description\":true,\n\"assignment.list\":true,\n\"all.assignment.access\":true,\n\"add.complete\":true,\n\"common.menu\":true,\n\"price.add\":true,\n\"advance.add\":true,\n\"user.add\":true,\n\"user.edit\":true,\n\"writer.add\":true,\n\"writer.view\":true,\n}', 1, '2018-05-02 00:19:36', '2018-05-02 04:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2015-12-13 18:30:00', '2015-12-13 18:30:00'),
(8, 3, '2015-12-31 03:17:31', '2015-12-31 03:17:31'),
(25, 8, '2018-05-03 12:51:02', '2018-05-03 12:51:02'),
(28, 1, '2018-05-10 15:36:16', '2018-05-10 15:36:16'),
(30, 8, '2018-05-10 15:39:10', '2018-05-10 15:39:10'),
(33, 10, '2018-05-14 13:22:12', '2018-05-14 13:22:12'),
(34, 9, '2018-05-14 13:22:45', '2018-05-14 13:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE `throttle` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `type`, `ip`, `created_at`, `updated_at`) VALUES
(1, NULL, 'global', NULL, '2015-07-11 06:05:27', '2015-07-11 06:05:27'),
(2, NULL, 'ip', '127.0.0.1', '2015-07-11 06:05:28', '2015-07-11 06:05:28'),
(3, NULL, 'global', NULL, '2015-07-11 06:06:28', '2015-07-11 06:06:28'),
(4, NULL, 'ip', '127.0.0.1', '2015-07-11 06:06:28', '2015-07-11 06:06:28'),
(5, NULL, 'global', NULL, '2015-07-13 04:44:23', '2015-07-13 04:44:23'),
(6, NULL, 'ip', '127.0.0.1', '2015-07-13 04:44:23', '2015-07-13 04:44:23'),
(7, 1, 'user', NULL, '2015-07-13 04:44:23', '2015-07-13 04:44:23'),
(8, NULL, 'global', NULL, '2015-07-26 10:24:02', '2015-07-26 10:24:02'),
(9, NULL, 'ip', '127.0.0.1', '2015-07-26 10:24:02', '2015-07-26 10:24:02'),
(10, 1, 'user', NULL, '2015-07-26 10:24:02', '2015-07-26 10:24:02'),
(11, NULL, 'global', NULL, '2015-08-13 09:48:09', '2015-08-13 09:48:09'),
(12, NULL, 'ip', '127.0.0.1', '2015-08-13 09:48:09', '2015-08-13 09:48:09'),
(13, 1, 'user', NULL, '2015-08-13 09:48:09', '2015-08-13 09:48:09'),
(14, NULL, 'global', NULL, '2015-08-13 09:50:45', '2015-08-13 09:50:45'),
(15, NULL, 'ip', '127.0.0.1', '2015-08-13 09:50:45', '2015-08-13 09:50:45'),
(16, 1, 'user', NULL, '2015-08-13 09:50:45', '2015-08-13 09:50:45'),
(17, NULL, 'global', NULL, '2015-08-18 03:31:17', '2015-08-18 03:31:17'),
(18, NULL, 'ip', '127.0.0.1', '2015-08-18 03:31:17', '2015-08-18 03:31:17'),
(19, 1, 'user', NULL, '2015-08-18 03:31:17', '2015-08-18 03:31:17'),
(20, NULL, 'global', NULL, '2015-08-20 03:57:44', '2015-08-20 03:57:44'),
(21, NULL, 'ip', '127.0.0.1', '2015-08-20 03:57:44', '2015-08-20 03:57:44'),
(22, 1, 'user', NULL, '2015-08-20 03:57:45', '2015-08-20 03:57:45'),
(23, NULL, 'global', NULL, '2015-08-20 04:52:53', '2015-08-20 04:52:53'),
(24, NULL, 'ip', '127.0.0.1', '2015-08-20 04:52:53', '2015-08-20 04:52:53'),
(25, 1, 'user', NULL, '2015-08-20 04:52:54', '2015-08-20 04:52:54'),
(26, NULL, 'global', NULL, '2015-08-20 04:53:06', '2015-08-20 04:53:06'),
(27, NULL, 'ip', '127.0.0.1', '2015-08-20 04:53:06', '2015-08-20 04:53:06'),
(28, 1, 'user', NULL, '2015-08-20 04:53:06', '2015-08-20 04:53:06'),
(29, NULL, 'global', NULL, '2015-08-20 04:53:09', '2015-08-20 04:53:09'),
(30, NULL, 'ip', '127.0.0.1', '2015-08-20 04:53:09', '2015-08-20 04:53:09'),
(31, 1, 'user', NULL, '2015-08-20 04:53:09', '2015-08-20 04:53:09'),
(32, NULL, 'global', NULL, '2015-08-20 04:55:59', '2015-08-20 04:55:59'),
(33, NULL, 'ip', '127.0.0.1', '2015-08-20 04:55:59', '2015-08-20 04:55:59'),
(34, 1, 'user', NULL, '2015-08-20 04:55:59', '2015-08-20 04:55:59'),
(35, NULL, 'global', NULL, '2015-08-20 04:56:18', '2015-08-20 04:56:18'),
(36, NULL, 'ip', '127.0.0.1', '2015-08-20 04:56:19', '2015-08-20 04:56:19'),
(37, 1, 'user', NULL, '2015-08-20 04:56:19', '2015-08-20 04:56:19'),
(38, NULL, 'global', NULL, '2015-08-20 04:57:25', '2015-08-20 04:57:25'),
(39, NULL, 'ip', '127.0.0.1', '2015-08-20 04:57:25', '2015-08-20 04:57:25'),
(40, 1, 'user', NULL, '2015-08-20 04:57:25', '2015-08-20 04:57:25'),
(41, NULL, 'global', NULL, '2015-08-24 15:06:12', '2015-08-24 15:06:12'),
(42, NULL, 'ip', '127.0.0.1', '2015-08-24 15:06:12', '2015-08-24 15:06:12'),
(43, NULL, 'global', NULL, '2015-08-24 15:08:25', '2015-08-24 15:08:25'),
(44, NULL, 'ip', '127.0.0.1', '2015-08-24 15:08:25', '2015-08-24 15:08:25'),
(45, NULL, 'global', NULL, '2015-08-24 15:09:09', '2015-08-24 15:09:09'),
(46, NULL, 'ip', '127.0.0.1', '2015-08-24 15:09:09', '2015-08-24 15:09:09'),
(47, NULL, 'global', NULL, '2015-08-24 15:09:44', '2015-08-24 15:09:44'),
(48, NULL, 'ip', '127.0.0.1', '2015-08-24 15:09:44', '2015-08-24 15:09:44'),
(49, NULL, 'global', NULL, '2015-08-24 15:09:49', '2015-08-24 15:09:49'),
(50, NULL, 'ip', '127.0.0.1', '2015-08-24 15:09:50', '2015-08-24 15:09:50'),
(51, NULL, 'global', NULL, '2015-08-24 15:11:29', '2015-08-24 15:11:29'),
(52, NULL, 'ip', '127.0.0.1', '2015-08-24 15:11:29', '2015-08-24 15:11:29'),
(53, NULL, 'global', NULL, '2015-08-25 07:26:45', '2015-08-25 07:26:45'),
(54, NULL, 'ip', '127.0.0.1', '2015-08-25 07:26:45', '2015-08-25 07:26:45'),
(55, NULL, 'global', NULL, '2015-08-26 07:48:20', '2015-08-26 07:48:20'),
(56, NULL, 'ip', '192.168.1.35', '2015-08-26 07:48:21', '2015-08-26 07:48:21'),
(57, NULL, 'global', NULL, '2015-08-26 07:48:23', '2015-08-26 07:48:23'),
(58, NULL, 'ip', '192.168.1.35', '2015-08-26 07:48:23', '2015-08-26 07:48:23'),
(59, NULL, 'global', NULL, '2015-08-26 07:48:27', '2015-08-26 07:48:27'),
(60, NULL, 'ip', '192.168.1.35', '2015-08-26 07:48:27', '2015-08-26 07:48:27'),
(61, NULL, 'global', NULL, '2015-08-26 07:48:31', '2015-08-26 07:48:31'),
(62, NULL, 'ip', '192.168.1.35', '2015-08-26 07:48:31', '2015-08-26 07:48:31'),
(63, NULL, 'global', NULL, '2015-08-26 07:48:36', '2015-08-26 07:48:36'),
(64, NULL, 'ip', '192.168.1.35', '2015-08-26 07:48:36', '2015-08-26 07:48:36'),
(65, NULL, 'global', NULL, '2015-08-26 07:48:48', '2015-08-26 07:48:48'),
(66, NULL, 'global', NULL, '2015-08-27 03:20:50', '2015-08-27 03:20:50'),
(67, NULL, 'ip', '127.0.0.1', '2015-08-27 03:20:50', '2015-08-27 03:20:50'),
(68, 1, 'user', NULL, '2015-08-27 03:20:50', '2015-08-27 03:20:50'),
(69, NULL, 'global', NULL, '2015-08-30 06:42:57', '2015-08-30 06:42:57'),
(70, NULL, 'ip', '127.0.0.1', '2015-08-30 06:42:57', '2015-08-30 06:42:57'),
(71, NULL, 'global', NULL, '2015-08-30 06:51:13', '2015-08-30 06:51:13'),
(72, NULL, 'ip', '127.0.0.1', '2015-08-30 06:51:14', '2015-08-30 06:51:14'),
(73, NULL, 'global', NULL, '2015-09-06 11:03:36', '2015-09-06 11:03:36'),
(74, NULL, 'ip', '127.0.0.1', '2015-09-06 11:03:36', '2015-09-06 11:03:36'),
(75, NULL, 'global', NULL, '2015-09-18 05:45:18', '2015-09-18 05:45:18'),
(76, NULL, 'ip', '192.168.1.15', '2015-09-18 05:45:18', '2015-09-18 05:45:18'),
(77, NULL, 'global', NULL, '2015-09-18 05:45:22', '2015-09-18 05:45:22'),
(78, NULL, 'ip', '192.168.1.15', '2015-09-18 05:45:22', '2015-09-18 05:45:22'),
(79, NULL, 'global', NULL, '2015-09-18 05:45:30', '2015-09-18 05:45:30'),
(80, NULL, 'ip', '192.168.1.15', '2015-09-18 05:45:30', '2015-09-18 05:45:30'),
(81, NULL, 'global', NULL, '2015-09-18 05:45:34', '2015-09-18 05:45:34'),
(82, NULL, 'ip', '192.168.1.15', '2015-09-18 05:45:34', '2015-09-18 05:45:34'),
(83, NULL, 'global', NULL, '2015-09-18 05:45:40', '2015-09-18 05:45:40'),
(84, NULL, 'ip', '192.168.1.15', '2015-09-18 05:45:40', '2015-09-18 05:45:40'),
(85, NULL, 'global', NULL, '2015-10-29 13:37:26', '2015-10-29 13:37:26'),
(86, NULL, 'ip', '127.0.0.1', '2015-10-29 13:37:26', '2015-10-29 13:37:26'),
(87, 1, 'user', NULL, '2015-10-29 13:37:26', '2015-10-29 13:37:26'),
(88, NULL, 'global', NULL, '2015-10-29 13:37:30', '2015-10-29 13:37:30'),
(89, NULL, 'ip', '127.0.0.1', '2015-10-29 13:37:30', '2015-10-29 13:37:30'),
(90, 1, 'user', NULL, '2015-10-29 13:37:30', '2015-10-29 13:37:30'),
(91, NULL, 'global', NULL, '2015-10-29 13:37:34', '2015-10-29 13:37:34'),
(92, NULL, 'ip', '127.0.0.1', '2015-10-29 13:37:34', '2015-10-29 13:37:34'),
(93, 1, 'user', NULL, '2015-10-29 13:37:34', '2015-10-29 13:37:34'),
(94, NULL, 'global', NULL, '2015-10-29 13:37:41', '2015-10-29 13:37:41'),
(95, NULL, 'ip', '127.0.0.1', '2015-10-29 13:37:41', '2015-10-29 13:37:41'),
(96, 1, 'user', NULL, '2015-10-29 13:37:41', '2015-10-29 13:37:41'),
(97, NULL, 'global', NULL, '2015-10-29 13:37:48', '2015-10-29 13:37:48'),
(98, NULL, 'ip', '127.0.0.1', '2015-10-29 13:37:48', '2015-10-29 13:37:48'),
(99, 1, 'user', NULL, '2015-10-29 13:37:48', '2015-10-29 13:37:48'),
(100, NULL, 'global', NULL, '2015-10-29 13:37:52', '2015-10-29 13:37:52'),
(101, NULL, 'ip', '127.0.0.1', '2015-10-29 13:37:52', '2015-10-29 13:37:52'),
(102, 1, 'user', NULL, '2015-10-29 13:37:52', '2015-10-29 13:37:52'),
(103, NULL, 'global', NULL, '2015-11-04 03:13:02', '2015-11-04 03:13:02'),
(104, NULL, 'ip', '127.0.0.1', '2015-11-04 03:13:02', '2015-11-04 03:13:02'),
(105, 1, 'user', NULL, '2015-11-04 03:13:02', '2015-11-04 03:13:02'),
(106, NULL, 'global', NULL, '2015-11-07 11:26:55', '2015-11-07 11:26:55'),
(107, NULL, 'ip', '127.0.0.1', '2015-11-07 11:26:55', '2015-11-07 11:26:55'),
(108, NULL, 'global', NULL, '2015-11-07 11:27:01', '2015-11-07 11:27:01'),
(109, NULL, 'ip', '127.0.0.1', '2015-11-07 11:27:01', '2015-11-07 11:27:01'),
(110, NULL, 'global', NULL, '2015-11-18 18:09:36', '2015-11-18 18:09:36'),
(111, NULL, 'ip', '127.0.0.1', '2015-11-18 18:09:36', '2015-11-18 18:09:36'),
(112, NULL, 'global', NULL, '2015-11-18 18:09:43', '2015-11-18 18:09:43'),
(113, NULL, 'ip', '127.0.0.1', '2015-11-18 18:09:43', '2015-11-18 18:09:43'),
(114, NULL, 'global', NULL, '2015-11-18 18:12:14', '2015-11-18 18:12:14'),
(115, NULL, 'ip', '127.0.0.1', '2015-11-18 18:12:14', '2015-11-18 18:12:14'),
(116, NULL, 'global', NULL, '2015-11-18 18:12:27', '2015-11-18 18:12:27'),
(117, NULL, 'ip', '127.0.0.1', '2015-11-18 18:12:27', '2015-11-18 18:12:27'),
(118, NULL, 'global', NULL, '2015-11-18 18:12:36', '2015-11-18 18:12:36'),
(119, NULL, 'ip', '127.0.0.1', '2015-11-18 18:12:36', '2015-11-18 18:12:36'),
(120, NULL, 'global', NULL, '2015-11-18 20:27:03', '2015-11-18 20:27:03'),
(121, NULL, 'ip', '::1', '2015-11-18 20:27:03', '2015-11-18 20:27:03'),
(122, NULL, 'global', NULL, '2015-11-18 20:27:06', '2015-11-18 20:27:06'),
(123, NULL, 'ip', '::1', '2015-11-18 20:27:06', '2015-11-18 20:27:06'),
(124, NULL, 'global', NULL, '2015-11-18 21:26:24', '2015-11-18 21:26:24'),
(125, NULL, 'ip', '::1', '2015-11-18 21:26:24', '2015-11-18 21:26:24'),
(126, 1, 'user', NULL, '2015-11-18 21:26:24', '2015-11-18 21:26:24'),
(127, NULL, 'global', NULL, '2015-11-18 21:26:27', '2015-11-18 21:26:27'),
(128, NULL, 'ip', '::1', '2015-11-18 21:26:27', '2015-11-18 21:26:27'),
(129, 1, 'user', NULL, '2015-11-18 21:26:27', '2015-11-18 21:26:27'),
(130, NULL, 'global', NULL, '2015-11-23 18:13:05', '2015-11-23 18:13:05'),
(131, NULL, 'ip', '::1', '2015-11-23 18:13:05', '2015-11-23 18:13:05'),
(132, 1, 'user', NULL, '2015-11-23 18:13:05', '2015-11-23 18:13:05'),
(133, NULL, 'global', NULL, '2015-11-24 01:14:15', '2015-11-24 01:14:15'),
(134, NULL, 'ip', '::1', '2015-11-24 01:14:15', '2015-11-24 01:14:15'),
(135, NULL, 'global', NULL, '2015-12-03 01:12:12', '2015-12-03 01:12:12'),
(136, NULL, 'ip', '::1', '2015-12-03 01:12:12', '2015-12-03 01:12:12'),
(137, 1, 'user', NULL, '2015-12-03 01:12:12', '2015-12-03 01:12:12'),
(138, NULL, 'global', NULL, '2015-12-03 02:32:03', '2015-12-03 02:32:03'),
(139, NULL, 'ip', '::1', '2015-12-03 02:32:03', '2015-12-03 02:32:03'),
(140, 1, 'user', NULL, '2015-12-03 02:32:03', '2015-12-03 02:32:03'),
(141, NULL, 'global', NULL, '2015-12-03 17:42:59', '2015-12-03 17:42:59'),
(142, NULL, 'ip', '127.0.0.1', '2015-12-03 17:42:59', '2015-12-03 17:42:59'),
(143, 1, 'user', NULL, '2015-12-03 17:42:59', '2015-12-03 17:42:59'),
(144, NULL, 'global', NULL, '2015-12-03 17:43:02', '2015-12-03 17:43:02'),
(145, NULL, 'ip', '127.0.0.1', '2015-12-03 17:43:02', '2015-12-03 17:43:02'),
(146, 1, 'user', NULL, '2015-12-03 17:43:02', '2015-12-03 17:43:02'),
(147, NULL, 'global', NULL, '2015-12-14 04:55:50', '2015-12-14 04:55:50'),
(148, NULL, 'ip', '::1', '2015-12-14 04:55:50', '2015-12-14 04:55:50'),
(149, NULL, 'global', NULL, '2015-12-31 03:12:36', '2015-12-31 03:12:36'),
(150, NULL, 'ip', '::1', '2015-12-31 03:12:36', '2015-12-31 03:12:36'),
(151, NULL, 'global', NULL, '2015-12-31 03:17:54', '2015-12-31 03:17:54'),
(152, NULL, 'ip', '::1', '2015-12-31 03:17:54', '2015-12-31 03:17:54'),
(153, 8, 'user', NULL, '2015-12-31 03:17:55', '2015-12-31 03:17:55'),
(154, NULL, 'global', NULL, '2015-12-31 03:18:17', '2015-12-31 03:18:17'),
(155, NULL, 'ip', '::1', '2015-12-31 03:18:17', '2015-12-31 03:18:17'),
(156, 8, 'user', NULL, '2015-12-31 03:18:17', '2015-12-31 03:18:17'),
(157, NULL, 'global', NULL, '2015-12-31 03:19:38', '2015-12-31 03:19:38'),
(158, NULL, 'ip', '::1', '2015-12-31 03:19:38', '2015-12-31 03:19:38'),
(160, NULL, 'global', NULL, '2016-01-04 18:56:38', '2016-01-04 18:56:38'),
(161, NULL, 'ip', '127.0.0.1', '2016-01-04 18:56:38', '2016-01-04 18:56:38'),
(162, NULL, 'global', NULL, '2016-01-04 18:57:11', '2016-01-04 18:57:11'),
(163, NULL, 'ip', '127.0.0.1', '2016-01-04 18:57:11', '2016-01-04 18:57:11'),
(164, 1, 'user', NULL, '2016-01-04 18:57:11', '2016-01-04 18:57:11'),
(165, NULL, 'global', NULL, '2016-01-04 18:57:17', '2016-01-04 18:57:17'),
(166, NULL, 'ip', '127.0.0.1', '2016-01-04 18:57:17', '2016-01-04 18:57:17'),
(167, 1, 'user', NULL, '2016-01-04 18:57:17', '2016-01-04 18:57:17'),
(168, NULL, 'global', NULL, '2016-01-04 22:00:01', '2016-01-04 22:00:01'),
(169, NULL, 'ip', '::1', '2016-01-04 22:00:01', '2016-01-04 22:00:01'),
(170, 1, 'user', NULL, '2016-01-04 22:00:01', '2016-01-04 22:00:01'),
(171, NULL, 'global', NULL, '2016-01-05 23:05:03', '2016-01-05 23:05:03'),
(172, NULL, 'ip', '::1', '2016-01-05 23:05:04', '2016-01-05 23:05:04'),
(173, NULL, 'global', NULL, '2016-01-05 23:05:12', '2016-01-05 23:05:12'),
(174, NULL, 'ip', '::1', '2016-01-05 23:05:12', '2016-01-05 23:05:12'),
(175, NULL, 'global', NULL, '2016-01-05 23:05:16', '2016-01-05 23:05:16'),
(176, NULL, 'ip', '::1', '2016-01-05 23:05:16', '2016-01-05 23:05:16'),
(177, NULL, 'global', NULL, '2016-04-09 03:03:01', '2016-04-09 03:03:01'),
(178, NULL, 'ip', '127.0.0.1', '2016-04-09 03:03:01', '2016-04-09 03:03:01'),
(179, NULL, 'global', NULL, '2016-04-09 03:03:06', '2016-04-09 03:03:06'),
(180, NULL, 'ip', '127.0.0.1', '2016-04-09 03:03:06', '2016-04-09 03:03:06'),
(181, NULL, 'global', NULL, '2016-04-11 04:23:58', '2016-04-11 04:23:58'),
(182, NULL, 'ip', '127.0.0.1', '2016-04-11 04:23:58', '2016-04-11 04:23:58'),
(183, NULL, 'global', NULL, '2016-04-26 10:36:39', '2016-04-26 10:36:39'),
(184, NULL, 'ip', '::1', '2016-04-26 10:36:39', '2016-04-26 10:36:39'),
(186, NULL, 'global', NULL, '2016-04-26 12:01:51', '2016-04-26 12:01:51'),
(187, NULL, 'ip', '127.0.0.1', '2016-04-26 12:01:51', '2016-04-26 12:01:51'),
(188, NULL, 'global', NULL, '2016-04-26 12:01:55', '2016-04-26 12:01:55'),
(189, NULL, 'ip', '127.0.0.1', '2016-04-26 12:01:55', '2016-04-26 12:01:55'),
(190, NULL, 'global', NULL, '2016-04-26 12:02:01', '2016-04-26 12:02:01'),
(191, NULL, 'ip', '127.0.0.1', '2016-04-26 12:02:01', '2016-04-26 12:02:01'),
(192, NULL, 'global', NULL, '2016-04-27 03:22:37', '2016-04-27 03:22:37'),
(193, NULL, 'ip', '127.0.0.1', '2016-04-27 03:22:37', '2016-04-27 03:22:37'),
(195, NULL, 'global', NULL, '2016-04-27 03:40:22', '2016-04-27 03:40:22'),
(196, NULL, 'ip', '127.0.0.1', '2016-04-27 03:40:22', '2016-04-27 03:40:22'),
(198, NULL, 'global', NULL, '2016-04-27 03:54:29', '2016-04-27 03:54:29'),
(199, NULL, 'ip', '127.0.0.1', '2016-04-27 03:54:29', '2016-04-27 03:54:29'),
(200, 1, 'user', NULL, '2016-04-27 03:54:29', '2016-04-27 03:54:29'),
(201, NULL, 'global', NULL, '2016-04-27 04:21:06', '2016-04-27 04:21:06'),
(202, NULL, 'ip', '127.0.0.1', '2016-04-27 04:21:06', '2016-04-27 04:21:06'),
(203, 1, 'user', NULL, '2016-04-27 04:21:06', '2016-04-27 04:21:06'),
(204, NULL, 'global', NULL, '2016-06-20 05:02:37', '2016-06-20 05:02:37'),
(205, NULL, 'ip', '172.16.2.2', '2016-06-20 05:02:37', '2016-06-20 05:02:37'),
(206, 1, 'user', NULL, '2016-06-20 05:02:37', '2016-06-20 05:02:37'),
(207, NULL, 'global', NULL, '2016-06-30 22:29:21', '2016-06-30 22:29:21'),
(208, NULL, 'ip', '123.231.122.71', '2016-06-30 22:29:21', '2016-06-30 22:29:21'),
(209, NULL, 'global', NULL, '2016-06-30 22:29:26', '2016-06-30 22:29:26'),
(210, NULL, 'ip', '123.231.122.71', '2016-06-30 22:29:26', '2016-06-30 22:29:26'),
(211, NULL, 'global', NULL, '2016-06-30 22:29:35', '2016-06-30 22:29:35'),
(212, NULL, 'ip', '123.231.122.71', '2016-06-30 22:29:35', '2016-06-30 22:29:35'),
(213, NULL, 'global', NULL, '2016-07-01 22:28:03', '2016-07-01 22:28:03'),
(214, NULL, 'ip', '112.134.66.139', '2016-07-01 22:28:03', '2016-07-01 22:28:03'),
(215, NULL, 'global', NULL, '2016-07-01 23:47:47', '2016-07-01 23:47:47'),
(216, NULL, 'ip', '103.247.50.159', '2016-07-01 23:47:47', '2016-07-01 23:47:47'),
(217, NULL, 'global', NULL, '2016-07-07 22:44:48', '2016-07-07 22:44:48'),
(218, NULL, 'ip', '123.231.122.251', '2016-07-07 22:44:48', '2016-07-07 22:44:48'),
(219, NULL, 'global', NULL, '2016-07-07 22:44:52', '2016-07-07 22:44:52'),
(220, NULL, 'ip', '123.231.122.251', '2016-07-07 22:44:52', '2016-07-07 22:44:52'),
(221, NULL, 'global', NULL, '2016-07-07 22:45:00', '2016-07-07 22:45:00'),
(222, NULL, 'ip', '123.231.122.251', '2016-07-07 22:45:00', '2016-07-07 22:45:00'),
(223, NULL, 'global', NULL, '2016-07-07 22:45:11', '2016-07-07 22:45:11'),
(224, NULL, 'ip', '123.231.122.251', '2016-07-07 22:45:11', '2016-07-07 22:45:11'),
(225, NULL, 'global', NULL, '2016-07-16 20:42:27', '2016-07-16 20:42:27'),
(226, NULL, 'ip', '112.134.34.19', '2016-07-16 20:42:27', '2016-07-16 20:42:27'),
(227, NULL, 'global', NULL, '2016-07-16 20:42:31', '2016-07-16 20:42:31'),
(228, NULL, 'ip', '112.134.34.19', '2016-07-16 20:42:31', '2016-07-16 20:42:31'),
(229, NULL, 'global', NULL, '2016-07-22 03:34:09', '2016-07-22 03:34:09'),
(230, NULL, 'ip', '112.134.64.176', '2016-07-22 03:34:09', '2016-07-22 03:34:09'),
(232, NULL, 'global', NULL, '2016-07-22 03:34:20', '2016-07-22 03:34:20'),
(233, NULL, 'ip', '112.134.64.176', '2016-07-22 03:34:20', '2016-07-22 03:34:20'),
(235, NULL, 'global', NULL, '2016-07-22 03:34:22', '2016-07-22 03:34:22'),
(236, NULL, 'ip', '112.134.64.176', '2016-07-22 03:34:22', '2016-07-22 03:34:22'),
(238, NULL, 'global', NULL, '2016-07-22 03:34:44', '2016-07-22 03:34:44'),
(239, NULL, 'ip', '112.134.64.176', '2016-07-22 03:34:44', '2016-07-22 03:34:44'),
(241, NULL, 'global', NULL, '2016-07-22 03:35:13', '2016-07-22 03:35:13'),
(242, NULL, 'ip', '112.134.64.176', '2016-07-22 03:35:13', '2016-07-22 03:35:13'),
(244, NULL, 'global', NULL, '2016-07-27 07:54:14', '2016-07-27 07:54:14'),
(245, NULL, 'ip', '82.145.217.195', '2016-07-27 07:54:14', '2016-07-27 07:54:14'),
(246, NULL, 'global', NULL, '2016-07-27 19:44:34', '2016-07-27 19:44:34'),
(247, NULL, 'ip', '203.94.94.234', '2016-07-27 19:44:34', '2016-07-27 19:44:34'),
(248, NULL, 'global', NULL, '2016-07-28 17:25:54', '2016-07-28 17:25:54'),
(249, NULL, 'ip', '124.43.86.47', '2016-07-28 17:25:54', '2016-07-28 17:25:54'),
(250, NULL, 'global', NULL, '2016-07-28 17:26:28', '2016-07-28 17:26:28'),
(251, NULL, 'ip', '124.43.86.47', '2016-07-28 17:26:28', '2016-07-28 17:26:28'),
(252, NULL, 'global', NULL, '2016-07-28 17:27:10', '2016-07-28 17:27:10'),
(253, NULL, 'ip', '124.43.86.47', '2016-07-28 17:27:10', '2016-07-28 17:27:10'),
(254, NULL, 'global', NULL, '2016-07-28 17:27:24', '2016-07-28 17:27:24'),
(255, NULL, 'ip', '124.43.86.47', '2016-07-28 17:27:24', '2016-07-28 17:27:24'),
(256, NULL, 'global', NULL, '2016-07-28 23:48:14', '2016-07-28 23:48:14'),
(257, NULL, 'ip', '112.134.65.41', '2016-07-28 23:48:14', '2016-07-28 23:48:14'),
(258, NULL, 'global', NULL, '2016-08-02 20:32:35', '2016-08-02 20:32:35'),
(259, NULL, 'ip', '31.7.100.81', '2016-08-02 20:32:35', '2016-08-02 20:32:35'),
(260, NULL, 'global', NULL, '2016-08-15 18:38:43', '2016-08-15 18:38:43'),
(261, NULL, 'ip', '124.43.24.98', '2016-08-15 18:38:43', '2016-08-15 18:38:43'),
(262, NULL, 'global', NULL, '2016-08-16 21:58:11', '2016-08-16 21:58:11'),
(263, NULL, 'ip', '121.54.54.48', '2016-08-16 21:58:11', '2016-08-16 21:58:11'),
(264, NULL, 'global', NULL, '2016-08-22 18:46:40', '2016-08-22 18:46:40'),
(265, NULL, 'ip', '123.231.121.121', '2016-08-22 18:46:40', '2016-08-22 18:46:40'),
(266, NULL, 'global', NULL, '2016-08-26 15:22:19', '2016-08-26 15:22:19'),
(267, NULL, 'ip', '112.134.67.54', '2016-08-26 15:22:19', '2016-08-26 15:22:19'),
(268, NULL, 'global', NULL, '2016-08-26 15:22:36', '2016-08-26 15:22:36'),
(269, NULL, 'ip', '112.134.67.54', '2016-08-26 15:22:36', '2016-08-26 15:22:36'),
(270, NULL, 'global', NULL, '2016-08-26 15:23:00', '2016-08-26 15:23:00'),
(271, NULL, 'ip', '112.134.67.54', '2016-08-26 15:23:00', '2016-08-26 15:23:00'),
(272, NULL, 'global', NULL, '2016-08-26 15:25:20', '2016-08-26 15:25:20'),
(273, NULL, 'ip', '112.134.67.54', '2016-08-26 15:25:20', '2016-08-26 15:25:20'),
(274, NULL, 'global', NULL, '2016-08-26 15:27:04', '2016-08-26 15:27:04'),
(275, NULL, 'ip', '112.134.67.54', '2016-08-26 15:27:04', '2016-08-26 15:27:04'),
(276, NULL, 'global', NULL, '2016-08-26 15:27:23', '2016-08-26 15:27:23'),
(277, NULL, 'ip', '112.134.67.54', '2016-08-26 15:27:23', '2016-08-26 15:27:23'),
(278, NULL, 'global', NULL, '2016-08-26 21:20:47', '2016-08-26 21:20:47'),
(279, NULL, 'ip', '220.247.241.228', '2016-08-26 21:20:47', '2016-08-26 21:20:47'),
(280, NULL, 'global', NULL, '2016-08-26 21:20:59', '2016-08-26 21:20:59'),
(281, NULL, 'ip', '220.247.241.228', '2016-08-26 21:20:59', '2016-08-26 21:20:59'),
(282, NULL, 'global', NULL, '2016-08-30 00:06:44', '2016-08-30 00:06:44'),
(283, NULL, 'ip', '112.134.70.22', '2016-08-30 00:06:44', '2016-08-30 00:06:44'),
(284, NULL, 'global', NULL, '2016-09-01 23:04:22', '2016-09-01 23:04:22'),
(285, NULL, 'ip', '112.134.38.97', '2016-09-01 23:04:22', '2016-09-01 23:04:22'),
(286, NULL, 'global', NULL, '2016-09-01 23:04:28', '2016-09-01 23:04:28'),
(287, NULL, 'ip', '112.134.38.97', '2016-09-01 23:04:28', '2016-09-01 23:04:28'),
(288, NULL, 'global', NULL, '2016-09-06 14:29:48', '2016-09-06 14:29:48'),
(289, NULL, 'ip', '202.162.204.61', '2016-09-06 14:29:48', '2016-09-06 14:29:48'),
(290, NULL, 'global', NULL, '2016-09-09 18:59:14', '2016-09-09 18:59:14'),
(291, NULL, 'ip', '123.231.106.251', '2016-09-09 18:59:14', '2016-09-09 18:59:14'),
(292, NULL, 'global', NULL, '2016-09-09 18:59:54', '2016-09-09 18:59:54'),
(293, NULL, 'ip', '123.231.106.251', '2016-09-09 18:59:54', '2016-09-09 18:59:54'),
(294, NULL, 'global', NULL, '2016-09-09 18:59:58', '2016-09-09 18:59:58'),
(295, NULL, 'ip', '123.231.106.251', '2016-09-09 18:59:58', '2016-09-09 18:59:58'),
(296, NULL, 'global', NULL, '2016-09-09 19:00:28', '2016-09-09 19:00:28'),
(297, NULL, 'ip', '123.231.106.251', '2016-09-09 19:00:28', '2016-09-09 19:00:28'),
(298, NULL, 'global', NULL, '2016-09-09 19:01:20', '2016-09-09 19:01:20'),
(299, NULL, 'ip', '123.231.106.251', '2016-09-09 19:01:20', '2016-09-09 19:01:20'),
(300, NULL, 'global', NULL, '2016-09-09 19:01:55', '2016-09-09 19:01:55'),
(301, NULL, 'ip', '123.231.106.251', '2016-09-09 19:01:55', '2016-09-09 19:01:55'),
(302, NULL, 'global', NULL, '2016-09-14 17:52:24', '2016-09-14 17:52:24'),
(303, NULL, 'ip', '112.134.71.51', '2016-09-14 17:52:24', '2016-09-14 17:52:24'),
(304, 1, 'user', NULL, '2016-09-14 17:52:24', '2016-09-14 17:52:24'),
(305, NULL, 'global', NULL, '2016-09-27 00:13:13', '2016-09-27 00:13:13'),
(306, NULL, 'ip', '203.189.188.39', '2016-09-27 00:13:13', '2016-09-27 00:13:13'),
(307, NULL, 'global', NULL, '2016-09-27 00:13:22', '2016-09-27 00:13:22'),
(308, NULL, 'ip', '203.189.188.39', '2016-09-27 00:13:22', '2016-09-27 00:13:22'),
(309, NULL, 'global', NULL, '2016-09-30 17:56:08', '2016-09-30 17:56:08'),
(310, NULL, 'ip', '123.231.111.234', '2016-09-30 17:56:08', '2016-09-30 17:56:08'),
(311, NULL, 'global', NULL, '2016-09-30 17:56:09', '2016-09-30 17:56:09'),
(312, NULL, 'ip', '123.231.111.234', '2016-09-30 17:56:09', '2016-09-30 17:56:09'),
(313, NULL, 'global', NULL, '2016-09-30 18:02:09', '2016-09-30 18:02:09'),
(314, NULL, 'ip', '123.231.111.234', '2016-09-30 18:02:09', '2016-09-30 18:02:09'),
(315, NULL, 'global', NULL, '2016-10-02 03:43:50', '2016-10-02 03:43:50'),
(316, NULL, 'ip', '41.143.55.243', '2016-10-02 03:43:50', '2016-10-02 03:43:50'),
(317, NULL, 'global', NULL, '2016-10-03 21:38:46', '2016-10-03 21:38:46'),
(318, NULL, 'ip', '122.255.11.211', '2016-10-03 21:38:46', '2016-10-03 21:38:46'),
(319, NULL, 'global', NULL, '2016-10-03 21:38:56', '2016-10-03 21:38:56'),
(320, NULL, 'ip', '122.255.11.211', '2016-10-03 21:38:56', '2016-10-03 21:38:56'),
(321, NULL, 'global', NULL, '2018-04-09 05:24:03', '2018-04-09 05:24:03'),
(322, NULL, 'ip', '127.0.0.1', '2018-04-09 05:24:03', '2018-04-09 05:24:03'),
(323, 1, 'user', NULL, '2018-04-09 05:24:03', '2018-04-09 05:24:03'),
(324, NULL, 'global', NULL, '2018-04-09 05:24:13', '2018-04-09 05:24:13'),
(325, NULL, 'ip', '127.0.0.1', '2018-04-09 05:24:13', '2018-04-09 05:24:13'),
(326, 1, 'user', NULL, '2018-04-09 05:24:13', '2018-04-09 05:24:13'),
(327, NULL, 'global', NULL, '2018-04-24 12:09:49', '2018-04-24 12:09:49'),
(328, NULL, 'ip', '127.0.0.1', '2018-04-24 12:09:49', '2018-04-24 12:09:49'),
(329, 1, 'user', NULL, '2018-04-24 12:09:49', '2018-04-24 12:09:49'),
(330, NULL, 'global', NULL, '2018-05-01 03:04:49', '2018-05-01 03:04:49'),
(331, NULL, 'ip', '127.0.0.1', '2018-05-01 03:04:49', '2018-05-01 03:04:49'),
(332, NULL, 'global', NULL, '2018-05-01 03:04:57', '2018-05-01 03:04:57'),
(333, NULL, 'ip', '127.0.0.1', '2018-05-01 03:04:57', '2018-05-01 03:04:57'),
(334, NULL, 'global', NULL, '2018-05-02 07:10:45', '2018-05-02 07:10:45'),
(335, NULL, 'ip', '127.0.0.1', '2018-05-02 07:10:45', '2018-05-02 07:10:45'),
(336, NULL, 'global', NULL, '2018-05-02 07:10:52', '2018-05-02 07:10:52'),
(337, NULL, 'ip', '127.0.0.1', '2018-05-02 07:10:52', '2018-05-02 07:10:52'),
(338, NULL, 'global', NULL, '2018-05-02 12:14:40', '2018-05-02 12:14:40'),
(339, NULL, 'ip', '::1', '2018-05-02 12:14:40', '2018-05-02 12:14:40'),
(340, NULL, 'global', NULL, '2018-05-06 03:30:55', '2018-05-06 03:30:55'),
(341, NULL, 'ip', '127.0.0.1', '2018-05-06 03:30:55', '2018-05-06 03:30:55'),
(342, NULL, 'global', NULL, '2018-05-06 03:31:16', '2018-05-06 03:31:16'),
(343, NULL, 'ip', '127.0.0.1', '2018-05-06 03:31:16', '2018-05-06 03:31:16'),
(344, 1, 'user', NULL, '2018-05-06 03:31:17', '2018-05-06 03:31:17'),
(345, NULL, 'global', NULL, '2018-05-06 04:13:06', '2018-05-06 04:13:06'),
(346, NULL, 'ip', '127.0.0.1', '2018-05-06 04:13:06', '2018-05-06 04:13:06'),
(347, NULL, 'global', NULL, '2018-05-06 04:14:01', '2018-05-06 04:14:01'),
(348, NULL, 'ip', '127.0.0.1', '2018-05-06 04:14:01', '2018-05-06 04:14:01'),
(349, NULL, 'global', NULL, '2018-05-06 04:14:10', '2018-05-06 04:14:10'),
(350, NULL, 'ip', '127.0.0.1', '2018-05-06 04:14:10', '2018-05-06 04:14:10'),
(351, 1, 'user', NULL, '2018-05-06 04:14:10', '2018-05-06 04:14:10'),
(352, NULL, 'global', NULL, '2018-05-06 04:15:01', '2018-05-06 04:15:01'),
(353, NULL, 'ip', '127.0.0.1', '2018-05-06 04:15:01', '2018-05-06 04:15:01'),
(354, NULL, 'global', NULL, '2018-05-06 05:20:25', '2018-05-06 05:20:25'),
(355, NULL, 'ip', '127.0.0.1', '2018-05-06 05:20:25', '2018-05-06 05:20:25'),
(356, NULL, 'global', NULL, '2018-05-06 05:20:43', '2018-05-06 05:20:43'),
(357, NULL, 'ip', '127.0.0.1', '2018-05-06 05:20:43', '2018-05-06 05:20:43'),
(358, NULL, 'global', NULL, '2018-05-09 03:26:12', '2018-05-09 03:26:12'),
(359, NULL, 'ip', '127.0.0.1', '2018-05-09 03:26:12', '2018-05-09 03:26:12'),
(360, NULL, 'global', NULL, '2018-05-10 03:41:39', '2018-05-10 03:41:39'),
(361, NULL, 'ip', '::1', '2018-05-10 03:41:39', '2018-05-10 03:41:39'),
(362, NULL, 'global', NULL, '2018-05-10 03:41:49', '2018-05-10 03:41:49'),
(363, NULL, 'ip', '::1', '2018-05-10 03:41:49', '2018-05-10 03:41:49'),
(364, NULL, 'global', NULL, '2018-05-10 03:41:53', '2018-05-10 03:41:53'),
(365, NULL, 'ip', '::1', '2018-05-10 03:41:53', '2018-05-10 03:41:53'),
(366, NULL, 'global', NULL, '2018-05-10 03:43:34', '2018-05-10 03:43:34'),
(367, NULL, 'ip', '::1', '2018-05-10 03:43:34', '2018-05-10 03:43:34'),
(368, NULL, 'global', NULL, '2018-05-10 03:43:39', '2018-05-10 03:43:39'),
(369, NULL, 'ip', '::1', '2018-05-10 03:43:40', '2018-05-10 03:43:40'),
(370, NULL, 'global', NULL, '2018-05-10 13:15:16', '2018-05-10 13:15:16'),
(371, NULL, 'ip', '112.134.154.218', '2018-05-10 13:15:16', '2018-05-10 13:15:16'),
(372, NULL, 'global', NULL, '2018-05-10 14:25:49', '2018-05-10 14:25:49'),
(373, NULL, 'ip', '112.134.135.67', '2018-05-10 14:25:49', '2018-05-10 14:25:49'),
(374, NULL, 'global', NULL, '2018-05-10 14:26:04', '2018-05-10 14:26:04'),
(375, NULL, 'ip', '112.134.135.67', '2018-05-10 14:26:04', '2018-05-10 14:26:04'),
(376, NULL, 'global', NULL, '2018-05-10 15:47:52', '2018-05-10 15:47:52'),
(377, NULL, 'ip', '112.134.154.218', '2018-05-10 15:47:52', '2018-05-10 15:47:52'),
(378, 30, 'user', NULL, '2018-05-10 15:47:52', '2018-05-10 15:47:52'),
(379, NULL, 'global', NULL, '2018-05-11 11:41:14', '2018-05-11 11:41:14'),
(380, NULL, 'ip', '112.134.135.79', '2018-05-11 11:41:14', '2018-05-11 11:41:14'),
(381, NULL, 'global', NULL, '2018-05-11 11:41:48', '2018-05-11 11:41:48'),
(382, NULL, 'ip', '112.134.135.79', '2018-05-11 11:41:48', '2018-05-11 11:41:48'),
(383, NULL, 'global', NULL, '2018-05-11 11:41:57', '2018-05-11 11:41:57'),
(384, NULL, 'ip', '112.134.135.79', '2018-05-11 11:41:57', '2018-05-11 11:41:57'),
(385, NULL, 'global', NULL, '2018-05-14 12:23:23', '2018-05-14 12:23:23'),
(386, NULL, 'ip', '124.43.72.153', '2018-05-14 12:23:23', '2018-05-14 12:23:23'),
(387, 30, 'user', NULL, '2018-05-14 12:23:23', '2018-05-14 12:23:23'),
(388, NULL, 'global', NULL, '2018-05-14 13:10:18', '2018-05-14 13:10:18'),
(389, NULL, 'ip', '124.43.72.197', '2018-05-14 13:10:18', '2018-05-14 13:10:18'),
(391, NULL, 'global', NULL, '2018-05-14 13:10:23', '2018-05-14 13:10:23'),
(392, NULL, 'ip', '124.43.72.197', '2018-05-14 13:10:23', '2018-05-14 13:10:23'),
(394, NULL, 'global', NULL, '2018-05-14 13:10:34', '2018-05-14 13:10:34'),
(395, NULL, 'ip', '124.43.72.197', '2018-05-14 13:10:34', '2018-05-14 13:10:34'),
(397, NULL, 'global', NULL, '2018-05-14 13:11:08', '2018-05-14 13:11:08'),
(398, NULL, 'ip', '124.43.72.197', '2018-05-14 13:11:08', '2018-05-14 13:11:08'),
(400, NULL, 'global', NULL, '2018-05-14 13:13:34', '2018-05-14 13:13:34'),
(401, NULL, 'ip', '209.95.56.53', '2018-05-14 13:13:34', '2018-05-14 13:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobileNo` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `supervisor_id` int(25) DEFAULT NULL,
  `lft` int(25) DEFAULT NULL,
  `rgt` int(25) DEFAULT NULL,
  `depth` int(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `mobileNo`, `password`, `permissions`, `last_login`, `supervisor_id`, `lft`, `rgt`, `depth`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super', 'Administrator', 'super.admin', 'admin@admin.lk', 0, '$2y$10$vJ0/.9l8qByoN/ZFJlzew.U3SUrYnsI6QoPezSfeo9qDQYLJSjC/O', '{\"admin\":true,\"index\":true}', '2018-05-14 08:23:21', NULL, 1, 12, 0, 1, '2015-07-11 00:39:31', '2018-05-14 13:22:45', NULL),
(25, 'admin', 'site', 'siteadmin', 'siteadmin@gmail.com', 77151893, '$2y$10$3qp/os5VVqEwGiq6nG/9EORWbs5daOZ7zLtqwgmCTAauCP3mLNxR6', NULL, '2018-05-15 04:47:53', 1, 2, 3, 1, 1, '2018-05-03 12:51:02', '2018-05-15 04:47:53', NULL),
(28, 'Test', 'User 001', 'testuser001', 'thilina25091987@gmail.com', 769035062, '$2y$10$GN.TTqzUe/K/1E8d4w2kHe0JX520.rS.JrYfDTKfjiwI2nhr3MmhC', NULL, '2018-05-10 15:43:37', 1, 4, 7, 1, 1, '2018-05-10 15:36:16', '2018-05-14 13:19:51', NULL),
(30, 'Test', 'User002', 'testuser002', 'nimeshgayanga@gmail.com', 769035062, '$2y$10$RG/e9Y4tYczM04aZGbz6FeWytgaVN3XVEQag7nPm/fv9IwQqrPusa', NULL, '2018-05-15 04:51:25', 28, 5, 6, 2, 1, '2018-05-10 15:39:10', '2018-05-15 04:51:25', NULL),
(33, 'Test', 'User03', 'testuser003', 'kandu@mail.com', 775997607, '$2y$10$JfJz0HQmR5.WYbcP66DvluZUunNhJ/w3lmzGMylOwEsU5eJZOCIA.', NULL, NULL, 1, 8, 9, 1, 1, '2018-05-14 13:22:12', '2018-05-14 13:22:12', NULL),
(34, 'Test', 'User04', 'testuser004', 'kandus@mail.com', 775997607, '$2y$10$hDmw0WVU0RYzzqVt4a/qc.3MfkTE3kDKpp/ZykZREo5obf.ckqy4O', NULL, '2018-05-15 03:08:59', 1, 10, 11, 1, 1, '2018-05-14 13:22:45', '2018-05-15 03:08:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_request`
--
ALTER TABLE `assignment_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `common`
--
ALTER TABLE `common`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fonts-list`
--
ALTER TABLE `fonts-list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open`
--
ALTER TABLE `open`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persistences`
--
ALTER TABLE `persistences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `persistences_code_unique` (`code`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- Indexes for table `throttle`
--
ALTER TABLE `throttle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `throttle_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activations`
--
ALTER TABLE `activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `assignment_request`
--
ALTER TABLE `assignment_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `common`
--
ALTER TABLE `common`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fonts-list`
--
ALTER TABLE `fonts-list`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=594;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `open`
--
ALTER TABLE `open`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `persistences`
--
ALTER TABLE `persistences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=482;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `throttle`
--
ALTER TABLE `throttle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=402;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
