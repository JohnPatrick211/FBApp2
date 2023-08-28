-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2023 at 09:15 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fbapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` bigint(20) NOT NULL,
  `admin_id` bigint(20) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `civilstatus` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `admin_id`, `fname`, `mname`, `lname`, `age`, `address`, `birthdate`, `email`, `civilstatus`, `profile_pic`, `status`, `phone`, `gender`, `created_at`, `updated_at`) VALUES
(1, 1, 'Wyns John Marco', 'De Castro', 'Alvez', '23', 'admin address', '2000-07-10', 'admin@gmail.com', 'Single', 'profile_pic/64d71dacd2300.jpg', '1', '09216841075', 'Male', '2023-08-19 04:07:55', '2023-08-19 04:07:55'),
(2, 5, 'Sample', 'Sample', 'Archive', '24', 'Sample Address Archive', '1999-02-05', 'archive@gmail.com', 'Widowed', 'profile_pic/64d7293027434.jpg', '0', '09876785435', 'Male', '2023-08-11 22:41:26', '2023-08-11 23:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billingtray`
--

CREATE TABLE `tbl_billingtray` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cashiering_id` varchar(255) DEFAULT NULL,
  `tenant_id` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_billingtray`
--

INSERT INTO `tbl_billingtray` (`id`, `cashiering_id`, `tenant_id`, `product_name`, `amount`, `created_at`, `updated_at`) VALUES
(17, '1', '3', 'Room 601 Lower Bed For the Month of August', '4000.00', '2023-08-24 20:50:03', '2023-08-24 20:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `comment_body` longtext DEFAULT NULL,
  `commentable_id` varchar(255) DEFAULT NULL,
  `commentable_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`id`, `user_id`, `parent_id`, `comment_body`, `commentable_id`, `commentable_type`, `created_at`, `updated_at`) VALUES
(1, '7', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1', NULL, '2023-08-25 14:17:38', '2023-08-25 14:17:38'),
(2, '3', '2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1', NULL, '2023-08-25 14:17:38', '2023-08-25 14:17:38'),
(3, '1', '2', 'sa wakas natapos din', '1', NULL, '2023-08-25 23:09:02', '2023-08-25 23:09:02'),
(4, '2', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1', NULL, '2023-08-25 14:17:38', '2023-08-25 14:17:38'),
(8, '1', '1', 'This Forum will be closed, and it will delete in 40 days', NULL, NULL, '2023-08-25 23:13:39', '2023-08-25 23:13:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` bigint(20) NOT NULL,
  `emp_id` bigint(20) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `civilstatus` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `emp_id`, `fname`, `mname`, `lname`, `age`, `address`, `birthdate`, `email`, `civilstatus`, `status`, `phone`, `gender`, `profile_pic`, `created_at`, `updated_at`) VALUES
