-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 06:54 AM
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
-- Database: `advocate_diary`
--

-- --------------------------------------------------------

--
-- Table structure for table `advocates`
--

CREATE TABLE `advocates` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `barcouncil_sonod_no` varchar(500) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `password` varchar(500) NOT NULL,
  `photo` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `case_limit` int(11) DEFAULT NULL,
  `storage_limit` varchar(500) DEFAULT NULL,
  `api_secret_key` text DEFAULT NULL,
  `sms_username` text DEFAULT NULL,
  `sms_password` text DEFAULT NULL,
  `active_status` tinyint(4) DEFAULT NULL COMMENT '1=yes,2=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advocates`
--

INSERT INTO `advocates` (`id`, `name`, `barcouncil_sonod_no`, `email`, `password`, `photo`, `start_date`, `end_date`, `case_limit`, `storage_limit`, `api_secret_key`, `sms_username`, `sms_password`, `active_status`, `created_at`, `updated_at`) VALUES
(7, 'Adv Atikur Rahman', 'mf-100', 'maruf@gmail.com', '$2y$12$KPKCujVuKXX6Vxb3/yDVcuvi7qnra5mbK0ednyBIYyYyx6Cvv7KZ6', 'backend_assets/images/advocates/6649956c635cb.jpg', '2024-05-02', '2024-06-28', 100, '500', '33f6e375621f54cb9995b23036d2fe162f96569a', 'maruf', '$2y$12$auolm3Dl6hJWCHpOCBIP7OOE/W5unq8EOi2WmzaPaN5qvnaxg/laG', 1, '2024-05-19 00:00:12', '2024-06-02 21:57:37'),
(8, 'somrat', 'sm-100', 'somrat@gmail.com', '$2y$12$qeXbPYFCtaSrOfbzt75dSOOfFlqgJ78dzXjjO9Fqh0/aZw.Rj1byu', 'backend_assets/images/advocates/6649959031054.jpg', '2024-05-07', '2024-08-28', 100, '500', NULL, 'somrat', '$2y$12$CYTvDHFcMzZ0OCIWJk1G9epkt8csKXCEz8dx8vPktyR5DZzXUsr22', 1, '2024-05-19 00:00:48', '2024-05-19 04:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(255) DEFAULT NULL,
  `advocate_id` int(11) DEFAULT NULL,
  `case_number` text DEFAULT NULL,
  `serial_number` varchar(500) DEFAULT NULL,
  `case_type` varchar(250) DEFAULT NULL,
  `court_type` varchar(250) DEFAULT NULL,
  `court_name` varchar(255) DEFAULT NULL,
  `my_side` tinyint(4) DEFAULT NULL COMMENT '1=badi,2=bibadi',
  `badi_name` varchar(500) DEFAULT NULL,
  `badi_phone` varchar(20) DEFAULT NULL,
  `bibadi_name` varchar(250) DEFAULT NULL,
  `bibadi_phone` varchar(20) DEFAULT NULL,
  `case_start_date` date DEFAULT NULL,
  `case_details` longtext DEFAULT NULL,
  `case_status` varchar(10) DEFAULT NULL COMMENT 'closed/running',
  `case_close_date` date DEFAULT NULL,
  `mohuri_name` varchar(250) DEFAULT NULL,
  `changed_case_no_1` varchar(500) DEFAULT NULL,
  `changed_case_no_2` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `unique_id`, `advocate_id`, `case_number`, `serial_number`, `case_type`, `court_type`, `court_name`, `my_side`, `badi_name`, `badi_phone`, `bibadi_name`, `bibadi_phone`, `case_start_date`, `case_details`, `case_status`, `case_close_date`, `mohuri_name`, `changed_case_no_1`, `changed_case_no_2`, `created_at`, `updated_at`) VALUES
