-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2023 at 09:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `created_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `created_on`) VALUES
(3, 'admin', 'admin', 'Czarina Joy', 'Evangelista', '2023-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL,
  `time_out` time NOT NULL,
  `num_hr` double NOT NULL,
  `start_break` time NOT NULL,
  `end_break` time NOT NULL,
  `salary` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `time_in`, `status`, `time_out`, `num_hr`, `start_break`, `end_break`, `salary`) VALUES
(263, '1', '2023-04-11', '08:05:00', 0, '16:55:00', 0, '12:00:00', '13:05:00', '345'),
(264, '2', '2023-04-11', '08:10:00', 0, '16:00:00', 0, '12:00:00', '13:15:00', '275'),
(265, '1', '2023-04-12', '08:23:38', 0, '16:45:00', 0, '12:00:00', '13:05:00', '317'),
(266, '2', '2023-04-16', '09:00:00', 0, '16:00:00', 0, '12:00:00', '13:00:00', '240'),
(267, '3', '2023-04-22', '09:00:00', 0, '15:00:00', 0, '12:00:00', '13:20:00', '160'),
(268, '3', '2023-04-12', '08:00:00', 0, '16:40:00', 0, '12:00:00', '13:00:00', '340'),
(269, '2', '2023-04-12', '08:00:00', 0, '17:00:00', 0, '12:00:00', '13:00:00', '360'),
(270, '3', '2023-04-11', '08:00:00', 0, '17:00:00', 0, '12:00:00', '13:05:00', '355'),
(272, '1', '2023-04-16', '09:00:00', 0, '16:35:00', 0, '12:00:00', '13:00:00', '275'),
(273, '3', '2023-04-16', '08:00:00', 0, '17:00:00', 0, '12:00:00', '13:10:00', '350');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `created_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `firstname`, `lastname`, `position_id`, `schedule_id`, `created_on`) VALUES
(5, '1', 'Czarina Joy', 'Evangelista', 1, 1, '0000-00-00'),
(6, '2', 'Jerron', 'Urbanozo', 1, 1, '2023-04-03'),
(8, '3', 'Lance', 'Zalamea', 0, 0, '2023-04-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