(1, 2, 'Rodelyn', 'Bausas', 'Zuniga', '26', 'sample', '1997-01-09', 'asdasdasd', 'Married', '1', '12312313213', 'Female', 'profile_pic/64d71f82375e3.jpg', '2023-08-25 17:27:13', '2023-08-25 17:27:13'),
(2, 6, 'Sample', 'Employee', 'Archive', '24', '232323', '1999-06-12', 'archive@gmails.com', 'Single', '0', '232323232', 'Male', 'profile_pic/64d730b6960e4.png', '2023-08-11 23:11:50', '2023-08-11 23:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forum`
--

CREATE TABLE `tbl_forum` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `author_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_forum`
--

INSERT INTO `tbl_forum` (`id`, `title`, `body`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'Sample Forum', '1Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '3', '2023-08-25 10:11:22', '2023-08-25 10:11:22'),
(2, 'Sample Forum 2', '2Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '7', '2023-08-25 10:11:22', '2023-08-25 10:11:22'),
(3, 'Sample Forum 3', '3Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1', '2023-08-25 10:11:22', '2023-08-25 10:11:22'),
(4, 'Sample Forum 4', '4Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2', '2023-08-25 10:11:22', '2023-08-25 10:11:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room`
--

CREATE TABLE `tbl_room` (
  `id` bigint(20) NOT NULL,
  `roomnumber` varchar(255) DEFAULT NULL,
  `roomcapacity` int(11) DEFAULT NULL,
  `isOccupied` varchar(255) DEFAULT NULL,
  `vacantnumber` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_room`
--

INSERT INTO `tbl_room` (`id`, `roomnumber`, `roomcapacity`, `isOccupied`, `vacantnumber`, `status`, `created_at`, `updated_at`) VALUES
(1, '601', 4, '2', 2, '1', '2023-08-19 20:49:46', '2023-08-19 20:49:46'),
(2, '602', 4, '2', 3, '1', '2023-08-19 21:17:57', '2023-08-19 21:17:57'),
(3, '603', 4, '1', 3, '0', '2023-08-06 11:36:05', '2023-08-06 11:36:05'),
(4, '604', 4, '0', 4, '1', '2023-08-19 21:31:13', '2023-08-19 21:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rule`
--

CREATE TABLE `tbl_rule` (
  `id` bigint(20) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rule`
--

INSERT INTO `tbl_rule` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '<p>Sample Long Rule 2 <b>Bold</b></p>', '2023-08-20 07:28:55', '2023-08-20 00:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` varchar(255) DEFAULT NULL,
  `invoice_no` int(5) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sales`
--

INSERT INTO `tbl_sales` (`id`, `tenant_id`, `invoice_no`, `product_name`, `amount`, `payment_method`, `created_at`, `updated_at`) VALUES
(9, '3', 12345, 'Room 601 Lower Bed For the Month of August', '4000.00', 'Cash', '2023-08-24 20:49:19', '2023-08-24 20:49:19'),
(10, '3', 12346, 'Room 601 Lower Bed For the Month of July', '4000.00', 'GCash', '2023-08-24 20:49:19', '2023-08-24 20:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tenant`
--

CREATE TABLE `tbl_tenant` (
  `id` bigint(20) NOT NULL,
  `tenant_id` bigint(20) DEFAULT NULL,
  `room_id` bigint(20) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `civilstatus` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `date_of_occupancy` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tenant`
--

INSERT INTO `tbl_tenant` (`id`, `tenant_id`, `room_id`, `fname`, `mname`, `lname`, `age`, `address`, `birthdate`, `email`, `civilstatus`, `status`, `phone`, `gender`, `profile_pic`, `date_of_occupancy`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Aldrin', 'Estrella', 'Custodio', '24', 'Caloocan, Balayan, Batangas', '1999-07-10', 'aldrincustodio@gmail.com', 'Single', '1', '09785642376', 'Male', 'profile_pic/64d71ea8b6fb8.jpg', '2023-08-20', '2023-08-20 07:48:11', '2023-08-20 07:48:11'),
(2, 4, 0, 'sample name', 'sample name', 'sample name', '24', 'sample', '1999-07-10', 'asdasd', 'Single', '0', '213123123123', 'Male', 'sadasdasd', NULL, '2023-08-02 12:57:20', '2023-08-11 23:21:18'),
(3, 7, 1, 'John Matthew', 'Cruz', 'Arquelola', '23', 'BGC, Taguig', '2000-06-20', 'sample@gmail.com', 'Single', '1', '09768521232', 'Male', 'profile_pic/64e165a8be6cb.png', '2023-08-20', '2023-08-20 07:47:37', '2023-08-20 07:47:37'),
(4, 8, 2, 'tenant4', 'sad', 'sad', '1', 'sadsad', '2022-05-12', 'admin@gmail.com', 'Single', '1', '09216841072', 'Male', 'profile_pic/64e2370932e43.png', '2023-08-10', '2023-08-20 07:58:17', '2023-08-20 07:58:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `user_role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$RMWk.3o6OwvYlX/GAe7vkOnV2QlCnNyx4h0smXbnrZi8pgshtw3Qq', 'System Admin', '2023-08-19 04:07:55', '2023-08-19 04:07:55'),
(2, 'employee', '$2y$10$OhwU6LcY3HxyIcS3qIw8AuFf0RQZgnMmFr9sc/9PC8kKlAIKI/CMe', 'Employee', '2023-08-25 17:27:13', '2023-08-25 17:27:13'),
(3, 'tenant', '$2y$10$Gc15a67fq49pnIzPVaWTiOuwidNoKp4V2cvF6rQWwQMomYEHmOMVa', 'Tenant', '2023-08-20 07:48:11', '2023-08-20 07:48:11'),
(4, 'tenant1', '$2y$10$fsOcNFT5GW0Z4vnY3.COnuf.yJdRTTjerWTj8bNkmNoH6Lk1XKyEK', 'Tenant', '2023-08-02 02:44:31', '2023-08-02 02:44:31'),
(5, 'admin1', '$2y$10$mQyAbzzjN0AiKeb7sAUnaONM/epa7WUjdN9utnjw0XobPtsSklTRe', 'System Admin', '2023-08-11 22:41:26', '2023-08-11 22:41:26'),
(6, 'employee1', '$2y$10$vEPDKGyloyHQz6HyvTaBPevkXM8t9GDqIsoBwdbzB8BBLrnKZbtYe', 'Employee', '2023-08-11 23:11:50', '2023-08-11 23:11:50'),
(7, 'tenant4', '$2y$10$G/cMW.KdFOD6G4ASMYvcquKA7isUrsRPRnlo3ht.0tSjrpPRpk3qm', 'Tenant', '2023-08-20 07:47:37', '2023-08-20 07:47:37'),
(8, '12345678', '$2y$10$o9DPxOHodbB5xPy/Rjia0.aCu.Z7UcJya4VTiSlahPEs4kpa8uEWm', 'Tenant', '2023-08-20 07:58:17', '2023-08-20 07:58:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_billingtray`
--
ALTER TABLE `tbl_billingtray`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_forum`
--
ALTER TABLE `tbl_forum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_room`
--
ALTER TABLE `tbl_room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rule`
--
ALTER TABLE `tbl_rule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tenant`
--
ALTER TABLE `tbl_tenant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_billingtray`
--
ALTER TABLE `tbl_billingtray`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_forum`
--
ALTER TABLE `tbl_forum`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_rule`
--
ALTER TABLE `tbl_rule`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_tenant`
--
ALTER TABLE `tbl_tenant`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
