-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 01:26 PM
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
-- Database: `mis`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `log_id` int(11) NOT NULL,
  `log_user_id` int(11) NOT NULL,
  `log_description` text NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`log_id`, `log_user_id`, `log_description`, `log_date`) VALUES
(2, 7, 'Added new user: kiko pangalaninan (kikoako) position (admin)', '2025-03-16 13:58:20'),
(4, 3, 'Updated user: justin melvin (zhask) to position: admin', '2025-03-16 14:07:01'),
(6, 6, 'Deleted user: alden', '2025-03-16 14:11:30'),
(7, 8, 'Added new user: joseph amores (alucard) position (admin)', '2025-03-20 13:13:04'),
(8, 9, 'Added new user: juan (juan) position (admin)', '2025-03-25 11:46:19'),
(9, 9, 'Updated user: juan (juan) to position: admin', '2025-03-25 11:51:06'),
(10, 4, 'Updated user: joshua padilla (super admin) to position: super admin', '2025-03-25 11:53:39'),
(11, 4, 'Updated user: jimmy neutron (super admin) to position: super admin', '2025-03-25 11:54:59'),
(12, 2, 'Updated user: andy anderson (andyisaac) to position: super admin', '2025-03-25 12:22:21'),
(13, 4, 'Updated user: jimmy neutron (super admin) to position: super admin', '2025-03-25 12:22:44'),
(14, 4, 'Updated user: jimmy neutron (super admin) to position: super admin', '2025-03-25 12:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `chat_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message_text` text NOT NULL,
  `message_media` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `systemFrom` varchar(60) NOT NULL,
  `systemTo` varchar(60) NOT NULL,
  `message_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=deleted,1=existing,2=waiting for approval',
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`chat_id`, `sender_id`, `receiver_id`, `message_text`, `message_media`, `systemFrom`, `systemTo`, `message_status`, `date_sent`) VALUES
(60, 4, 14, 'sent from mis', NULL, 'mis', 'alumni', 1, '2025-03-14 01:37:14'),
(61, 4, 2, 'sent from mis', NULL, 'mis', 'mis', 1, '2025-03-14 01:37:26'),
(62, 4, 3, 'sent from mis', NULL, 'mis', 'library', 1, '2025-03-14 01:37:34'),
(63, 4, 15, '', 'file_67d38874b667e3.31367776.jpg', 'mis', 'alumni', 1, '2025-03-14 01:37:56'),
(64, 5, 15, '', 'file_67d388a00e3856.79850718.jpg', 'mis', 'alumni', 2, '2025-03-14 01:38:40'),
(65, 15, 4, '', 'file_67d389458fc3a1.69253054.jpg', 'alumni', 'mis', 2, '2025-03-14 01:41:25'),
(66, 15, 5, '', 'file_67d38975724b99.36236290.webp', 'alumni', 'mis', 2, '2025-03-14 01:42:13'),
(67, 1, 4, 'test', NULL, 'library', 'mis', 1, '2025-03-14 02:26:43'),
(68, 15, 1, '', 'file_67d3942f305c29.85898068.png', 'alumni', 'library', 2, '2025-03-14 02:27:59'),
(69, 1, 15, '', 'file_67d3950e672387.26380770.jpeg', 'library', 'alumni', 0, '2025-03-14 02:34:37'),
(70, 4, 1, '', 'file_67d395a4e2eb77.65199261.jpeg', 'alumni', 'library', 1, '2025-03-14 02:34:12'),
(71, 1, 3, '', 'file_67d397e56ab302.09328640.jpg', 'library', 'mis', 2, '2025-03-14 02:43:49'),
(72, 1, 4, 'test from library', NULL, 'library', 'mis', 1, '2025-03-20 12:53:46'),
(73, 1, 4, '', 'file_67dc101c91b2f9.55501764.docx', 'library', 'mis', 1, '2025-03-20 12:57:20'),
(74, 4, 1, '', 'file_67dc1150db8309.65179234.pdf', 'mis', 'library', 1, '2025-03-20 13:00:00'),
(75, 1, 4, '', 'file_67dc117c10cfa3.90361559.jpg', 'library', 'mis', 1, '2025-03-20 13:01:04'),
(76, 15, 1, 'test now', NULL, 'alumni', 'library', 1, '2025-03-20 13:10:43'),
(77, 1, 15, 'receieved from library', NULL, 'library', 'alumni', 1, '2025-03-20 13:10:57'),
(78, 1, 15, '', 'file_67dc13f04d10e5.76533924.png', 'library', 'alumni', 1, '2025-03-20 13:12:15'),
(79, 4, 8, 'hi amores', NULL, 'mis', 'mis', 1, '2025-03-20 13:14:22'),
(80, 8, 4, '', 'file_67dc14c8806822.11103134.jpg', 'mis', 'mis', 1, '2025-03-20 13:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(60) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=deleted,1=existing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `phone`, `profile_picture`, `password`, `type`, `status`) VALUES
(2, 'andy anderson', 'andyisaac', 'andyisaac18@gmail.com', '09454454741', '', '$2y$10$UF0YyA2/cIsZ.L6eavBK.OBM6mW7BX14yE09uBvl0CNrxi3SyyA.O', 'super admin', 1),
(3, 'justin melvin', 'zhask', '', '', '', '$2y$10$dGvKBUmqq5/EGXnamzd2FOd/cCy7mJyIeaDJzG2P8Obx6liaBwmBi', 'admin', 1),
(4, 'jimmy neutron', 'super admin', 'jimmy@gmail.com', '09454454744', '67e299430a7f2.jpg', '$2y$10$b95G3gD.NGnfLWSG9xNvO.rCgGqYzadp4EE9CH5GpfkZS.u/5dgF.', 'super admin', 1),
(5, 'refactor', 'refactor', '', '', '', '$2y$10$KDTVKDxlCc5i.x60xaSikuiKpH6WnAbuaNsqCrbLpvzeerh.LyBhi', 'admin', 1),
(6, 'alden richard', 'alden', '', '', '', '$2y$10$zY9/eO9k80QgYXngg.VHwuXxTWi7rkuc48JuBRLWtHByIcGdK8AUa', 'super admin', 0),
(7, 'kiko pangalaninan', 'kikoako', '', '', '', '$2y$10$Ca0Y7022flVg9fbbXXJR7eZRmUioSqjdTOkTZDx4PpL70Vs2eWlR.', 'admin', 0),
(8, 'joseph amores', 'alucard', '', '', '', '$2y$10$ElLziOzfKskDqgTQXqo09eLzmJAMwiNlUDEGaRaUZ2LxbUDVpdbqa', 'admin', 1),
(9, 'juan', 'juan', '', '', '67e298aa284bc.png', '$2y$10$cvWUAFI.ET/XCgactI57KetvmZy4Bvk9Vj4EMJadh41hLXhsoIcae', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
