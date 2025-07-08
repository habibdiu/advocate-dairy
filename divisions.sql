-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2025 at 06:58 AM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bapidip_web_app_25`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(11) NOT NULL,
  `name_en` text,
  `name_bn` text,
  `priority` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name_en`, `name_bn`, `priority`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', 'ঢাকা', 0, 1, '2025-07-01 05:33:55', '2025-07-01 16:46:21'),
(2, 'Rajshahi', 'রাজশাহী', 0, 1, '2025-07-01 05:33:55', '2025-07-01 16:46:36'),
(3, 'Chattogram', 'চট্টগ্রাম', 0, 1, '2025-07-01 05:33:55', '2025-07-01 16:48:44'),
(4, 'Sylhet', 'সিলেট', 0, 1, '2025-07-01 05:33:55', '2025-07-01 16:49:09'),
(5, 'Khulna', 'খুলনা', 0, 1, '2025-07-01 05:33:55', '2025-07-01 16:47:45'),
(6, 'Barisal', 'বরিশাল', 0, 1, '2025-07-01 05:33:55', '2025-07-01 16:49:49'),
(7, 'Rangpur', 'রংপুর', 0, 1, '2025-07-01 05:33:55', '2025-07-01 16:50:18'),
(8, 'Mymensingh', 'ময়মনসিংহ', 0, 1, '2025-07-01 05:33:55', '2025-07-01 16:50:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
