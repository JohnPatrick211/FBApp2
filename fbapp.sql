-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2023 at 12:00 PM
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
(1, 1, 'Wyns John Marco', 'De Castro', 'Alvez', '23', 'admin address', '2000-07-10', 'admin@gmail.com', 'Single', 'profile_pic/64d71dacd2300.jpg', '1', '09216841075', 'Male', '2023-08-11 21:50:36', '2023-08-11 23:27:56'),
(2, 5, 'Sample', 'Sample', 'Archive', '24', 'Sample Address Archive', '1999-02-05', 'archive@gmail.com', 'Widowed', 'profile_pic/64d7293027434.jpg', '0', '09876785435', 'Male', '2023-08-11 22:41:26', '2023-08-11 23:28:45');

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
(1, 2, 'sample employee', 'sample', 'sample', '26', 'sample', '1997-01-09', 'asdasdasd', 'Married', '1', '12312313213', 'Female', 'profile_pic/64d71f82375e3.jpg', '2023-08-11 21:58:26', '2023-08-11 23:27:50'),
(2, 6, 'Sample', 'Employee', 'Archive', '24', '232323', '1999-06-12', 'archive@gmails.com', 'Single', '0', '232323232', 'Male', 'profile_pic/64d730b6960e4.png', '2023-08-11 23:11:50', '2023-08-11 23:28:38');

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
(1, '601', 4, '1', 3, '1', '2023-08-06 11:36:05', '2023-08-06 11:36:05'),
(2, '602', 4, '1', 3, '1', '2023-08-06 11:36:05', '2023-08-06 11:36:05'),
(3, '603', 4, '1', 3, '0', '2023-08-06 11:36:05', '2023-08-06 11:36:05');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tenant`
--

INSERT INTO `tbl_tenant` (`id`, `tenant_id`, `room_id`, `fname`, `mname`, `lname`, `age`, `address`, `birthdate`, `email`, `civilstatus`, `status`, `phone`, `gender`, `profile_pic`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 'Aldrin', 'Estrella', 'Custodio', '24', 'Caloocan, Balayan, Batangas', '1999-07-10', 'aldrincustodio@gmail.com', 'Single', '1', '09785642376', 'Male', 'profile_pic/64d71ea8b6fb8.jpg', '2023-08-12 00:27:14', '2023-08-12 00:27:14'),
(2, 4, 1, 'sample name', 'sample name', 'sample name', '24', 'sample', '1999-07-10', 'asdasd', 'Single', '0', '213123123123', 'Male', 'sadasdasd', '2023-08-02 12:57:20', '2023-08-11 23:21:18');

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
(1, 'admin', '$2y$10$ftSxvt9gvsNJd1p4cviPbO8l2CKxBYUWvVTQBdD8xbcvAAmKIVkw.', 'System Admin', '2023-08-11 21:50:36', '2023-08-11 21:50:36'),
(2, 'employee', '$2y$10$OhwU6LcY3HxyIcS3qIw8AuFf0RQZgnMmFr9sc/9PC8kKlAIKI/CMe', 'Employee', '2023-08-11 21:58:26', '2023-08-11 21:58:26'),
(3, 'tenant', '$2y$10$Gc15a67fq49pnIzPVaWTiOuwidNoKp4V2cvF6rQWwQMomYEHmOMVa', 'Tenant', '2023-08-12 00:27:14', '2023-08-12 00:27:14'),
(4, 'tenant1', '$2y$10$fsOcNFT5GW0Z4vnY3.COnuf.yJdRTTjerWTj8bNkmNoH6Lk1XKyEK', 'Tenant', '2023-08-02 02:44:31', '2023-08-02 02:44:31'),
(5, 'admin1', '$2y$10$mQyAbzzjN0AiKeb7sAUnaONM/epa7WUjdN9utnjw0XobPtsSklTRe', 'System Admin', '2023-08-11 22:41:26', '2023-08-11 22:41:26'),
(6, 'employee1', '$2y$10$vEPDKGyloyHQz6HyvTaBPevkXM8t9GDqIsoBwdbzB8BBLrnKZbtYe', 'Employee', '2023-08-11 23:11:50', '2023-08-11 23:11:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_room`
--
ALTER TABLE `tbl_room`
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
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_tenant`
--
ALTER TABLE `tbl_tenant`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
