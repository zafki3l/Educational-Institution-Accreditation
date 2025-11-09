-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2025 at 09:28 AM
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
-- Database: `educational_institution_accreditation_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `action_permission`
--

CREATE TABLE `action_permission` (
  `action_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `criteria_evidence`
--

CREATE TABLE `criteria_evidence` (
  `criteria_id` varchar(20) NOT NULL,
  `evidence_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criteria_evidence`
--

INSERT INTO `criteria_evidence` (`criteria_id`, `evidence_id`) VALUES
('1.1', 'H1.01.01.01'),
('1.2', 'H1.01.01.01');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
('1', 'Tài chính');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_criterias`
--

CREATE TABLE `evaluation_criterias` (
  `id` varchar(20) NOT NULL,
  `standard_id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department_id` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation_criterias`
--

INSERT INTO `evaluation_criterias` (`id`, `standard_id`, `name`, `department_id`, `created_at`, `updated_at`) VALUES
('1.1', '1', 'Lãnh đạo cơ sở giáo dục đảm bảo tầm nhìn, sứ mạng của cơ sở giáo dục đáp ứng được nhu cầu và sự hài lòng của các bên liên quan', NULL, '2025-11-06 22:52:18', '2025-11-06 22:52:18'),
('1.2', '1', 'Tiêu chí 2 name', NULL, '2025-11-08 17:46:29', '2025-11-08 17:46:29');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_milestones`
--

CREATE TABLE `evaluation_milestones` (
  `id` varchar(20) NOT NULL,
  `criteria_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation_milestones`
--

INSERT INTO `evaluation_milestones` (`id`, `criteria_id`, `name`, `created_at`, `updated_at`) VALUES
('TĐG', '1.1', 'Tự đánh giá', '2025-11-08 15:58:50', '2025-11-09 00:03:51'),
('ĐGN', '1.1', 'Đánh giá ngoài', '2025-11-08 15:59:04', '2025-11-09 00:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_standards`
--

CREATE TABLE `evaluation_standards` (
  `id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation_standards`
--

INSERT INTO `evaluation_standards` (`id`, `name`, `created_at`, `updated_at`) VALUES
('1', 'Tầm nhìn, sứ mạng và văn hóa', '2025-11-06 22:50:50', '2025-11-06 23:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `evidences`
--

CREATE TABLE `evidences` (
  `id` varchar(20) NOT NULL,
  `milestone_id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `decision` varchar(100) NOT NULL,
  `document_date` date NOT NULL,
  `issue_place` varchar(100) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evidences`
--

INSERT INTO `evidences` (`id`, `milestone_id`, `name`, `decision`, `document_date`, `issue_place`, `link`, `created_at`, `updated_at`) VALUES
('H1.01.01.01', 'TĐG', 'Quyết định thành lập Trường ĐH TCNH HN', '2336/QĐ-TTg', '2010-12-21', 'Hà Nội', 'https://drive.google.com/drive/folders/16FlVXMY-UB6C3NRtL3AY2fUnPZnj5XCS', '2025-11-08 16:03:42', '2025-11-08 16:03:42'),
('H1.01.01.02', 'TĐG', '11111', 'aaa', '2020-12-12', 'HN', 'HN', '2025-11-09 02:07:50', '2025-11-09 02:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `scope` enum('own','department','all') NOT NULL DEFAULT 'own'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'User'),
(2, 'Business Staff'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `department_id` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `gender`, `password`, `role_id`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Phạm Đình', 'Thái', 'Th42@abc.com', 'male', '$2y$10$FPSYzyn6Y9c4JpKAA2zuNeRNMm9yASpiKcxXFI5ojrORrV9k.CnQ6', 3, NULL, '2025-11-06 15:11:54', '2025-11-09 15:07:27'),
(2, 'Nguyeaaa', 'edad', 'phamdinhthai1234@a.com', 'female', '$2y$10$FPSYzyn6Y9c4JpKAA2zuNeRNMm9yASpiKcxXFI5ojrORrV9k.CnQ6', 1, '1', '2025-11-06 16:11:06', '2025-11-09 15:07:13'),
(3, 'Phạm Đình', 'Tháii', 'Th432@abc.com', 'male', '$2y$10$hHyNR/n4HjPl/8YPutCJa.NtANdcVZ59oN3DY61ZXN6j3FDe639Ee', 1, '1', '2025-11-06 20:18:10', '2025-11-09 00:08:04'),
(5, 'Phạm Đình', 'Thái', 'phamdinhthai123@abc.com', 'male', '$2y$10$pN5.4qSUXvIxeVWmabBoq.YiBgYmPkZY9heccOIcpJ.eeoNo0K4mW', 3, NULL, '2025-11-08 21:31:00', '2025-11-09 15:07:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `action_permission`
--
ALTER TABLE `action_permission`
  ADD PRIMARY KEY (`action_id`,`permission_id`),
  ADD KEY `FK_02_action_permission` (`permission_id`);

--
-- Indexes for table `criteria_evidence`
--
ALTER TABLE `criteria_evidence`
  ADD PRIMARY KEY (`criteria_id`,`evidence_id`),
  ADD KEY `FK_02_criteria_evidence` (`evidence_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_criterias`
--
ALTER TABLE `evaluation_criterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `standard_id` (`standard_id`),
  ADD KEY `FK_02_evaluation_criterias` (`department_id`);

--
-- Indexes for table `evaluation_milestones`
--
ALTER TABLE `evaluation_milestones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_01_evaluation_milestones` (`criteria_id`);

--
-- Indexes for table `evaluation_standards`
--
ALTER TABLE `evaluation_standards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evidences`
--
ALTER TABLE `evidences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_01_evidences` (`milestone_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_01_permissions` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_01_users` (`department_id`),
  ADD KEY `FK_02_users` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action_permission`
--
ALTER TABLE `action_permission`
  ADD CONSTRAINT `FK_01_action_permission` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_02_action_permission` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `criteria_evidence`
--
ALTER TABLE `criteria_evidence`
  ADD CONSTRAINT `FK_01_criteria_evidence` FOREIGN KEY (`criteria_id`) REFERENCES `evaluation_criterias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_02_criteria_evidence` FOREIGN KEY (`evidence_id`) REFERENCES `evidences` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluation_criterias`
--
ALTER TABLE `evaluation_criterias`
  ADD CONSTRAINT `FK_02_evaluation_criterias` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluation_criterias_ibfk_1` FOREIGN KEY (`standard_id`) REFERENCES `evaluation_standards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluation_milestones`
--
ALTER TABLE `evaluation_milestones`
  ADD CONSTRAINT `FK_01_evaluation_milestones` FOREIGN KEY (`criteria_id`) REFERENCES `evaluation_criterias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evidences`
--
ALTER TABLE `evidences`
  ADD CONSTRAINT `FK_01_evidences` FOREIGN KEY (`milestone_id`) REFERENCES `evaluation_milestones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `FK_01_permissions` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_01_users` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_02_users` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
