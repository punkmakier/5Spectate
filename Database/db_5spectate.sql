-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 05:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_5spectate`
--

-- --------------------------------------------------------

--
-- Table structure for table `compliancefeedback`
--

CREATE TABLE `compliancefeedback` (
  `id` int(11) NOT NULL,
  `ComplyID` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Filename` text NOT NULL,
  `isViewed` int(5) NOT NULL DEFAULT 0,
  `SubmitedBy` varchar(250) NOT NULL,
  `Feedback` text NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `LastUpdate` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compliancefeedback`
--

INSERT INTO `compliancefeedback` (`id`, `ComplyID`, `Description`, `Filename`, `isViewed`, `SubmitedBy`, `Feedback`, `DateCreated`, `LastUpdate`) VALUES
(16, '6451214dba9eb', 'Please re-evaluate since this is fix.', 'submitnoncomply645125c8859639.54349755.png', 1, ' ', 'Ok this is fix.', '2023-05-02 23:01:28', '2023-05-02 15:05:52.582182'),
(18, '6451214dba9eb', 'test remarks', 'submitnoncomply64512691205736.74468294.png', 1, ' ', 'Ok this is fix.', '2023-05-02 23:04:49', '2023-05-02 15:05:52.582182'),
(19, '64512e7e30e5e', 'Please mr/ms auditor re-evaluate our books, We have now bookshelves and its already organize.', 'submitnoncomply645130461a96e4.62516453.png', 1, ' ', 'test', '2023-05-02 23:46:14', '2023-05-02 15:52:11.374559'),
(20, '64512e7e30e5e', 'Please again twice attempt, to evaluate our bookshelves', 'submitnoncomply64513189a6f149.31034355.png', 1, ' ', 'test', '2023-05-02 23:51:37', '2023-05-02 15:52:11.374559');

-- --------------------------------------------------------

--
-- Table structure for table `evaluated_form`
--

CREATE TABLE `evaluated_form` (
  `id` int(11) NOT NULL,
  `UnqiueKeyID` varchar(150) NOT NULL,
  `form_id` varchar(250) NOT NULL,
  `room_id` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `FileName` text NOT NULL,
  `Status` varchar(25) NOT NULL DEFAULT 'Pending',
  `AuditorName` varchar(50) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evaluated_form`
--

