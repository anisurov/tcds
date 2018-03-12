-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 18, 2018 at 06:30 PM
-- Server version: 5.7.20-ndb-7.6.4
-- PHP Version: 7.0.25-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcds`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(10) NOT NULL,
  `courseName` varchar(450) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `courseCredit` float DEFAULT NULL,
  `courseType` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `courseIdentity` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactHrs` int(50) NOT NULL,
  `season` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `courseName`, `courseCredit`, `courseType`, `courseIdentity`, `contactHrs`, `season`, `semester`) VALUES
(1, 'Computer Fundamentals', 2, 'core', 'CSE-1101', 2, 'Spring', 1),
(2, 'Computer Fundamentals sessional', 1, 'core', 'CSE-1102', 2, 'Spring', 1),
(3, 'Basic Electrical Engineering', 3, 'core', 'EEE-1105', 3, 'Spring', 1),
(4, 'Basic Electrical Engineering sessional', 1, 'core', 'EEE-1106', 2, 'Spring', 1),
(5, 'Advanced English', 1, 'indp', 'UREL-1103', 3, 'Spring', 1),
(6, 'Islamic Aqidah	', 1, 'urem', 'URIS-1101', 1, 'Spring', 1),
(7, 'Engineering Drawing', 1, 'core', 'CE-1202', 2, 'Spring', 2),
(8, 'Structured Programming', 3, 'core', ' CSE-1201', 3, 'Spring', 2),
(9, 'Structured Programming Sessional ', 2, 'core', 'CSE-1202', 3, 'Spring', 2),
(10, 'Discrete Mathematics', 3, 'core', 'CSE-1203', 3, 'Spring', 2),
(11, 'Statistics', 2, 'indp', 'STAT-1201', 2, 'Spring', 2),
(12, 'Introduction to Ibadah', 1, 'urem', ' URIS – 1203', 1, 'Spring', 2),
(13, 'Computer Programming I', 3, 'core', 'CSE-1121	', 3, 'Autumn', 1),
(14, ' Computer Programming I Lab', 2, 'core', 'CSE-1122	', 3, 'Autumn', 1),
(15, 'Basic Electrical Engineering', 3, 'core', 'EEE-1121	', 3, 'Autumn', 1),
(16, 'Basic Electrical Engineering Lab', 2, 'core', ' EEE-1122', 3, 'Autumn', 1),
(17, 'Mathematics I ', 3, 'indp', 'MATH-1107', 3, 'Autumn', 1),
(18, 'Physics I', 3, 'indp', 'PHY-1101', 3, 'Autumn', 1),
(19, 'Advanced English', 2, 'indp', 'UREL-1106	', 3, 'Autumn', 1),
(20, 'Text of Ethics and Morality', 1, 'urem', 'UREM-1101', 2, 'Autumn', 1),
(25, 'Physics II (Electromagnetism, Optics and Modern Physics)', 3, 'core', 'PHY-1201', 3, 'Autumn', 2),
(26, 'Structured Programming', 3, 'core', 'CSE-1201', 3, 'Autumn', 2),
(27, 'Chemistry', 3, 'core', 'CHEM-2301', 3, '', 3),
(28, 'Object Oriented Programming I', 3, 'core', 'CSE-2301', 3, '', 3),
(29, 'Mathematics III (Ordinary and Partial Differential Equations )', 3, 'indp', 'MATH-2301', 3, '', 3),
(30, 'Introduction to Quran and Sunnah', 1, 'urem', ' URIS – 2303', 2, '', 3),
(33, 'Computer Programming I', 3, 'core', 'CSE-1121', 3, NULL, NULL),
(34, 'Computer Programming I Lab', 2, 'core', 'CSE-1122', 3, NULL, NULL),
(35, 'Object Oriented Programming II', 2, 'core', 'CSE-2401', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_alloted_to_teacher`
--

CREATE TABLE `course_alloted_to_teacher` (
  `calt_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `course_id` int(10) NOT NULL,
  `t_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_in_current_semester`
--

CREATE TABLE `course_in_current_semester` (
  `cis_id` int(10) NOT NULL,
  `course_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('dhqnero@gmail.com', '$2y$10$nFyjs3vXdumSd/wpAYtlfepaii50S93PtNRDUP7FEMPEYsULZLz2q', '2017-12-17 10:45:24');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `sectionName` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `semesterName` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startingDate` date DEFAULT NULL,
  `endingDate` date DEFAULT NULL,
  `semesterStatus` varchar(45) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `t_id` int(10) NOT NULL,
  `t_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_designation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `joining_date` date NOT NULL,
  `promotion_date` date DEFAULT NULL,
  `type` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t_image` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`t_id`, `t_name`, `t_email`, `t_designation`, `joining_date`, `promotion_date`, `type`, `t_image`) VALUES
(2, 'Md Saifur Rahman', 'msrs312@gmail.com', 'Professor', '2017-12-30', NULL, NULL, 'tcds_img__24_12_2017_5_20663643_10207399679308740_1356822391149401725_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `check` int(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `check`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$Uor38/YKwKYczHDDwbLsyenX6kPvCKikFR/ybbhMVaPEzBI12e0Qy', 'pyF5BZbKO5RzL8Eeu4rmVwxDQiL4jpnlxJvAaSbU5BCCofhQEhKxQnB5gJdt', '2017-12-14 21:33:33', '2017-12-14 21:33:33', 0),
(2, 'Md Saifur Rahman', 'msrs312@gmail.com', '$2y$10$g8kFQXKlBp0tpafD92hxvuaa36msyrqlWRXC3yENw.WR5nxwj450G', 'LvdxpLAJnxwokr1dkuU0aXn1mgNVGMnrjqZbV2tVR8o8a26A3feS1vyiPiX7', '2017-12-24 11:49:16', '2017-12-24 11:49:16', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `courseIdentity_UNIQUE` (`courseIdentity`);

--
-- Indexes for table `course_alloted_to_teacher`
--
ALTER TABLE `course_alloted_to_teacher`
  ADD PRIMARY KEY (`calt_id`),
  ADD KEY `fk_t_id_idx` (`t_id`);

--
-- Indexes for table `course_in_current_semester`
--
ALTER TABLE `course_in_current_semester`
  ADD PRIMARY KEY (`cis_id`),
  ADD UNIQUE KEY `course_id_UNIQUE` (`course_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`semester_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`t_id`),
  ADD UNIQUE KEY `t_email` (`t_email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `t_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
