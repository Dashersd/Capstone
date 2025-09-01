-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2025 at 03:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `action_type` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `admin_account` varchar(255) NOT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `action_type`, `datetime`, `admin_account`, `student_id`, `details`) VALUES
(1, 'Payments', '2025-07-05 08:35:47', 'unknown', '00006', 'Amount: 1000.00\nPayment Type: Full Payment\nStatus: Active\nDiscount: 500.00'),
(2, 'Payments', '2025-07-05 08:40:13', 'Jupay', '00007', 'Amount: 3000.00\nPayment Type: Advance Payment\nStatus: Active\nDiscount: 0.00'),
(3, 'Enrollment (Approval)', '2025-07-05 08:41:28', 'Jupay', 'STD-00010', 'Enrolled (Approved)'),
(4, 'Enrollment (Approval)', '2025-07-05 08:53:18', 'helmandacuma5', 'STD-00011', 'Enrolled (Approved)'),
(5, 'Payments', '2025-07-05 09:00:30', 'helmandacuma5', '0008', 'Amount: 1500.00\nPayment Type: Full Payment\nStatus: Active\nDiscount: 0.00'),
(6, 'Student Enrollment', '2025-07-05 09:03:54', 'helmandacuma5', 'STD-00042', 'Enrolled student: Hasmin Arsenal'),
(7, 'Payments', '2025-07-06 12:33:05', 'Mr.Mars', '00042', 'Amount: 1500.00\nPayment Type: Full Payment\nStatus: Active\nDiscount: 500.00'),
(8, 'Student Enrollment', '2025-07-06 12:34:27', 'Mr.Mars', 'STD-00043', 'Enrolled student: Art Jade'),
(9, 'Enrollment (Approval)', '2025-07-06 12:44:58', 'Mr.Mars', 'STD-00012', 'Enrolled (Approved)'),
(10, 'Payments', '2025-07-06 12:53:39', 'Mr.Mars', '00043', 'Amount: 500.00\nPayment Type: Full Payment\nStatus: Active\nDiscount: 1000.00'),
(11, 'Payments', '2025-07-06 12:56:35', 'Mr.Mars', '00011', 'Amount: 500.00\nPayment Type: Full Payment\nStatus: Active\nDiscount: 1000.00'),
(12, 'Payments', '2025-07-06 14:30:46', 'Mr.Mars', '00012', 'Amount: 1000.00\nPayment Type: Full Payment\nStatus: Inactive\nDiscount: 500.00'),
(13, 'Student Enrollment', '2025-07-08 10:45:42', 'unknown', 'STD-00045', 'Enrolled student: Jonel Ebol'),
(14, 'Payments', '2025-07-08 10:46:37', 'unknown', '	00045', 'Amount: 500.00\nPayment Type: Full Payment\nStatus: Active\nDiscount: 1000.00'),
(15, 'Student Enrollment', '2025-07-08 11:35:12', 'unknown', 'STD-00046', 'Enrolled student: Regien'),
(16, 'Payments', '2025-07-08 11:36:03', 'unknown', '	00046', 'Amount: 500.00\nPayment Type: Postponed Payment\nStatus: Inactive\nDiscount: 1000.00'),
(17, 'Student Enrollment', '2025-08-10 20:23:51', 'unknown', 'STD-00048', 'Enrolled student: Helman Dacuma');

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `email`, `username`, `password`) VALUES
(1, 'mars@gmail.com', 'Mr.Mars', '$2y$10$bj2TuZzvyBVU5Kc/GWnvx.G3zXMHElokV04wNpg9FPJ3XgRLfvrBG');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_requests`
--

CREATE TABLE `enrollment_requests` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `school` varchar(100) DEFAULT NULL,
  `belt_rank` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `parent_name` varchar(255) DEFAULT NULL,
  `parent_phone` varchar(50) DEFAULT NULL,
  `parent_email` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `jeja_no` varchar(20) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `date_paid` date NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `discount` varchar(50) DEFAULT '-',
  `date_enrolled` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(500) DEFAULT NULL,
  `category` enum('achievement','event','achievement_event') NOT NULL,
  `post_date` date NOT NULL,
  `status` enum('active','archived') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `image_path`, `category`, `post_date`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Gojo saturo', 'HAHAHA!', 'uploads/posts/68578bdb8d021.jfif', 'achievement', '2025-06-10', 'active', '2025-06-22 04:51:39', '2025-06-22 04:51:39'),
(4, 'Ace', 'Portgas D. Ace', 'uploads/posts/68578f985e06f.png', 'achievement_event', '2025-06-20', 'archived', '2025-06-22 05:07:36', '2025-06-24 14:38:50'),
(6, 'Robi Chan', 'Haii!!!', 'uploads/posts/6857905ddbab0.jfif', 'achievement_event', '2025-06-22', 'archived', '2025-06-22 05:10:53', '2025-06-24 14:38:45'),
(7, 'Alien', 'Asad', 'uploads/posts/6857982bcaf46.png', 'event', '2025-06-22', 'active', '2025-06-22 05:44:11', '2025-06-22 05:44:11'),
(8, 'Wafu', 'LALA', 'uploads/posts/685a8f29b56bf.png', 'achievement', '2025-06-24', 'active', '2025-06-24 11:39:17', '2025-06-24 11:42:33'),
(9, 'Wala lng ', 'GWapo!!!', 'uploads/posts/685f59f057267.png', 'event', '2025-06-30', 'active', '2025-06-28 02:56:48', '2025-06-28 02:56:48'),
(10, 'sagunsa', 'basta', 'uploads/posts/6864a0a99b663.png', 'event', '2025-07-02', 'active', '2025-07-02 02:59:53', '2025-07-02 02:59:53'),
(11, 'Hello', 'hello wrorld', 'uploads/posts/68b4287f347d6.jpg', 'achievement', '2025-08-31', 'active', '2025-08-31 10:48:31', '2025-08-31 10:48:31');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `parents_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `parent_phone` varchar(20) NOT NULL,
  `school` varchar(100) NOT NULL,
  `class` varchar(50) NOT NULL,
  `parent_email` varchar(100) NOT NULL,
  `belt_rank` varchar(50) NOT NULL,
  `enroll_type` varchar(50) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `trial_payment` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `jeja_no` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `school` varchar(50) DEFAULT NULL,
  `parent_name` varchar(100) DEFAULT NULL,
  `parent_phone` varchar(20) DEFAULT NULL,
  `parent_email` varchar(100) DEFAULT NULL,
  `belt_rank` varchar(20) NOT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `schedule` varchar(20) NOT NULL,
  `date_enrolled` date DEFAULT curdate(),
  `status` varchar(20) DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `jeja_no`, `full_name`, `address`, `phone`, `email`, `school`, `parent_name`, `parent_phone`, `parent_email`, `belt_rank`, `discount`, `schedule`, `date_enrolled`, `status`, `created_at`, `updated_at`) VALUES
