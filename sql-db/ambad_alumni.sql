-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 09, 2024 at 01:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ambad_alumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `id` int(11) NOT NULL,
  `full_name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `city` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`id`, `full_name`, `email`, `mobile`, `city`, `subject`, `message`, `created_date`) VALUES
(1, 'Vitthal Test', 'vitthal.bhurule@gmail.com', 9090909090, 'Pune', 'Live Test Subject', 'Live Test Subject Message Live Test Subject', '2022-08-26 05:41:03'),
(2, 'Ajay Kotambe', 'ajaykotambe07@gmail.com', 9172847061, 'Paithan', '', '', '2022-12-21 05:00:49'),
(3, 'Mahesh T', 'mst@gmail.com', 9011223344, 'Pune', 'Test', 'Test', '2023-12-23 14:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `user_type` enum('Admin','Student') NOT NULL DEFAULT 'Student',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `user_type`, `username`, `password`, `is_active`, `created_at`) VALUES
(1, 'Admin', 'admin', '123', 'Y', '2024-03-09 17:18:49'),
(2, 'Student', 'Mahesh', '123', 'Y', '2024-03-09 17:18:49'),
(3, 'Student', 'vitthalb@cybage.com', 'test', 'Y', '2024-03-09 17:41:16'),
(4, 'Student', 'test', 'test', 'Y', '2024-03-09 17:48:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