(9, 'azdfk3tk510954', 2, 'NH1-200', '100', '', 'supreme', 'Dhaka Supreme court', 1, 'samrat', '01752345678', 'sabah', '0134567872', '2024-05-01', 'murder was happened yesterday', 'closed', '2024-05-11', 'Wahid', '2', NULL, '2024-05-12 10:17:58', '2024-05-12 10:23:07'),
(11, 'vnsvvwnfupnkf', 7, 'NH1-300', '1001', 'robery', 'judge', 'Dhaka Supreme court', 1, 'rafi', '01752345678', 'sabah', '0134567872', '2024-05-01', 'murder was happened yesterday', 'running', '2024-05-11', 'Wahid', '2', NULL, '2024-05-19 06:08:02', '2024-05-19 06:10:55'),
(12, NULL, 7, NULL, '12155', 'murder', 'supreme', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-03 03:40:41', '2024-06-03 03:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `case_dates`
--

CREATE TABLE `case_dates` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(255) DEFAULT NULL,
  `advocate_id` int(11) DEFAULT NULL,
  `running_date` date DEFAULT NULL,
  `next_date` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `case_dates`
--

INSERT INTO `case_dates` (`id`, `unique_id`, `advocate_id`, `running_date`, `next_date`, `reason`, `created_at`, `updated_at`) VALUES
(6, 'azdfk3tk510954', 7, '2024-05-01', '2024-05-01', NULL, '2024-05-12 10:39:43', '2024-05-12 10:39:43'),
(8, 'azdfk3tk510954', 7, '2024-07-01', '2024-05-13', 'I do know', '2024-05-19 06:15:01', '2024-05-19 06:22:52'),
(9, 'vnsvvwnfupnkf', 7, '2024-07-01', '2024-05-17', 'I don\'t know', '2024-05-19 06:16:37', '2024-05-19 06:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `libraries`
--

CREATE TABLE `libraries` (
  `id` int(11) NOT NULL,
  `advocate_id` int(11) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `title` text DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL COMMENT 'in KB',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `libraries`
--

INSERT INTO `libraries` (`id`, `advocate_id`, `issue_date`, `title`, `file_path`, `file_size`, `created_at`, `updated_at`) VALUES
(3, 7, '2024-07-11', 'my cases section 23', 'backend_assets/library_file/66541259ba593.xlsx', 8265, '2024-05-27 04:54:28', '2024-05-27 04:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `racks`
--

CREATE TABLE `racks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rack_name` varchar(255) NOT NULL,
  `unique_id` varchar(255) DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0 COMMENT 'max are top',
  `insert_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `racks`
--

INSERT INTO `racks` (`id`, `rack_name`, `unique_id`, `priority`, `insert_by`, `created_at`, `updated_at`) VALUES
(2, 'rack 1', '7hcsdbdba', 52, 7, '2024-06-01 04:42:24', '2024-06-01 04:42:24'),
(3, 'rack 2', '7hcsdbdbb', 53, 7, '2024-06-01 04:42:39', '2024-06-01 04:42:39'),
(4, 'rack 3', '7hcsdbdbc', 54, 7, '2024-06-01 04:42:49', '2024-06-01 04:42:49'),
(5, 'rack 4', '7hcsdbdbd', 55, 7, '2024-06-01 04:42:58', '2024-06-01 04:42:58'),
(6, 'rack 5', '7hcsdbdbe', 56, 7, '2024-06-01 04:43:11', '2024-06-01 04:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `rack_files`
--

CREATE TABLE `rack_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issue_date` date NOT NULL,
  `rf_unique_id` varchar(255) DEFAULT NULL,
  `racks_unique_id` varchar(255) DEFAULT NULL,
  `file_title` text DEFAULT NULL,
  `insert_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rack_files`
--

INSERT INTO `rack_files` (`id`, `issue_date`, `rf_unique_id`, `racks_unique_id`, `file_title`, `insert_by`, `created_at`, `updated_at`) VALUES
(2, '2024-05-11', '7hcsdberf', '7hcsdbdba', 'self no 8', 7, '2024-06-01 05:48:14', '2024-06-01 05:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gyDikvNTr1QO9yo9ylwe9OtHBo4Vpln6fVu7xIaz', NULL, '127.0.0.1', 'PostmanRuntime/7.39.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibTJGblcyQ2VPTWpnT3JLN3BmVnBVb1JvSzZCWFpUcW5LT01tQ1hYVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717386016),
('LeOkdlX80W1MBFiiATeJ2qp3LdNXm6SGmkg7crDL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibWs1WXNNblhzMllaa2Uxb0tPVDdKc1N3anRES3o1ZkV5aGVTZnd6ZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717212401),
('mZC8sQgFe6s3ZEkbrQtchtNrFiGwYaQEdNjNqJ7t', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSVZjNEgwNG0zTXlwdWNBdHlzaVZpZDJjbWNVZmRudVFrMXdFbGs1SiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1716116803),
('tET0TMwLI05Au3Jjdr4dcPwNeYfq1ex3lZGCjAGn', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOUVLa3VWc0FvTzBEMEJ2cm0ybmQyeHRRWllDYlRiem9OYUVhSHNacSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hZHZvY2F0ZS9lZGl0LzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1717387058);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `photo`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '01308389716', 'backend_assets/images/user/663b588bde442.jpg', '2024-04-16 22:43:28', '$2y$12$V8KSGRuKerKLUvoSaI5jDeSma/0hchhbjdd1oCBoQoKQ/Uec3dxqu', 'Heynee6MChFofON34vGWWQbKdV4NIXjA7SUrtsW5YAatXAQFQK64aP2B7Whp', '2024-04-16 22:43:28', '2024-05-08 04:48:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advocates`
--
ALTER TABLE `advocates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `case_dates`
--
ALTER TABLE `case_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `libraries`
--
ALTER TABLE `libraries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `racks`
--
ALTER TABLE `racks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `racks_rack_name_unique` (`rack_name`);

--
-- Indexes for table `rack_files`
--
ALTER TABLE `rack_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `advocates`
--
ALTER TABLE `advocates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `case_dates`
--
ALTER TABLE `case_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `libraries`
--
ALTER TABLE `libraries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `racks`
--
ALTER TABLE `racks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rack_files`
--
ALTER TABLE `rack_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