(48, 'STD-00048', 'Helman Dacuma', 'Lapuyan', '09975640228', 'helmandacuma5@gmail.com', 'SCC', 'Elsie Dacuma', '09975640228', 'elsie@gmail.con', '0', 300.00, 'MWF-PM', '2025-08-10', 'Active', '2025-08-10 12:23:51', '2025-08-10 12:23:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','super_admin') DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `user_type`, `created_at`) VALUES
(2, 'admin', 'helmandashelle.dacuma@sccpag.edu.ph', 'helmandashelle.dacuma', 'admin123', 'admin', '2025-06-03 23:03:14'),
(3, 'Dash', 'helmandacuma5@gmail.com', 'helmandacuma5', 'admin123', 'admin', '2025-06-03 23:20:52'),
(4, 'Helman', 'helmandash@gmail.com', 'helmandash', '$2y$10$.HENFXZvvZ318qUt2zbwQOrNaFviynjHYKtpHHBJyaJfKBEprmcHe', 'admin', '2025-06-13 00:51:37'),
(5, 'Jupay', 'jupay@gmail.com', 'Jupay', 'YAMY@M143', 'admin', '2025-06-17 10:46:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `enrollment_requests`
--
ALTER TABLE `enrollment_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jeja_no` (`jeja_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrollment_requests`
--
ALTER TABLE `enrollment_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