INSERT INTO `evaluated_form` (`id`, `UnqiueKeyID`, `form_id`, `room_id`, `Type`, `Description`, `FileName`, `Status`, `AuditorName`, `DateCreated`) VALUES
(42, '', '101', 'PhysicsDept', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 22:40:29'),
(43, '6451214dba9eb', '102', 'PhysicsDept', 'NonComplying', 'Test Compliance Feedback from AUDIT', 'noncomply6451214dba9f34.44050932.png', 'Resolve', 'Test Dev', '2023-05-02 16:42:21'),
(44, '', '103', 'PhysicsDept', 'NA', '', '', 'Pending', 'Test Dev', '2023-05-02 22:42:39'),
(45, '6451216ebb8f7', '104', 'PhysicsDept', 'NonComplying', 'test', 'noncomply6451216ebb8fe4.09281488.png', 'Pending', 'Test Dev', '2023-05-01 16:42:54'),
(46, '', '105', 'PhysicsDept', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 22:42:58'),
(47, '', '101', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:17:08'),
(48, '', '102', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:17:10'),
(49, '', '103', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:17:13'),
(50, '', '104', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:17:17'),
(51, '', '105', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:17:20'),
(52, '', '201', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:18:16'),
(53, '', '202', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:18:20'),
(54, '', '203', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:18:23'),
(55, '', '204', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:18:36'),
(56, '', '301', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:18:42'),
(57, '', '302', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:18:45'),
(58, '', '303', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:18:49'),
(59, '', '304', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:18:53'),
(60, '', '305', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:18:56'),
(61, '', '401', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:19:05'),
(62, '', '402', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:19:35'),
(63, '', '403', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:19:41'),
(64, '', '404', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:19:45'),
(65, '', '501', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:19:47'),
(66, '', '502', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:19:51'),
(67, '', '503', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:19:53'),
(68, '', '504', 'FacultyRoom', 'Complying', '', '', 'Pending', 'Test Dev', '2023-05-02 23:19:55'),
(69, '64512e7e30e5e', '404', 'PhysicsDept', 'NonComplying', 'Your books are not organize on your department. I want you to fix this', 'noncomply64512e7e30e6a3.83501088.png', 'Resolve', 'Test Dev', '2023-05-02 17:38:38');

-- --------------------------------------------------------

--
-- Table structure for table `submitted_supportsystem`
--

CREATE TABLE `submitted_supportsystem` (
  `id` int(11) NOT NULL,
  `UniqueKeyID` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Filename` text NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submitted_supportsystem`
--

INSERT INTO `submitted_supportsystem` (`id`, `UniqueKeyID`, `Description`, `Filename`, `DateCreated`) VALUES
(7, '6451245b6591e', 'This is fixed.', 'maintenancefeedback6451255ea8dfc6.92750903.png', '2023-05-02 22:59:42'),
(8, '64512f252af2b', 'Booksheleve has been delivered to Physics Departmen', 'maintenancefeedback64512ff9883196.50188430.png', '2023-05-02 23:44:57'),
(9, '64513125602e8', 'Fixed', 'maintenancefeedback64513166f1bb75.30585469.png', '2023-05-02 23:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `supportsystem`
--

CREATE TABLE `supportsystem` (
  `id` int(11) NOT NULL,
  `UniqueKeyID` varchar(50) NOT NULL,
  `SendTo` varchar(150) NOT NULL,
  `Description` text NOT NULL,
  `Filename` text NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'Pending',
  `TeacherName` varchar(150) NOT NULL,
  `TeacherID` varchar(50) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `LastUpdate` datetime NOT NULL,
  `UpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supportsystem`
--

INSERT INTO `supportsystem` (`id`, `UniqueKeyID`, `SendTo`, `Description`, `Filename`, `Status`, `TeacherName`, `TeacherID`, `Department`, `DateCreated`, `LastUpdate`, `UpdatedBy`) VALUES
(10, '6451245b6591e', 'Maintenance', 'Please help fix school window.', 'supportsystem6451245b6592d5.55642761.png', 'Resolve', ' ', '64511f2568b1c', 'Physics Department', '2023-05-02 22:55:23', '2023-05-02 22:59:42', ' '),
(11, '64512f252af2b', 'Maintenance', 'I need bookshelves to organize my books', 'supportsystem64512f252af3c6.04516168.png', 'Resolve', ' ', '64511f2568b1c', 'Physics Department', '2023-05-02 23:41:25', '2023-05-02 23:44:57', ' '),
(12, '64513125602e8', 'Maintenance', 'Please gawa kayo ng bagong booksheleves tapos yung kahoy materials is hindi inaanay.', 'supportsystem64513125602ee7.31235961.png', 'Resolve', ' ', '64511f2568b1c', 'Physics Department', '2023-05-02 23:49:57', '2023-05-02 23:51:02', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `UserType` varchar(50) NOT NULL,
  `Firstname` varchar(150) NOT NULL,
  `Middlename` varchar(150) NOT NULL,
  `Lastname` varchar(150) NOT NULL,
  `ProfessionID` varchar(150) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `isRegistered` int(11) NOT NULL DEFAULT 0,
  `RoomInCharge` varchar(150) NOT NULL,
  `LastUpdate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `UserID`, `Username`, `Password`, `UserType`, `Firstname`, `Middlename`, `Lastname`, `ProfessionID`, `DateCreated`, `isRegistered`, `RoomInCharge`, `LastUpdate`) VALUES
(1, '644bc329cb607', 'admin', '123123', 'Auditor', 'Test', '', 'Dev', '', '2023-04-28 20:59:21', 1, '', ''),
(7, '64511f2568b1c', 'testTeacher', '123123', 'Teacher', '', '', '', '', '2023-05-02 22:33:09', 1, 'PhysicsDept', ''),
(8, '6451249a5fafb', 'testMaintenance', '123123', 'Maintenance', '', '', '', '', '2023-05-02 22:56:26', 1, '- Select -', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compliancefeedback`
--
ALTER TABLE `compliancefeedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluated_form`
--
ALTER TABLE `evaluated_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submitted_supportsystem`
--
ALTER TABLE `submitted_supportsystem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supportsystem`
--
ALTER TABLE `supportsystem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compliancefeedback`
--
ALTER TABLE `compliancefeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `evaluated_form`
--
ALTER TABLE `evaluated_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `submitted_supportsystem`
--
ALTER TABLE `submitted_supportsystem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `supportsystem`
--
ALTER TABLE `supportsystem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
