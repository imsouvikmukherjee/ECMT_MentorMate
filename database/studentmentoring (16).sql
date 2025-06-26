-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2025 at 08:57 AM
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
-- Database: `studentmentoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_semisters`
--

CREATE TABLE `academic_semisters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `semister_name` varchar(255) NOT NULL,
  `semister_type` enum('even','odd') NOT NULL,
  `months` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`months`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_semisters`
--

INSERT INTO `academic_semisters` (`id`, `session_id`, `department_id`, `semister_name`, `semister_type`, `months`, `created_at`, `updated_at`) VALUES
(1, 4, 27, '1st SEM', 'odd', '[\"January\",\"February\",\"March\",\"April\",\"May\",\"June\"]', '2025-05-12 05:28:32', NULL),
(2, 4, 28, '2nd SEM', 'even', '[\"July\",\"August\",\"September\",\"October\",\"November\",\"December\"]', '2025-05-12 05:30:02', NULL),
(3, 4, 27, '2nd SEM', 'even', '[\"July\",\"August\",\"September\",\"October\",\"November\"]', '2025-05-12 05:31:58', NULL),
(6, 4, 35, '1st SEM', 'odd', '[\"June\",\"July\",\"August\",\"September\",\"October\",\"November\",\"December\"]', '2025-06-11 05:17:28', NULL),
(7, 6, 37, '1st SEM', 'odd', '[\"June\",\"July\",\"August\",\"September\"]', '2025-06-11 05:37:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `academic_sessions`
--

CREATE TABLE `academic_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_sessions`
--

INSERT INTO `academic_sessions` (`id`, `session`, `description`, `created_at`, `updated_at`) VALUES
(1, '2022-26', 'efweff', '2025-05-11 02:06:51', '2025-05-11 02:06:51'),
(2, '2022-25', NULL, '2025-05-11 02:07:51', '2025-05-11 02:07:51'),
(4, '2020-24', 'yggy7vyyy yuvy yvyvy yvyvy', '2025-05-11 04:35:59', '2025-05-11 04:35:59'),
(5, '2025-28', NULL, '2025-05-13 04:24:22', '2025-05-13 04:24:22'),
(6, '2030-33', 'rgregre', '2025-06-11 05:36:45', '2025-06-11 05:36:45'),
(7, '2050-55', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assigned_mentor`
--

CREATE TABLE `assigned_mentor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mentor_id` bigint(20) UNSIGNED NOT NULL,
  `mentee_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assigned_mentor`
--

INSERT INTO `assigned_mentor` (`id`, `mentor_id`, `mentee_id`, `created_at`, `updated_at`) VALUES
(131, 843, 805, '2025-05-11 11:21:01', NULL),
(132, 756, 806, '2025-05-11 11:25:39', NULL),
(135, 756, 807, '2025-06-10 13:30:50', NULL),
(136, 843, 896, '2025-06-13 17:23:48', NULL),
(137, 843, 853, '2025-06-13 17:23:48', NULL),
(138, 843, 915, '2025-06-13 17:23:48', NULL),
(139, 756, 923, '2025-06-13 17:25:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_records`
--

CREATE TABLE `attendance_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mentoring_info_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `jan` int(11) DEFAULT NULL,
  `feb` int(11) DEFAULT NULL,
  `mar` int(11) DEFAULT NULL,
  `apr` int(11) DEFAULT NULL,
  `may` int(11) DEFAULT NULL,
  `jun` int(11) DEFAULT NULL,
  `jul` int(11) DEFAULT NULL,
  `aug` int(11) DEFAULT NULL,
  `sep` int(11) DEFAULT NULL,
  `oct` int(11) DEFAULT NULL,
  `nov` int(11) DEFAULT NULL,
  `dec` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_records`
--

INSERT INTO `attendance_records` (`id`, `mentoring_info_id`, `subject`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `aug`, `sep`, `oct`, `nov`, `dec`, `created_at`, `updated_at`) VALUES
(89, 15, 'JAVA (JAVA1235)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 15:54:21', NULL),
(90, 15, 'Overall Attendance', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 15:54:21', NULL),
(119, 14, 'Computer Science (BCA123)', 50, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 16:54:48', NULL),
(120, 14, 'PYTHON PROGRAMMING (BCA1237)', 60, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 16:54:48', NULL),
(121, 14, 'PYTHON PROGRAMMING (BCA12344)', 70, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 16:54:48', NULL),
(122, 14, 'Overall Attendance', 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 16:54:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('kingkohli@gmail.com|127.0.0.1', 'i:2;', 1749450247),
('kingkohli@gmail.com|127.0.0.1:timer', 'i:1749450247;', 1749450247),
('mukherjeesouvik2041@gmail.com|127.0.0.1', 'i:3;', 1746428514),
('mukherjeesouvik2041@gmail.com|127.0.0.1:timer', 'i:1746428514;', 1746428514);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `communication_pattern2`
--

CREATE TABLE `communication_pattern2` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mentoring_info_id` bigint(20) UNSIGNED NOT NULL,
  `body_language` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `communication_pattern2`
--

INSERT INTO `communication_pattern2` (`id`, `mentoring_info_id`, `body_language`, `type`, `created_at`, `updated_at`) VALUES
(36, 15, 'Open Posture', 'Yes', '2025-06-11 15:54:21', NULL),
(37, 15, 'Weak Handshake', 'No', '2025-06-11 15:54:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `communication_patterns`
--

CREATE TABLE `communication_patterns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mentoring_info_id` bigint(20) UNSIGNED NOT NULL,
  `language` varchar(255) DEFAULT NULL,
  `proficiency` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `session_id`, `department_name`) VALUES
(33, 1, 'BBA'),
(32, 2, 'B PHARM'),
(30, 2, 'BBA HR'),
(29, 2, 'BCA'),
(27, 4, 'BBA HR'),
(35, 4, 'MA'),
(36, 4, 'MBA'),
(28, 4, 'MCA'),
(34, 5, 'BCA NEW'),
(37, 6, 'BCA'),
(38, 7, 'BCA');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mentoring_infos`
--

CREATE TABLE `mentoring_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '0',
  `remark` text DEFAULT NULL,
  `sgpa` decimal(4,2) DEFAULT NULL,
  `certifications` text DEFAULT NULL,
  `workshops` text DEFAULT NULL,
  `competitions` text DEFAULT NULL,
  `projects` text DEFAULT NULL,
  `sports_participation` text DEFAULT NULL,
  `cultural_activities` text DEFAULT NULL,
  `club_memberships` text DEFAULT NULL,
  `social_service_activities` text DEFAULT NULL,
  `community_engagement` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mentoring_infos`
--

INSERT INTO `mentoring_infos` (`id`, `session_id`, `department_id`, `semester_id`, `user_id`, `status`, `remark`, `sgpa`, `certifications`, `workshops`, `competitions`, `projects`, `sports_participation`, `cultural_activities`, `club_memberships`, `social_service_activities`, `community_engagement`, `created_at`, `updated_at`) VALUES
(14, 4, 27, 3, 844, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 12:11:03', '2025-06-11 16:54:48'),
(15, 4, 27, 1, 844, '3', 'success', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 12:11:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_24_083305_create_department_table', 2),
(5, '2024_10_24_162557_create_subject_table', 3),
(6, '2024_11_05_061103_create_student_details_table', 4),
(8, '2024_11_17_074346_create_assigned_mentor_table', 5),
(9, '2024_12_13_075127_create_password_resets_table', 6),
(10, '2025_05_01_075735_create_student_update_request_table', 7),
(12, '2025_05_11_063818_create_academic_sessions_table', 8),
(13, '2025_05_12_091514_create_academic_semisters_table', 9),
(14, '2025_05_12_162820_create_subject_table', 10),
(16, '2025_05_15_115209_create_mentoring_infos_table', 11),
(17, '2025_05_15_122443_create_theory_exams_table', 12),
(19, '2025_05_15_123900_create_practical_exams_table', 13),
(20, '2025_05_15_130122_create_semester_marks_table', 14),
(21, '2025_05_15_131351_create_attendance_records_table', 15),
(22, '2025_05_15_132752_create_communication_patterns_table', 16),
(23, '2025_05_15_132848_create_communication_pattern2_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`) VALUES
(29, 'dewanjeeswapnil@gmail.com', 'Kug58Lgzig5Qqj2rb0fX8LVLKSz4HSiiId2NUrONy8BMLFv9CWw5Ey8ynqMwLecU'),
(31, 'ecmt-22-075@ecmt.in', 'LJfvaBBHxtO7QKrBCPN4VO8NrmjDuRACm0vjs8BkyOwCRUvfR5DJconxDtmCWXpc'),
(32, 'ecmt-22-075@ecmt.in', 'gz5yNLQJ34RM4tDx0qmC1FW6CKdQauj2vUNSRnmslG7WCkKerYFPgaZoLd04omm8'),
(33, 'ecmt-22-075@ecmt.in', '7o22iTxcDwGyNQCgndNJ1QZEllnzT8OJn01Udy1K9ydU5ovNiAZHbW5beboskGnC'),
(34, 'ecmt-22-075@ecmt.in', 'rOwA6gWVi4bLLuhpA2u96HLwPbhH6dfgeymZSOzdtC7ufJvMw78J27mLy5a8GxlQ'),
(35, 'ecmt-22-075@ecmt.in', 'j6WCrkn6Z4zhTt9zYva123t5KJTqVhjdU9cQlbyOE3Gq9AxklzzCivhEffzxE0bu'),
(39, 'mukherjeesouvik2043@gmail.com', 'NE8tO60JDdhoCkH7wRCp4nCiVWbI5jdMF1krjDWj7mywIqHe5rk8xmImsiFoZoi4'),
(40, 'mukherjeesouvik2043@gmail.com', '5SaB9vt6asfHZSXmIEQ4aHxDiS7pPvpU4VtXv1S5QYc2ZgSXvV9JFr52P6G2tit9');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `practical_exams`
--

CREATE TABLE `practical_exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mentoring_info_id` bigint(20) UNSIGNED NOT NULL,
  `subject_name` varchar(255) DEFAULT NULL,
  `paper_code` varchar(255) DEFAULT NULL,
  `pca1` int(11) DEFAULT NULL,
  `pca2` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `practical_exams`
--

INSERT INTO `practical_exams` (`id`, `mentoring_info_id`, `subject_name`, `paper_code`, `pca1`, `pca2`, `created_at`, `updated_at`) VALUES
(35, 14, 'PYTHON PROGRAMMING', 'BCA12344', 39, 40, '2025-06-11 16:54:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('odd','even') NOT NULL,
  `months` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`months`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester_marks`
--

CREATE TABLE `semester_marks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mentoring_info_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `paper_code` varchar(255) NOT NULL,
  `letter_grade` varchar(255) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `credit` decimal(4,1) DEFAULT NULL,
  `credit_points` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semester_marks`
--

INSERT INTO `semester_marks` (`id`, `mentoring_info_id`, `subject`, `paper_code`, `letter_grade`, `points`, `credit`, `credit_points`, `created_at`, `updated_at`) VALUES
(71, 15, 'JAVA', 'JAVA1235', 'O', NULL, NULL, NULL, '2025-06-11 15:54:21', NULL),
(93, 14, 'Computer Science', 'BCA123', 'O', NULL, NULL, NULL, '2025-06-11 16:54:48', NULL),
(94, 14, 'PYTHON PROGRAMMING', 'BCA1237', 'O', NULL, NULL, NULL, '2025-06-11 16:54:48', NULL),
(95, 14, 'PYTHON PROGRAMMING', 'BCA12344', 'O', NULL, NULL, NULL, '2025-06-11 16:54:48', NULL);

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
('ROIDmPgxSuJyCVsoY5hptw2c1nRGfmDkUxjEoSld', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNVFWUUNkUnlFSzNWenhGYXhPVDExMlR1WG50cEpMRGMxQkc0aXRsZiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2FkZC1tZW50ZWVzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1742121893),
('wZfzjlFu4DyGtVCgcdmm0ACwtcYuwFyGdek68YFg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidmU1eFZJbzhTaHRRRklxRTlsUWh1bGlWYklSWmtUSldrTGFzZXpjNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1744530776);

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `session` varchar(255) DEFAULT NULL,
  `aadhaar_no` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_address` varchar(255) DEFAULT NULL,
  `guardian_mobile` varchar(255) DEFAULT NULL,
  `relation_with_guardian` varchar(255) DEFAULT NULL,
  `residence_status` varchar(255) DEFAULT NULL,
  `student_address` text DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `alternate_mobile` varchar(255) DEFAULT NULL,
  `reg_no` varchar(255) DEFAULT NULL,
  `roll_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`id`, `user_id`, `session`, `aadhaar_no`, `father_name`, `mother_name`, `dob`, `nationality`, `category`, `sex`, `blood_group`, `religion`, `guardian_name`, `guardian_address`, `guardian_mobile`, `relation_with_guardian`, `residence_status`, `student_address`, `state`, `district`, `pin`, `alternate_mobile`, `reg_no`, `roll_no`, `created_at`, `updated_at`) VALUES
(805, 844, '2022-25', '101010101012', 'Kohli Father', 'kohli Mother', '1998-10-12', 'indian', 'GEN', 'Male', 'B+', 'Sikh', 'Kohli father', 'RCB', '1236547890', 'Father', 'Ground', 'India', 'Delhi', 'North 24 PGS', '123654', '1236547895', '111111111111', '111111111110', '2025-05-11 11:07:58', '2025-06-13 06:24:13'),
(806, 845, '2022-25', '101010101110', 'Rohit Father', 'Rohit Mother', '1998-11-12', 'Indian', 'player', 'Male', 'B+', 'Hindu', 'Rohit Father', 'MI', '1236547890', 'Father', 'Ground', 'India', 'Mumbai', 'North 24 PGS', '123456', '1236547890', NULL, NULL, '2025-05-11 11:07:59', '2025-05-11 11:07:59'),
(807, 849, '2022-26', '210210210210', 'abd father', 'abd mother', '2001-10-12', 'indian', 'player', 'Male', 'B+', 'Hindu', 'abd father', 'south africa', '3030303030', 'father', 'home', 'south africa', 'south africa state', 'south district', '123654', '4563210101', NULL, NULL, '2025-05-13 02:08:04', '2025-05-13 02:08:04'),
(811, 853, '2025-28', '234567891234', 'Amit Das', 'Nita Das', '2006-12-05', 'Indian', 'SC', 'M', 'AB+', 'Hindu', 'Prakash Das', '789 Park Rd, Kolkata', '9832109876', 'Father', 'Day Scholar', '789 Park Rd, Kolkata', 'West Bengal', 'Kolkata', '700001', '9800765432', NULL, NULL, '2025-05-13 05:04:13', '2025-05-13 05:04:13'),
(812, 854, '2025-28', '345678912345', 'Irfan Khan', 'Salma Khan', '2007-11-03', 'Indian', 'General', 'F', 'A-', 'Muslim', 'Amina Khan', '321 River Ln, Lucknow', '9956234875', 'Aunt', 'Hostel', '321 River Ln, Lucknow', 'Uttar Pradesh', 'Lucknow', '226001', '9887766554', NULL, NULL, '2025-05-13 05:04:13', '2025-05-13 05:04:13'),
(850, 894, '2030-33', '123456789012', 'Amit Das', 'Sunita Das', '2004-03-12', 'Indian', 'General', 'F', 'B+', 'Hinduism', 'Anil Das', '12 MG Road, Kolkata', '9876543210', 'Father', 'Hostel', '45 Lake Rd, Kolkata', 'West Bengal', 'Kolkata', '700029', '7890123456', NULL, NULL, '2025-06-12 16:43:06', NULL),
(851, 895, '2030-33', '234567890123', 'Suresh Roy', 'Ruma Roy', '2003-07-18', 'Indian', 'OBC', 'M', 'O+', 'Hinduism', 'Priya Roy', '4B Salt Lake, Kolkata', '9123456780', 'Mother', 'Day Scholar', '33B BLK 4, Salt Lake', 'West Bengal', 'North 24 Parganas', '700064', '7001234567', NULL, NULL, '2025-06-12 16:43:06', NULL),
(852, 896, '2030-33', '345678901234', 'Manoj Sen', 'Lata Sen', '2005-01-05', 'Indian', 'SC', 'F', 'A-', 'Hinduism', 'Shanti Sen', '112 Jadavpur, Kolkata', '9012345678', 'Mother', 'Hostel', '45/7 College St, Kolkata', 'West Bengal', 'South 24 Parganas', '700032', '9638527410', NULL, NULL, '2025-06-12 16:43:06', NULL),
(853, 897, '2030-33', '456789012345', 'Imran Khan', 'Salma Khan', '2002-11-30', 'Indian', 'General', 'M', 'AB+', 'Islam', 'Abbas Khan', '101 Park St, Kolkata', '9876512345', 'Uncle', 'Day Scholar', '90 Kyd St, Kolkata', 'West Bengal', 'Kolkata', '700016', '9123456700', NULL, NULL, '2025-06-12 16:43:07', NULL),
(854, 898, '2030-33', '567890123456', 'Rakesh Singh', 'Kavita Singh', '2004-05-21', 'Indian', 'General', 'F', 'B-', 'Hinduism', 'Raju Singh', '88A New Town, Kolkata', '9900998899', 'Brother', 'Hostel', '34 Sector V, Kolkata', 'West Bengal', 'North 24 Parganas', '700091', '8887654321', NULL, NULL, '2025-06-12 16:43:07', NULL),
(855, 899, '2030-33', '678901234567', 'Suman Bose', 'Tania Bose', '2003-09-08', 'Indian', 'General', 'M', 'O-', 'Hinduism', 'Anirban Bose', '12/9 Dum Dum, Kolkata', '9801234567', 'Uncle', 'Day Scholar', '45 Golpark, Kolkata', 'West Bengal', 'Kolkata', '700030', '9001112233', NULL, NULL, '2025-06-12 16:43:07', NULL),
(856, 900, '2030-33', '789012345678', 'Rajat Paul', 'Nandita Paul', '2005-02-17', 'Indian', 'OBC', 'F', 'A+', 'Christianity', 'Rita Paul', '45 Behala, Kolkata', '9700001122', 'Aunt', 'Hostel', '110 Behala, Kolkata', 'West Bengal', 'South 24 Parganas', '700034', '9445566778', NULL, NULL, '2025-06-12 16:43:07', NULL),
(857, 901, '2030-33', '890123456789', 'Partha Dey', 'Suchitra Dey', '2003-12-25', 'Indian', 'SC', 'M', 'B+', 'Hinduism', 'Anjali Dey', '33 Tollygunge, Kolkata', '9800980077', 'Mother', 'Hostel', '21A Netaji Rd, Kolkata', 'West Bengal', 'Kolkata', '700040', '9330022444', NULL, NULL, '2025-06-12 16:43:08', NULL),
(858, 902, '2030-33', '901234567890', 'Subho Ghosh', 'Deepa Ghosh', '2004-10-01', 'Indian', 'General', 'F', 'AB-', 'Hinduism', 'Soma Ghosh', '12 Lake Gardens, Kolkata', '9876511223', 'Mother', 'Day Scholar', '76/3 Tollygunge, Kolkata', 'West Bengal', 'Kolkata', '700033', '9667788990', NULL, NULL, '2025-06-12 16:43:08', NULL),
(859, 903, '2030-33', '112345678901', 'Sanjoy Mondal', 'Reena Mondal', '2003-08-19', 'Indian', 'SC', 'M', 'O+', 'Hinduism', 'Ratan Mondal', '21B Garia, Kolkata', '9000011223', 'Father', 'Hostel', '12A Garia Station Rd', 'West Bengal', 'South 24 Parganas', '700084', '9556677889', NULL, NULL, '2025-06-12 16:43:08', NULL),
(860, 904, '2030-33', '122345678902', 'Avik Roy', 'Mira Roy', '2004-06-14', 'Indian', 'General', 'F', 'B+', 'Hinduism', 'Mitali Roy', '101 Jessore Rd, Kolkata', '9800112200', 'Mother', 'Day Scholar', '50 Lake Town, Kolkata', 'West Bengal', 'North 24 Parganas', '700089', '9990001112', NULL, NULL, '2025-06-12 16:43:08', NULL),
(861, 905, '2030-33', '132345678903', 'Rajiv Das', 'Anjali Das', '2003-03-11', 'Indian', 'OBC', 'M', 'A+', 'Hinduism', 'Rina Das', '123 Serampore, Hooghly', '9022334455', 'Mother', 'Hostel', '34 Ballygunge, Kolkata', 'West Bengal', 'Hooghly', '712201', '9887665544', NULL, NULL, '2025-06-12 16:43:09', NULL),
(862, 906, '2030-33', '142345678904', 'Tapas Sen', 'Aloka Sen', '2005-07-10', 'Indian', 'General', 'F', 'B-', 'Hinduism', 'Sunil Sen', '18A Baguiati, Kolkata', '9933445566', 'Uncle', 'Day Scholar', '17 Rajarhat, Kolkata', 'West Bengal', 'North 24 Parganas', '700135', '9554332211', NULL, NULL, '2025-06-12 16:43:09', NULL),
(863, 907, '2030-33', '152345678905', 'Tapan Das', 'Mita Das', '2002-04-27', 'Indian', 'SC', 'M', 'AB+', 'Hinduism', 'Nilima Das', '9A Howrah, Shibpur', '9811223344', 'Mother', 'Hostel', '23 Shibpur Rd, Howrah', 'West Bengal', 'Howrah', '711102', '9211223344', NULL, NULL, '2025-06-12 16:43:09', NULL),
(864, 908, '2030-33', '162345678906', 'Pradeep Gupta', 'Renu Gupta', '2004-09-15', 'Indian', 'General', 'F', 'A+', 'Hinduism', 'Manju Gupta', '45A Durgapur', '9001234567', 'Aunt', 'Day Scholar', '22 Sector 2B, Durgapur', 'West Bengal', 'Paschim Bardhaman', '713212', '9888899900', NULL, NULL, '2025-06-12 16:43:09', NULL),
(865, 909, '2030-33', '172345678907', 'Kunal Pal', 'Indira Pal', '2003-01-09', 'Indian', 'OBC', 'M', 'B+', 'Hinduism', 'Bipin Pal', '34C Barrackpore, Kolkata', '9111223344', 'Father', 'Hostel', '10B Belgharia, Kolkata', 'West Bengal', 'North 24 Parganas', '700056', '9655443322', NULL, NULL, '2025-06-12 16:43:10', NULL),
(866, 910, '2030-33', '182345678908', 'Shankar Saha', 'Minu Saha', '2004-12-03', 'Indian', 'SC', 'F', 'B-', 'Hinduism', 'Nibedita Saha', '67 Kestopur, Kolkata', '9765432100', 'Mother', 'Day Scholar', '21A Kestopur, Kolkata', 'West Bengal', 'Kolkata', '700101', '9334455667', NULL, NULL, '2025-06-12 16:43:10', NULL),
(867, 911, '2030-33', '192345678909', 'Jayanta Mitra', 'Suchi Mitra', '2003-06-30', 'Indian', 'General', 'M', 'A-', 'Hinduism', 'Tapas Mitra', '22 Chandannagar, Hooghly', '9933221144', 'Uncle', 'Hostel', '14 Bally, Hooghly', 'West Bengal', 'Hooghly', '712136', '9223344556', NULL, NULL, '2025-06-12 16:43:10', NULL),
(868, 912, '2020-24', '346512789012', 'Arvind Sharma', 'Sunita Sharma', '2003-06-12', 'Indian', 'General', 'M', 'B+', 'Hindu', 'Arvind Sharma', '22 MG Road, Delhi', '9876543210', 'Father', 'Day Scholar', '22 MG Road, Delhi', 'Delhi', 'New Delhi', '110001', '8123456780', NULL, NULL, '2025-06-13 08:34:44', NULL),
(869, 913, '2020-24', '871209384756', 'Rajeev Sinha', 'Neha Sinha', '2004-09-24', 'Indian', 'OBC', 'F', 'O+', 'Hindu', 'Rajeev Sinha', '88 Sector 2, Kolkata', '9834567890', 'Father', 'Hostel', '88 Sector 2, Kolkata', 'West Bengal', 'Kolkata', '700001', '8123456781', NULL, NULL, '2025-06-13 08:34:44', NULL),
(870, 914, '2020-24', '198234509128', 'Suman Roy', 'Ruma Roy', '2003-02-15', 'Indian', 'SC', 'M', 'AB+', 'Hindu', 'Suman Roy', '15 Golpark, Kolkata', '9988776655', 'Father', 'Day Scholar', '15 Golpark, Kolkata', 'West Bengal', 'Kolkata', '700019', '8123456782', NULL, NULL, '2025-06-13 08:34:45', NULL),
(871, 915, '2020-24', '283746501928', 'Pranab Das', 'Rekha Das', '2004-01-10', 'Indian', 'General', 'F', 'B-', 'Hindu', 'Rekha Das', '54 Ballygunge, Kolkata', '9845612345', 'Mother', 'Hostel', '54 Ballygunge, Kolkata', 'West Bengal', 'Kolkata', '700019', '8123456783', NULL, NULL, '2025-06-13 08:34:45', NULL),
(872, 916, '2020-24', '384756129034', 'Irfan Khan', 'Sofia Khan', '2003-05-20', 'Indian', 'OBC', 'M', 'O-', 'Muslim', 'Irfan Khan', '7 Park Street, Kolkata', '9001234567', 'Father', 'Day Scholar', '7 Park Street, Kolkata', 'West Bengal', 'Kolkata', '700016', '8123456784', NULL, NULL, '2025-06-13 08:34:45', NULL),
(873, 917, '2020-24', '983274657128', 'Rajesh Kumar', 'Sita Devi', '2004-03-09', 'Indian', 'SC', 'F', 'A+', 'Hindu', 'Rajesh Kumar', '12 Dhanbad Road, Ranchi', '9056789012', 'Father', 'Hostel', '12 Dhanbad Road, Ranchi', 'Jharkhand', 'Ranchi', '834001', '8123456785', NULL, NULL, '2025-06-13 08:34:45', NULL),
(874, 918, '2020-24', '234981746234', 'Mohan Yadav', 'Kamla Yadav', '2003-12-25', 'Indian', 'OBC', 'M', 'AB-', 'Hindu', 'Mohan Yadav', '45 Lohia Nagar, Patna', '9023456789', 'Father', 'Day Scholar', '45 Lohia Nagar, Patna', 'Bihar', 'Patna', '800001', '8123456786', NULL, NULL, '2025-06-13 08:34:46', NULL),
(875, 919, '2020-24', '908273461238', 'Subhash Dey', 'Anita Dey', '2004-07-21', 'Indian', 'General', 'F', 'A-', 'Hindu', 'Anita Dey', '36 Lake Town, Kolkata', '9812345670', 'Mother', 'Hostel', '36 Lake Town, Kolkata', 'West Bengal', 'Kolkata', '700089', '8123456787', NULL, NULL, '2025-06-13 08:34:46', NULL),
(876, 920, '2020-24', '234712938472', 'Ketan Joshi', 'Rupa Joshi', '2003-08-18', 'Indian', 'General', 'M', 'B+', 'Hindu', 'Ketan Joshi', '99 Mira Road, Mumbai', '9876541230', 'Father', 'Day Scholar', '99 Mira Road, Mumbai', 'Maharashtra', 'Mumbai', '400001', '8123456788', NULL, NULL, '2025-06-13 08:34:46', NULL),
(877, 921, '2020-24', '782349128374', 'Asif Sheikh', 'Naima Sheikh', '2004-11-11', 'Indian', 'OBC', 'F', 'O+', 'Muslim', 'Asif Sheikh', '23 Carter Rd, Bandra', '9765432109', 'Father', 'Hostel', '23 Carter Rd, Bandra', 'Maharashtra', 'Mumbai', '400050', '8123456789', NULL, NULL, '2025-06-13 08:34:46', NULL),
(878, 922, '2020-24', '287341982374', 'Nirmal Saha', 'Meera Saha', '2003-06-01', 'Indian', 'SC', 'M', 'A+', 'Hindu', 'Nirmal Saha', '89 Barrackpore, Kolkata', '9900112233', 'Father', 'Day Scholar', '89 Barrackpore, Kolkata', 'West Bengal', 'North 24 Parganas', '700120', '8123456790', NULL, NULL, '2025-06-13 08:34:47', NULL),
(879, 923, '2020-24', '138472984123', 'Sanjay Singh', 'Manju Singh', '2004-05-03', 'Indian', 'General', 'F', 'B-', 'Hindu', 'Manju Singh', '12 Sector 9, Noida', '9812345623', 'Mother', 'Hostel', '12 Sector 9, Noida', 'Uttar Pradesh', 'Gautam Buddh Nagar', '201301', '8123456791', NULL, NULL, '2025-06-13 08:34:47', NULL),
(880, 924, '2020-24', '938127384652', 'Dinesh Verma', 'Seema Verma', '2003-10-05', 'Indian', 'OBC', 'M', 'O+', 'Hindu', 'Dinesh Verma', '34 Gandhi Nagar, Kanpur', '9797979797', 'Father', 'Day Scholar', '34 Gandhi Nagar, Kanpur', 'Uttar Pradesh', 'Kanpur', '208001', '8123456792', NULL, NULL, '2025-06-13 08:34:47', NULL),
(881, 925, '2020-24', '928374612389', 'Vinod Kumar', 'Kanchan Kumari', '2004-08-30', 'Indian', 'SC', 'F', 'AB+', 'Hindu', 'Kanchan Kumari', '5 Prem Nagar, Dhanbad', '9856231456', 'Mother', 'Hostel', '5 Prem Nagar, Dhanbad', 'Jharkhand', 'Dhanbad', '826001', '8123456793', NULL, NULL, '2025-06-13 08:34:48', NULL),
(882, 926, '2020-24', '384726129837', 'Ajay Banerjee', 'Aloka Banerjee', '2003-03-18', 'Indian', 'General', 'M', 'B+', 'Hindu', 'Ajay Banerjee', '66 Salt Lake, Kolkata', '9823456123', 'Father', 'Day Scholar', '66 Salt Lake, Kolkata', 'West Bengal', 'Kolkata', '700091', '8123456794', NULL, NULL, '2025-06-13 08:34:48', NULL),
(883, 927, '2020-24', '238471298374', 'Rahim Ali', 'Shehnaz Ali', '2004-04-12', 'Indian', 'OBC', 'F', 'A-', 'Muslim', 'Shehnaz Ali', '17 Red Road, Lucknow', '9934561234', 'Mother', 'Hostel', '17 Red Road, Lucknow', 'Uttar Pradesh', 'Lucknow', '226001', '8123456795', NULL, NULL, '2025-06-13 08:34:48', NULL),
(884, 928, '2020-24', '438726189374', 'Partha Ghosh', 'Soma Ghosh', '2003-12-01', 'Indian', 'General', 'M', 'AB-', 'Hindu', 'Partha Ghosh', '48 Behala, Kolkata', '9800980098', 'Father', 'Day Scholar', '48 Behala, Kolkata', 'West Bengal', 'South 24 Parganas', '700034', '8123456796', NULL, NULL, '2025-06-13 08:34:48', NULL),
(885, 929, '2020-24', '102938475610', 'Vivek Mehta', 'Renu Mehta', '2004-02-28', 'Indian', 'General', 'F', 'A+', 'Hindu', 'Renu Mehta', '70 Civil Lines, Agra', '9945623123', 'Mother', 'Hostel', '70 Civil Lines, Agra', 'Uttar Pradesh', 'Agra', '282001', '8123456797', NULL, NULL, '2025-06-13 08:34:49', NULL),
(886, 930, '2020-24', '748291746210', 'Alok Gupta', 'Sneha Gupta', '2003-07-09', 'Indian', 'OBC', 'M', 'B-', 'Hindu', 'Alok Gupta', '39 Raja Bazar, Kolkata', '9812349876', 'Father', 'Day Scholar', '39 Raja Bazar, Kolkata', 'West Bengal', 'Kolkata', '700009', '8123456798', NULL, NULL, '2025-06-13 08:34:49', NULL),
(887, 931, '2020-24', '564738291837', 'Pradip Sen', 'Nandini Sen', '2004-06-22', 'Indian', 'General', 'F', 'O+', 'Hindu', 'Pradip Sen', '88 Ultadanga, Kolkata', '9823456790', 'Father', 'Hostel', '88 Ultadanga, Kolkata', 'West Bengal', 'Kolkata', '700067', '8123456799', NULL, NULL, '2025-06-13 08:34:49', NULL),
(888, 932, '2030-33', '203456789012', 'Rakesh Sharma', 'Sunita Sharma', '2004-05-21', 'Indian', 'General', 'M', 'B+', 'Hinduism', 'Rakesh Sharma', '45 MG Road, Kolkata', '9876543210', 'Father', 'Hostel', '23/2 Lake Town, Kolkata', 'West Bengal', 'Kolkata', '700089', '8012345670', NULL, NULL, '2025-06-13 08:37:30', NULL),
(889, 933, '2030-33', '934567812345', 'Rajeev Sinha', 'Meena Sinha', '2005-08-14', 'Indian', 'OBC', 'F', 'O+', 'Hinduism', 'Rajeev Sinha', '67/3 Salt Lake, Kolkata', '9123487650', 'Father', 'Day Scholar', '14B, Salt Lake City', 'West Bengal', 'North 24 Parganas', '700091', '7890123456', NULL, NULL, '2025-06-13 08:37:31', NULL),
(890, 934, '2030-33', '345678901234', 'Anup Das', 'Rina Das', '2003-11-30', 'Indian', 'SC', 'M', 'A+', 'Hinduism', 'Anup Das', '55/1 Baguiati, Kolkata', '9801234567', 'Father', 'Hostel', '66/3 Garia, Kolkata', 'West Bengal', 'South 24 Parganas', '700084', '9876001122', NULL, NULL, '2025-06-13 08:37:31', NULL),
(891, 935, '2030-33', '123498765432', 'Suman Roy', 'Aloka Roy', '2005-02-10', 'Indian', 'General', 'F', 'AB+', 'Hinduism', 'Suman Roy', '34 Jadavpur, Kolkata', '9812345678', 'Father', 'Day Scholar', '91/A Tollygunge', 'West Bengal', 'Kolkata', '700033', '9123456781', NULL, NULL, '2025-06-13 08:37:31', NULL),
(892, 936, '2030-33', '234567890123', 'Ranjit Ghosh', 'Rita Ghosh', '2004-07-05', 'Indian', 'OBC', 'M', 'O-', 'Hinduism', 'Ranjit Ghosh', '23 Howrah Maidan', '9901234567', 'Father', 'Hostel', '17/B Liluah, Howrah', 'West Bengal', 'Howrah', '711204', '8012567890', NULL, NULL, '2025-06-13 08:37:31', NULL),
(893, 937, '2030-33', '456789012345', 'Bikash Das', 'Sumitra Das', '2005-09-18', 'Indian', 'SC', 'F', 'B-', 'Hinduism', 'Bikash Das', '10/A Durgapur', '9601234567', 'Father', 'Day Scholar', '10A, Bidhannagar', 'West Bengal', 'Bardhaman', '713206', '9876123451', NULL, NULL, '2025-06-13 08:37:32', NULL),
(894, 938, '2030-33', '567890123456', 'Dipankar Sen', 'Roma Sen', '2003-12-22', 'Indian', 'General', 'M', 'A-', 'Hinduism', 'Dipankar Sen', '12/3 Ballygunge', '9612345678', 'Father', 'Hostel', '19 College St, Kolkata', 'West Bengal', 'Kolkata', '700073', '8123456078', NULL, NULL, '2025-06-13 08:37:32', NULL),
(895, 939, '2030-33', '678901234567', 'Aftab Khan', 'Ayesha Khan', '2004-10-01', 'Indian', 'Minority', 'F', 'B+', 'Islam', 'Aftab Khan', '90/4 Park Circus', '9723456789', 'Father', 'Day Scholar', '21B Topsia, Kolkata', 'West Bengal', 'Kolkata', '700039', '8890123456', NULL, NULL, '2025-06-13 08:37:32', NULL),
(896, 940, '2030-33', '789012345678', 'Ravi Kumar', 'Neha Kumar', '2004-04-19', 'Indian', 'General', 'M', 'O+', 'Hinduism', 'Ravi Kumar', '22A Barasat, Kolkata', '9734567890', 'Father', 'Hostel', '56 Kalyani, Nadia', 'West Bengal', 'Nadia', '741235', '9900123456', NULL, NULL, '2025-06-13 08:37:32', NULL),
(897, 941, '2030-33', '890123456789', 'Tapas Paul', 'Malati Paul', '2005-01-11', 'Indian', 'OBC', 'F', 'AB-', 'Hinduism', 'Tapas Paul', '76/5 Serampore', '9745678901', 'Father', 'Day Scholar', '9A, Serampore, Hooghly', 'West Bengal', 'Hooghly', '712201', '7000567890', NULL, NULL, '2025-06-13 08:37:33', NULL),
(898, 942, '2030-33', '901234567890', 'Manoj Bhattacharya', 'Soma Bhattacharya', '2004-06-15', 'Indian', 'General', 'M', 'B+', 'Hinduism', 'Manoj Bhattacharya', '8/2 Lake Gardens', '9756789012', 'Father', 'Hostel', '30B Joka, Kolkata', 'West Bengal', 'Kolkata', '700104', '6789012345', NULL, NULL, '2025-06-13 08:37:33', NULL),
(899, 943, '2030-33', '112233445566', 'Deepak Jain', 'Ritu Jain', '2005-03-27', 'Indian', 'General', 'M', 'A+', 'Jainism', 'Deepak Jain', '15A Burrabazar', '9767890123', 'Father', 'Day Scholar', '5/6 Posta, Kolkata', 'West Bengal', 'Kolkata', '700007', '7012345678', NULL, NULL, '2025-06-13 08:37:33', NULL),
(900, 944, '2030-33', '667788990011', 'Kunal Dey', 'Anjana Dey', '2005-12-02', 'Indian', 'OBC', 'F', 'O+', 'Hinduism', 'Kunal Dey', '18B, Dum Dum', '9880123456', 'Father', 'Day Scholar', '15B, Dum Dum', 'West Bengal', 'North 24 Parganas', '700028', '8123000456', NULL, NULL, '2025-06-13 08:37:33', NULL),
(901, 945, '2030-33', '778899001122', 'Pranab Nath', 'Manju Nath', '2003-09-10', 'Indian', 'SC', 'M', 'B-', 'Hinduism', 'Pranab Nath', '20, Asansol', '9891234567', 'Father', 'Hostel', '30, Raniganj', 'West Bengal', 'Paschim Bardhaman', '713358', '8789012345', NULL, NULL, '2025-06-13 08:37:34', NULL),
(902, 946, '2030-33', '889900112233', 'Arup Banerjee', 'Lata Banerjee', '2004-01-08', 'Indian', 'General', 'F', 'A-', 'Hinduism', 'Arup Banerjee', '11A, Behala', '9800123456', 'Father', 'Day Scholar', '5 Behala Chowrasta', 'West Bengal', 'Kolkata', '700034', '9091234567', NULL, NULL, '2025-06-13 08:37:34', NULL),
(903, 947, '2030-33', '990011223344', 'Imran Ahmed', 'Farah Ahmed', '2005-04-17', 'Indian', 'Minority', 'M', 'O+', 'Islam', 'Imran Ahmed', '42, Tiljala Road', '9811123456', 'Father', 'Hostel', '80, Park Street', 'West Bengal', 'Kolkata', '700016', '8123012345', NULL, NULL, '2025-06-13 08:37:34', NULL),
(904, 948, '2030-33', '101112131415', 'Subrata Ghosh', 'Jaya Ghosh', '2003-06-06', 'Indian', 'OBC', 'F', 'B+', 'Hinduism', 'Subrata Ghosh', '13, Konnagar', '9822123456', 'Father', 'Day Scholar', '7A, Uttarpara', 'West Bengal', 'Hooghly', '712235', '8001122334', NULL, NULL, '2025-06-13 08:37:34', NULL),
(905, 949, '2030-33', '121314151617', 'Sanjay Verma', 'Kiran Verma', '2004-08-20', 'Indian', 'General', 'M', 'AB+', 'Hinduism', 'Sanjay Verma', '61, Siliguri', '9843012345', 'Father', 'Hostel', '55, Matigara', 'West Bengal', 'Darjeeling', '734010', '8899123456', NULL, NULL, '2025-06-13 08:37:35', NULL),
(906, 950, '2030-33', '131415161718', 'Ajay Bose', 'Mitali Bose', '2005-07-29', 'Indian', 'General', 'F', 'A+', 'Hinduism', 'Ajay Bose', '33, Khardah', '9854123456', 'Father', 'Day Scholar', '8/5 Panihati', 'West Bengal', 'North 24 Parganas', '700114', '8123498765', NULL, NULL, '2025-06-13 08:37:35', NULL),
(907, 951, '2030-33', '456789123456', 'Dipankar Sen', 'Mitali Sen', '2004-06-15', 'Indian', 'General', 'M', 'B+', 'Hindu', 'Dipankar Sen', '12B, Park Street', '9876543210', 'Father', 'Hosteller', '12B, Park Street, Kolkata', 'West Bengal', 'Kolkata', '700016', '9800012345', NULL, NULL, '2025-06-13 08:37:51', NULL),
(908, 952, '2030-33', '564738291028', 'Subir Das', 'Ruma Das', '2005-01-12', 'Indian', 'SC', 'F', 'O+', 'Hindu', 'Subir Das', '45A, Gariahat Rd', '9876543211', 'Father', 'Day Scholar', '45A, Gariahat Rd, Kolkata', 'West Bengal', 'Kolkata', '700019', '9800012346', NULL, NULL, '2025-06-13 08:37:52', NULL),
(909, 953, '2030-33', '987654321012', 'Arup Mitra', 'Sunita Mitra', '2004-11-20', 'Indian', 'OBC', 'M', 'A+', 'Hindu', 'Arup Mitra', '88, College St', '9876543212', 'Father', 'Hosteller', '88, College St, Kolkata', 'West Bengal', 'Kolkata', '700073', '9800012347', NULL, NULL, '2025-06-13 08:37:52', NULL),
(910, 954, '2030-33', '123456789012', 'Tarun Ghosh', 'Swati Ghosh', '2003-08-25', 'Indian', 'General', 'F', 'AB+', 'Hindu', 'Tarun Ghosh', '100, Salt Lake Sector', '9876543213', 'Father', 'Day Scholar', 'Salt Lake, Kolkata', 'West Bengal', 'Kolkata', '700091', '9800012348', NULL, NULL, '2025-06-13 08:37:52', NULL),
(911, 955, '2030-33', '234567891234', 'Anil Roy', 'Rekha Roy', '2004-03-10', 'Indian', 'OBC', 'M', 'B-', 'Hindu', 'Anil Roy', '12, Behala Rd', '9876543214', 'Father', 'Hosteller', 'Behala, Kolkata', 'West Bengal', 'Kolkata', '700034', '9800012349', NULL, NULL, '2025-06-13 08:37:52', NULL),
(912, 956, '2030-33', '567891234567', 'Niraj Paul', 'Kalyani Paul', '2005-05-22', 'Indian', 'General', 'F', 'O-', 'Hindu', 'Niraj Paul', '67, Jadavpur', '9876543215', 'Father', 'Day Scholar', 'Jadavpur, Kolkata', 'West Bengal', 'Kolkata', '700032', '9800012350', NULL, NULL, '2025-06-13 08:37:53', NULL),
(913, 957, '2030-33', '678912345678', 'Prabir Dey', 'Soma Dey', '2003-12-01', 'Indian', 'SC', 'M', 'A-', 'Hindu', 'Prabir Dey', '102, Ballygunge Place', '9876543216', 'Father', 'Hosteller', 'Ballygunge, Kolkata', 'West Bengal', 'Kolkata', '700019', '9800012351', NULL, NULL, '2025-06-13 08:37:53', NULL),
(914, 958, '2030-33', '789123456789', 'Ranjit Dasgupta', 'Lila Dasgupta', '2004-10-09', 'Indian', 'General', 'F', 'B+', 'Hindu', 'Ranjit Dasgupta', '23A, Howrah Maidan', '9876543217', 'Father', 'Day Scholar', 'Howrah Maidan, Howrah', 'West Bengal', 'Howrah', '711101', '9800012352', NULL, NULL, '2025-06-13 08:37:53', NULL),
(915, 959, '2030-33', '890123456789', 'Nirmal Sarkar', 'Rita Sarkar', '2005-06-14', 'Indian', 'OBC', 'M', 'AB-', 'Hindu', 'Nirmal Sarkar', '78, Serampore Rd', '9876543218', 'Father', 'Hosteller', 'Serampore, Hooghly', 'West Bengal', 'Hooghly', '712201', '9800012353', NULL, NULL, '2025-06-13 08:37:53', NULL),
(916, 960, '2030-33', '901234567890', 'Suman Bhattacharjee', 'Nibedita Bhattacharjee', '2003-07-30', 'Indian', 'General', 'F', 'O+', 'Hindu', 'Suman Bhattacharjee', '14, Kankurgachi', '9876543219', 'Father', 'Day Scholar', 'Kankurgachi, Kolkata', 'West Bengal', 'Kolkata', '700054', '9800012354', NULL, NULL, '2025-06-13 08:37:54', NULL),
(917, 961, '2030-33', '321098765432', 'Ratan Sen', 'Bela Sen', '2004-09-21', 'Indian', 'OBC', 'M', 'B+', 'Hindu', 'Ratan Sen', '12, Dum Dum Rd', '9876543220', 'Father', 'Hosteller', 'Dum Dum, Kolkata', 'West Bengal', 'Kolkata', '700030', '9800012355', NULL, NULL, '2025-06-13 08:37:54', NULL),
(918, 962, '2030-33', '432109876543', 'Sanjay Mukherjee', 'Arpita Mukherjee', '2005-02-17', 'Indian', 'General', 'F', 'A+', 'Hindu', 'Sanjay Mukherjee', '54, Tollygunge', '9876543221', 'Father', 'Day Scholar', 'Tollygunge, Kolkata', 'West Bengal', 'Kolkata', '700033', '9800012356', NULL, NULL, '2025-06-13 08:37:54', NULL),
(919, 963, '2030-33', '543210987654', 'Partha Das', 'Kajal Das', '2004-04-08', 'Indian', 'SC', 'M', 'O+', 'Hindu', 'Partha Das', '89, Barasat Rd', '9876543222', 'Father', 'Hosteller', 'Barasat, North 24 Parganas', 'West Bengal', 'North 24 Parganas', '700124', '9800012357', NULL, NULL, '2025-06-13 08:37:54', NULL),
(920, 964, '2030-33', '654321098765', 'Bijoy Sen', 'Rina Sen', '2003-11-12', 'Indian', 'General', 'F', 'AB+', 'Hindu', 'Bijoy Sen', '32, Lake Gardens', '9876543223', 'Father', 'Day Scholar', 'Lake Gardens, Kolkata', 'West Bengal', 'Kolkata', '700045', '9800012358', NULL, NULL, '2025-06-13 08:37:55', NULL),
(921, 965, '2030-33', '765432109876', 'Babul Pal', 'Sujata Pal', '2005-03-25', 'Indian', 'OBC', 'M', 'B-', 'Hindu', 'Babul Pal', '46, Barrackpore', '9876543224', 'Father', 'Hosteller', 'Barrackpore, North 24 Pgs', 'West Bengal', 'North 24 Parganas', '700120', '4771234567', NULL, NULL, '2025-06-13 08:37:55', NULL),
(922, 966, '2050-55', '765432109876', 'Babul Pal', 'Sujata Pal', '2005-03-25', 'Indian', 'OBC', 'M', 'B-', 'Hindu', 'Babul Pal', '46, Barrackpore', '9876543224', 'Father', 'Hosteller', 'Barrackpore, North 24 Pgs', 'West Bengal', 'North 24 Parganas', '700120', '3012457896', NULL, NULL, '2025-06-13 08:37:55', NULL),
(923, 967, '2050-55', '462819302839', 'Rajiv Mukherjee', 'Sima Mukherjee', '2004-07-12', 'Indian', 'General', 'M', 'B+', 'Hindu', 'Rajiv Mukherjee', '12 Lake Town, Kolkata', '9876543210', 'Father', 'Day Scholar', '12 Lake Town, Kolkata', 'West Bengal', 'Kolkata', '700089', '9800000011', NULL, NULL, '2025-06-13 15:42:00', NULL),
(924, 968, '2050-55', '519310493827', 'Sunil Das', 'Meena Das', '2003-09-05', 'Indian', 'SC', 'F', 'O+', 'Hindu', 'Sunil Das', '88 BT Road, Howrah', '9876500001', 'Father', 'Hostel', '88 BT Road, Howrah', 'West Bengal', 'Howrah', '711101', '9800000012', NULL, NULL, '2025-06-13 15:42:00', NULL),
(925, 969, '2050-55', '378213457894', 'Manoj Sharma', 'Neha Sharma', '2004-01-20', 'Indian', 'OBC', 'M', 'A+', 'Hindu', 'Manoj Sharma', '3A Park Street, Siliguri', '9876500002', 'Father', 'Day Scholar', '3A Park Street, Siliguri', 'West Bengal', 'Darjeeling', '734001', '9800000013', NULL, NULL, '2025-06-13 15:42:00', NULL),
(926, 970, '2050-55', '914248720193', 'Amit Sen', 'Rita Sen', '2004-03-11', 'Indian', 'General', 'F', 'AB+', 'Hindu', 'Amit Sen', '45 Raja Bazar, Kolkata', '9876500003', 'Father', 'Hostel', '45 Raja Bazar, Kolkata', 'West Bengal', 'Kolkata', '700016', '9800000014', NULL, NULL, '2025-06-13 15:42:01', NULL),
(927, 971, '2050-55', '130848195637', 'Subhas Ghosh', 'Jaya Ghosh', '2003-12-25', 'Indian', 'OBC', 'M', 'O−', 'Hindu', 'Subhas Ghosh', '89/2 Naktala, Kolkata', '9876500004', 'Father', 'Day Scholar', '89/2 Naktala, Kolkata', 'West Bengal', 'South 24 Parganas', '700047', '9800000015', NULL, NULL, '2025-06-13 15:42:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_update_request`
--

CREATE TABLE `student_update_request` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `aadhaar_no` varchar(255) NOT NULL,
  `student_address` text NOT NULL,
  `alternate_mobile` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `guardian_name` varchar(255) NOT NULL,
  `guardian_mobile` varchar(255) NOT NULL,
  `guardian_address` text NOT NULL,
  `relation_with_guardian` varchar(255) NOT NULL,
  `residence_status` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `reg_no` varchar(255) DEFAULT NULL,
  `roll_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_update_request`
--

INSERT INTO `student_update_request` (`id`, `userid`, `status`, `remark`, `user_email`, `name`, `dob`, `nationality`, `category`, `sex`, `father_name`, `mother_name`, `blood_group`, `religion`, `aadhaar_no`, `student_address`, `alternate_mobile`, `state`, `district`, `pin`, `contact`, `guardian_name`, `guardian_mobile`, `guardian_address`, `relation_with_guardian`, `residence_status`, `session`, `reg_no`, `roll_no`, `created_at`, `updated_at`) VALUES
(11, 844, '1', 'Approved all the data', 'kingkogli@gmail.com', 'Virat Kohli', '1998-10-18', 'indian', 'Cricketer', 'Male', 'Kohli Father', 'kohli Mother', 'B+', 'hindu', '101010101010', 'India', '1236547890', 'Delhi', 'North 24 PGS', '123654', '1236547890', 'Kohli father', '1236547890', 'RCB', 'Father', 'Ground', '2022-25', NULL, NULL, '2025-05-11 23:50:05', NULL),
(12, 844, '1', 'success', 'kingkogli@gmail.com', 'King Kohli', '1998-10-12', 'indian', 'player', 'Female', 'Kohli Father', 'kohli Mother', 'B+', 'hindu', '101010101010', 'India', '1236547895', 'Delhi', 'North 24 PGS', '123654', '1236547890', 'Kohli father', '1236547890', 'RCB', 'Father', 'Ground', '2022-25', '111111111111', '111111111110', '2025-06-05 08:01:57', '2025-06-05 08:11:25'),
(13, 844, '2', 'reject', 'kingkogli@gmail.com', 'King Kohli', '1998-10-12', 'indian', 'player', 'Female', 'Kohli Father', 'kohli Mother', 'B+', 'hindu', '101010101010', 'India', '1236547895', 'Delhi', 'North 24 PGS', '123654', '1236547890', 'Kohli father', '1236547890', 'RCB', 'Father', 'Ground', '2022-25', '111111111111', '111111111110', '2025-06-05 18:01:20', '2025-06-10 06:25:28'),
(14, 844, '1', 'success', 'kingkogli@gmail.com', 'King Kohli', '1998-10-12', 'indian', 'OBC', 'Female', 'Kohli Father', 'kohli Mother', 'B+', 'Sikh', '101010101011', 'India', '1236547895', 'Delhi', 'North 24 PGS', '123654', '1236547898', 'Kohli father', '1236547890', 'RCB', 'Father', 'Ground', '2022-25', '111111111111', '111111111110', '2025-06-10 06:26:58', '2025-06-10 16:11:52'),
(15, 844, '2', 'reject', 'kingkogli@gmail.com', 'King Kohli', '1998-10-12', 'indian', 'OBC', 'Female', 'Kohli Father', 'kohli Mother', 'B+', 'Sikh', '101010101011', 'India', '1236547895', 'Delhi', 'North 24 PGS', '123654', '1236547898', 'Kohli father', '1236547890', 'RCB', 'Father', 'Ground', '2022-25', '111111111111', '111111111110', '2025-06-12 06:18:05', '2025-06-13 06:22:51'),
(16, 844, '0', 'success', 'kingkogli@gmail.com', 'King Kohli', '1998-10-12', 'indian', 'GEN', 'Male', 'Kohli Father', 'kohli Mother', 'B+', 'Sikh', '101010101012', 'India', '1236547895', 'Delhi', 'North 24 PGS', '123654', '1236547898', 'Kohli father', '1236547890', 'RCB', 'Father', 'Ground', '2022-25', '111111111111', '111111111110', '2025-06-13 06:23:25', '2025-06-13 06:24:13');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `subject_type` enum('theory','practical') NOT NULL,
  `marks` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `session_id`, `department_id`, `semester_id`, `subject_name`, `subject_code`, `subject_type`, `marks`, `created_at`, `updated_at`) VALUES
(1, 4, 27, 3, 'Computer Science', 'BCA123', 'theory', 70, '2025-05-12 11:11:51', NULL),
(4, 4, 28, 2, 'DATA SCIENCE', 'BCA123', 'theory', 100, '2025-05-12 11:43:09', NULL),
(6, 4, 28, 2, 'PYTHON PROGRAMMING', 'BCA1237', 'theory', 100, '2025-05-12 12:13:40', NULL),
(7, 4, 27, 3, 'PYTHON PROGRAMMING', 'BCA1237', 'theory', 100, '2025-05-14 05:59:56', NULL),
(10, 4, 27, 3, 'PYTHON PROGRAMMING', 'BCA12344', 'practical', 100, '2025-06-05 07:13:08', NULL),
(11, 4, 27, 1, 'JAVA', 'JAVA1235', 'theory', 100, '2025-06-11 10:54:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `theory_exams`
--

CREATE TABLE `theory_exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mentoring_info_id` bigint(20) UNSIGNED NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `paper_code` varchar(255) DEFAULT NULL,
  `ca1` int(11) DEFAULT NULL,
  `ca2` int(11) DEFAULT NULL,
  `ca3` int(11) DEFAULT NULL,
  `ca4` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theory_exams`
--

INSERT INTO `theory_exams` (`id`, `mentoring_info_id`, `subject_name`, `paper_code`, `ca1`, `ca2`, `ca3`, `ca4`, `created_at`, `updated_at`) VALUES
(44, 15, 'JAVA', 'JAVA1235', 14, 23, 18, NULL, '2025-06-11 15:54:21', NULL),
(59, 14, 'Computer Science', 'BCA123', 10, 18, 14, 20, '2025-06-11 16:54:48', NULL),
(60, 14, 'PYTHON PROGRAMMING', 'BCA1237', 25, 22, 21, 19, '2025-06-11 16:54:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Student name',
  `email` varchar(255) NOT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `contact` varchar(22) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'Student',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `department`, `name`, `email`, `user_image`, `contact`, `password`, `usertype`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Souvik Mukherjee', 'mukherjeesouvik2043@gmail.com', NULL, '1234567890', '$2y$12$4d/yOdT.WMc324UWRFAY8.YsS2TyrZZeU4u5lKRnBen4gAJ0SmKPO', 'Superadmin', NULL, '2024-10-08 11:35:34', '2025-05-05 01:32:12'),
(756, '21', 'Another Mentor', 'anothermentor456@ecmt.in', NULL, '1236547801', '$2y$12$920Kwj2NlJNB7198lqpXzORFjwod5Ah3nEFFdAw8uPq1EKRe9ODrC', 'Mentor', NULL, '2024-11-14 18:30:00', NULL),
(843, '17', 'Mukherjee Souvik', 'souvikmentor12@gmail.com', NULL, '1236547955', '$2y$12$sgcrWTeYyy2oM4VWgSwjSeK3EBTwAYRhX77OIHW2nc4ilbwa2EeCm', 'Mentor', NULL, '2025-04-15 18:30:00', '2025-06-05 18:30:00'),
(844, '29', 'King Kohli', 'kingkogli@gmail.com', '1749798006.jpg', '1236547898', '$2y$12$5wlUBzzwBwlgj4zG9twIkeJ170H8UA0oKJcyGqd8DQBLfYbGUmm9S', 'Student', NULL, '2025-05-11 11:07:58', '2025-06-13 06:24:13'),
(845, '28', 'Rohit Sharma', 'rohitsharma@gmail.com', NULL, '1236547890', '$2y$12$6SK6YsgvS7cDDsBx/YGTF.2xSfd/z2QpPwoGXX9d7dTLCu1x5hK/m', 'Student', NULL, '2025-05-11 11:07:59', '2025-05-11 11:07:59'),
(849, '33', 'ABD', 'abd@gmail.com', NULL, '2020202020', '$2y$12$SpSR18o9L9rsZm38y2Z8LukfL/6XNIlPMOvg0s90hb.Cu.bZiYp/W', 'Student', NULL, '2025-05-13 02:08:04', '2025-05-13 02:08:04'),
(853, '34', 'Rohan Das', 'rohan.das@example.com', NULL, '9832001234', '$2y$12$odhCgudRzSl02Gk1hOiDnOlM6dRPJNOTx9Kl6IHNRFZUA4UGF2mkK', 'Student', NULL, '2025-05-13 05:04:13', '2025-05-13 05:04:13'),
(854, '34', 'Zoya Khan', 'zoya.khan@example.com', NULL, '9900123456', '$2y$12$6WYl6Ok/82chORBpxOplH.g1NJx9iCs0I914sRxizNQuWVChWuosm', 'Student', NULL, '2025-05-13 05:04:13', '2025-05-13 05:04:13'),
(856, '27', 'Soumen Sarkar1', 'soumen1@gmail.com', NULL, '1212121212', '$2y$12$RRWg.XMG8PwhSljFn5BK5.Nx8UPSLn72yKZf.JZhpR.dqpV.8.SY6', 'Mentor', NULL, '2025-05-12 18:30:00', NULL),
(857, '28', 'Demo Name', 'demoname@gmail.com', NULL, '1234567892', '$2y$12$APTbnjrfV2IaniXCOV7/buJ2YczT/0pruKGBIh47X5hr0jvTi7gKi', 'Admin', NULL, '2025-06-09 18:30:00', NULL),
(894, '37', 'Riya Das', 'riyadas01@example.com', NULL, '9876501234', '$2y$12$hlgYd3F.iRG2.Tbs2r4ZdOQs9VScmnYB1FWQk6Gw7B/mU5CUHd85W', 'Student', NULL, '2025-06-12 16:43:06', '2025-06-12 16:43:06'),
(895, '37', 'Rahul Roy', 'rahul.roy@example.com', NULL, '9834502398', '$2y$12$zXj2asa/V9KJjxS89POS4O66WamALm8ct46n/h7P7mtHgn4ArH3yO', 'Student', NULL, '2025-06-12 16:43:06', '2025-06-12 16:43:06'),
(896, '37', 'Sneha Sen', 'snehasen05@example.com', NULL, '9512345678', '$2y$12$RPCVptdyGfchQkyI08Gmuen0.9GHPzewaBHW1uuCB1te/jN.mFQvq', 'Student', NULL, '2025-06-12 16:43:06', '2025-06-12 16:43:06'),
(897, '37', 'Aryan Khan', 'aryan.k@example.com', NULL, '9988776655', '$2y$12$/f6yOc95xgEyeQo2jHr4xewfNGkgfxNOgwtvoSEtIeZg78lJLQXXi', 'Student', NULL, '2025-06-12 16:43:07', '2025-06-12 16:43:07'),
(898, '37', 'Priya Singh', 'priyasingh21@example.com', NULL, '9876001122', '$2y$12$gwTijBZibd7UjZ3oSMBDzuqrZ96.t3WySSMc4zLKu/0gZGM11lPzK', 'Student', NULL, '2025-06-12 16:43:07', '2025-06-12 16:43:07'),
(899, '37', 'Aditya Bose', 'adityabose03@example.com', NULL, '9876100011', '$2y$12$BiZmkK6/ZsgJFW0CWftkyeF0xuW3IrgdsQmx3jwe83Sq1vtUd3IwW', 'Student', NULL, '2025-06-12 16:43:07', '2025-06-12 16:43:07'),
(900, '37', 'Meera Paul', 'meerapaul17@example.com', NULL, '9833456112', '$2y$12$F.a7HYGyTKidTdtPA6UwuObBZN1yzKY4wQdnEP7A2kZTL5M4c39TK', 'Student', NULL, '2025-06-12 16:43:07', '2025-06-12 16:43:07'),
(901, '37', 'Kunal Dey', 'kunaldey25@example.com', NULL, '9877003211', '$2y$12$DE8ufpldNkQ3Fx/ROMV6jOQMVgh4.fPdFvmFoL.qYSnqflqYLR9Ee', 'Student', NULL, '2025-06-12 16:43:08', '2025-06-12 16:43:08'),
(902, '37', 'Ananya Ghosh', 'ananyag@example.com', NULL, '9765432109', '$2y$12$w4l0wS51SfpYCun2q7n30uTuHx1oAgDr1eFSBaktoh3zjnlJfuRc2', 'Student', NULL, '2025-06-12 16:43:08', '2025-06-12 16:43:08'),
(903, '37', 'Rohit Mondal', 'rohitm19@example.com', NULL, '9654321987', '$2y$12$4ntvjFrR7NpmO9oFWueUhOBKqFMNkh3eGEjNK/MlQb4hv8SL7J.eO', 'Student', NULL, '2025-06-12 16:43:08', '2025-06-12 16:43:08'),
(904, '37', 'Tanisha Roy', 'tanisharoy@example.com', NULL, '9871122334', '$2y$12$mkfXQ3a8x3/NhyG2irQOGuu9zy9qdiCYEF/YJwopx26BCKb8arXpu', 'Student', NULL, '2025-06-12 16:43:08', '2025-06-12 16:43:08'),
(905, '37', 'Abhishek Das', 'abhishekd03@example.com', NULL, '9123344556', '$2y$12$.7DZv/MZflLk6LZ/CLyHp.WL8C2BPkX9qzm2VqgKq9iBgpEhUthry', 'Student', NULL, '2025-06-12 16:43:09', '2025-06-12 16:43:09'),
(906, '37', 'Ishita Sen', 'ishitasen@example.com', NULL, '9771122334', '$2y$12$tbgNPWZ0pc4C2ij.P.0xAejczHBzEJ3a59aJLrQorm7V3c58q9efC', 'Student', NULL, '2025-06-12 16:43:09', '2025-06-12 16:43:09'),
(907, '37', 'Soham Das', 'sohamdas02@example.com', NULL, '9844332211', '$2y$12$QNaoD8YiLe0FITnZ64RdLed9WxOURzRzNXRxS6MyPGsKp0F4BhAtW', 'Student', NULL, '2025-06-12 16:43:09', '2025-06-12 16:43:09'),
(908, '37', 'Neha Gupta', 'nehag15@example.com', NULL, '9876554433', '$2y$12$zufUyLflK3FkEY2kRGEfbOIgA3.R8XSuNXqwwvbPz.xCr.31pGera', 'Student', NULL, '2025-06-12 16:43:09', '2025-06-12 16:43:09'),
(909, '37', 'Arjun Pal', 'arjunp@example.com', NULL, '9777665544', '$2y$12$FF8Sh9rknuXRUykMAlatuerxVb691LgdU2LcwrvNR/BfaWKiVwr.W', 'Student', NULL, '2025-06-12 16:43:10', '2025-06-12 16:43:10'),
(910, '37', 'Payal Saha', 'payalsaha03@example.com', NULL, '9878776655', '$2y$12$0OPR0HHFugtmzJtdJlq.lefPq86646I0pHsx2I4eI6ffkTte8wYri', 'Student', NULL, '2025-06-12 16:43:10', '2025-06-12 16:43:10'),
(911, '37', 'Sayan Mitra', 'sayanmitra30@example.com', NULL, '9677889900', '$2y$12$2JQzTUywADEAqVlnaQR9Kei6InrjdJUbcHkS4vKu0Da.B4D7BvA3e', 'Student', NULL, '2025-06-12 16:43:10', '2025-06-12 16:43:10'),
(912, '36', 'Rohan Sharma', 'rohan.sharma01@gmail.com', NULL, '9123456780', '$2y$12$lbbUfWvCcsRlr8FOhTbe6eQD6y3aVHZuAJ.VcuzeHSBfE6sWJk6XG', 'Student', NULL, '2025-06-13 08:34:44', '2025-06-13 08:34:44'),
(913, '36', 'Priya Sinha', 'priya.sinha02@gmail.com', NULL, '9123456781', '$2y$12$1FzwyTj6tDGGP/yTiddmS.Ccot075gwfewFxtY9Zz/rd.J15VeaA.', 'Student', NULL, '2025-06-13 08:34:44', '2025-06-13 08:34:44'),
(914, '36', 'Aniket Roy', 'aniket.roy03@gmail.com', NULL, '9123456782', '$2y$12$y.7CJKGrCI.Pe0cec4uOVOkmNLN.bBfgpm15HWhh23y4TBKqM8brS', 'Student', NULL, '2025-06-13 08:34:45', '2025-06-13 08:34:45'),
(915, '36', 'Sneha Das', 'sneha.das04@gmail.com', NULL, '9123456783', '$2y$12$SxMxl.J.woBs0grKm3zx..BkFQ3dzJb2rA/BBhxD1YwkTWQA11yRu', 'Student', NULL, '2025-06-13 08:34:45', '2025-06-13 08:34:45'),
(916, '36', 'Ayaan Khan', 'ayaan.khan05@gmail.com', NULL, '9123456784', '$2y$12$0uPsYAh8vXbu8TXAy9FxIudwxBD/r7g/xK5t8dG7EFSBHAO/PiarS', 'Student', NULL, '2025-06-13 08:34:45', '2025-06-13 08:34:45'),
(917, '36', 'Meena Kumari', 'meena.kumari06@gmail.com', NULL, '9123456785', '$2y$12$1L3Lr114Q49wUCW3Z5CkpO5ynlRWSBqxR0MW7vcv6mBL9oejH2yji', 'Student', NULL, '2025-06-13 08:34:45', '2025-06-13 08:34:45'),
(918, '36', 'Arjun Yadav', 'arjun.yadav07@gmail.com', NULL, '9123456786', '$2y$12$1CYF8V1t/TY3CmNx0USuHeEIHSDaW..8oLxxUJwBH0t2hfvUGK0j2', 'Student', NULL, '2025-06-13 08:34:46', '2025-06-13 08:34:46'),
(919, '36', 'Tina Dey', 'tina.dey08@gmail.com', NULL, '9123456787', '$2y$12$usUctBNnvz8J4lDCsMCB0.DFVRiAjkeUQUysvDscYCZ4t55gnSguK', 'Student', NULL, '2025-06-13 08:34:46', '2025-06-13 08:34:46'),
(920, '36', 'Vikram Joshi', 'vikram.joshi09@gmail.com', NULL, '9123456788', '$2y$12$8gkc5O4/WYg95mXiIIITku52ULuFe4ZRdLa187bTpahTNajHUhDaG', 'Student', NULL, '2025-06-13 08:34:46', '2025-06-13 08:34:46'),
(921, '36', 'Sana Sheikh', 'sana.sheikh10@gmail.com', NULL, '9123456789', '$2y$12$TqsBbAKIzsiuMG/B28A3eeReshBBouUiGG/.BT/P.1ZBmYeatD/a.', 'Student', NULL, '2025-06-13 08:34:46', '2025-06-13 08:34:46'),
(922, '36', 'Deepak Saha', 'deepak.saha11@gmail.com', NULL, '9123456790', '$2y$12$8eBZyHY6R4BDGHP1xV9tEuqUWrmWQ9wmahjRGCqujynn4ZSbx/Aii', 'Student', NULL, '2025-06-13 08:34:47', '2025-06-13 08:34:47'),
(923, '36', 'Neha Singh', 'neha.singh12@gmail.com', NULL, '9123456791', '$2y$12$wUD9pZVcL33mr.dwW2KU0.aAAgpeGyPMCzChkUov.8cBpgYei66Ty', 'Student', NULL, '2025-06-13 08:34:47', '2025-06-13 08:34:47'),
(924, '36', 'Rahul Verma', 'rahul.verma13@gmail.com', NULL, '9123456792', '$2y$12$Rnw5UA9YxBJ1vjUmZadZ9evjReMQJdQdNGNY6jHOIWoFt6bgDTSYW', 'Student', NULL, '2025-06-13 08:34:47', '2025-06-13 08:34:47'),
(925, '36', 'Aarti Kumari', 'aarti.kumari14@gmail.com', NULL, '9123456793', '$2y$12$JkUG8Gbp7xHou4l3l5BZju0Am6G7S5s1ZWraxb8Lrfrd3v2PWkyyi', 'Student', NULL, '2025-06-13 08:34:48', '2025-06-13 08:34:48'),
(926, '36', 'Soham Banerjee', 'soham.banerjee15@gmail.com', NULL, '9123456794', '$2y$12$xRB4WCJDsS1aMyZM7HGFu.IfsN.vf8m34ZZqLo.pkHJrTA/KmSL86', 'Student', NULL, '2025-06-13 08:34:48', '2025-06-13 08:34:48'),
(927, '36', 'Zoya Ali', 'zoya.ali16@gmail.com', NULL, '9123456795', '$2y$12$3zCIfGPPLD.FujYi0wdQ1ObEQi.5wGO9.vcCfJN0ox4zPmb4harmm', 'Student', NULL, '2025-06-13 08:34:48', '2025-06-13 08:34:48'),
(928, '36', 'Abhishek Ghosh', 'abhishek.ghosh17@gmail.com', NULL, '9123456796', '$2y$12$mvINDHu9hfHFm/aF1AqDIuJj/sDaS0YBtDbuzTAGPgYhOAWYr/GYW', 'Student', NULL, '2025-06-13 08:34:48', '2025-06-13 08:34:48'),
(929, '36', 'Anjali Mehta', 'anjali.mehta18@gmail.com', NULL, '9123456797', '$2y$12$gjVBe/L7RmQfr8P6fvs4F.5bDxoycW89hnKI.id8uU7gz8GT30YDe', 'Student', NULL, '2025-06-13 08:34:49', '2025-06-13 08:34:49'),
(930, '36', 'Kunal Gupta', 'kunal.gupta19@gmail.com', NULL, '9123456798', '$2y$12$zuOnAEnmzgxjf5OTQqxbtO5MuJSuI/JvwBO4uHVFhWDAJyb3HNvSi', 'Student', NULL, '2025-06-13 08:34:49', '2025-06-13 08:34:49'),
(931, '36', 'Isha Sen', 'isha.sen20@gmail.com', NULL, '9123456799', '$2y$12$uA3sEJ3sV1rcAaKh5f8ikuOsSOzE9jUMD5AL0Z9xr3zumZ45YWWji', 'Student', NULL, '2025-06-13 08:34:49', '2025-06-13 08:34:49'),
(932, '37', 'Aarav Sharma', 'aarav.sharma@example.com', NULL, '9123456789', '$2y$12$E0Tridz6aZ7UPLCcV/1wGeUoZAsfxQa5hzjQxWxhBn/Uv7uKDCF.S', 'Student', NULL, '2025-06-13 08:37:30', '2025-06-13 08:37:30'),
(933, '37', 'Priya Sinha', 'priya.sinha@example.com', NULL, '9876501234', '$2y$12$w/3vZeQCEZUxbq10FGO5HONDP3q4fD22GLqeot5dhoBn1HhKxHz4O', 'Student', NULL, '2025-06-13 08:37:31', '2025-06-13 08:37:31'),
(934, '37', 'Rohit Das', 'rohit.das@example.com', NULL, '9988776655', '$2y$12$MoaKgEwJLWWl8fSH0CNC9.CQa1aA0e43rqYvXTxt8nIGa67YVu4sW', 'Student', NULL, '2025-06-13 08:37:31', '2025-06-13 08:37:31'),
(935, '37', 'Sneha Roy', 'sneha.roy@example.com', NULL, '7000123456', '$2y$12$uMCXgwOjoa.uoY17q4OIKOTSfDJ8E3f1YP3obpiydckBWbrzbTL8i', 'Student', NULL, '2025-06-13 08:37:31', '2025-06-13 08:37:31'),
(936, '37', 'Kunal Ghosh', 'kunal.ghosh@example.com', NULL, '7000987654', '$2y$12$iZxLGK6FuwbdPgheKxZkie2su4ENSv2a66P3TmjI11FqabosezcKG', 'Student', NULL, '2025-06-13 08:37:31', '2025-06-13 08:37:31'),
(937, '37', 'Ananya Das', 'ananya.das@example.com', NULL, '7980123456', '$2y$12$Bk02BCF0a83Te9w0cKFdsu54ha.Z23OtPkMtl.wkDyCGmXwUJLQR2', 'Student', NULL, '2025-06-13 08:37:32', '2025-06-13 08:37:32'),
(938, '37', 'Rajat Sen', 'rajat.sen@example.com', NULL, '7098123456', '$2y$12$LINeJrmj8Dn5UzgkI5IKueQdQhQ8ZM9DJfdd5JcSuGJW.wrQncVeG', 'Student', NULL, '2025-06-13 08:37:32', '2025-06-13 08:37:32'),
(939, '37', 'Isha Khan', 'isha.khan@example.com', NULL, '9098123456', '$2y$12$jFM8UtrtNCTnryj12VXyiOsAdg0qy53.SDJBl288ity5Mslj5jt3i', 'Student', NULL, '2025-06-13 08:37:32', '2025-06-13 08:37:32'),
(940, '37', 'Aman Kumar', 'aman.kumar@example.com', NULL, '9123012345', '$2y$12$brFJlpeoPZgqGqA8BnAkrepTZkfVboQgy2Bt7mY7Nsfswwg2JPB5m', 'Student', NULL, '2025-06-13 08:37:32', '2025-06-13 08:37:32'),
(941, '37', 'Riya Paul', 'riya.paul@example.com', NULL, '9890123456', '$2y$12$5ndHUE1fdS7T28//90zUBuIYapX5Gpo762LLAdiKh.ibLdM6X.91i', 'Student', NULL, '2025-06-13 08:37:33', '2025-06-13 08:37:33'),
(942, '37', 'Sayan Bhattacharya', 'sayan.b@example.com', NULL, '7880123456', '$2y$12$brFSy.otleEevFkBEWnahuQ.weX9gOO302Nt54FR6ZX4Q99Hg6u0S', 'Student', NULL, '2025-06-13 08:37:33', '2025-06-13 08:37:33'),
(943, '37', 'Mehul Jain', 'mehul.jain@example.com', NULL, '8901234567', '$2y$12$GeZGFJacxaF4nED.1iUiU.6G2OZhl8twYdugkB6094xfic2b1Fopi', 'Student', NULL, '2025-06-13 08:37:33', '2025-06-13 08:37:33'),
(944, '37', 'Tania Dey', 'tania.dey@example.com', NULL, '9988770011', '$2y$12$RIwbQ8xVhKm3lPGz57BEtua5RB3BtOdbDtnh0kUS/x6tp7S.wsumO', 'Student', NULL, '2025-06-13 08:37:33', '2025-06-13 08:37:33'),
(945, '37', 'Aditya Nath', 'aditya.nath@example.com', NULL, '9990123456', '$2y$12$rm2Dqk1yrzDVRYsukdYh8.IZI1FcUHl7ojlLLMKCJ9cxM9WswiUK2', 'Student', NULL, '2025-06-13 08:37:34', '2025-06-13 08:37:34'),
(946, '37', 'Nikita Banerjee', 'nikita.b@example.com', NULL, '9970011223', '$2y$12$TDdP7eWmHmo0WfQYVcybDeyQ9ClL6QKJAqiXHHcdYNFXrf43oe4cO', 'Student', NULL, '2025-06-13 08:37:34', '2025-06-13 08:37:34'),
(947, '37', 'Zaid Ahmed', 'zaid.ahmed@example.com', NULL, '9761234560', '$2y$12$GKAyurV3NqIgbXv9uVf.3O5odRGXoaO/TiAdJ/zwQ9VOcfZ1kWDfq', 'Student', NULL, '2025-06-13 08:37:34', '2025-06-13 08:37:34'),
(948, '37', 'Payel Ghosh', 'payel.ghosh@example.com', NULL, '7980123400', '$2y$12$RODjAAIwNbOZRgYlkplt3.IL8ikzQgxtpCsgojOWrSk4QOl.omRui', 'Student', NULL, '2025-06-13 08:37:34', '2025-06-13 08:37:34'),
(949, '37', 'Rakesh Verma', 'rakesh.v@example.com', NULL, '7983012345', '$2y$12$YR5T2vZ2uDUxX0Sgre3SQudVeM23fFFhDDqOHW9nHOp3WJSeZUUV.', 'Student', NULL, '2025-06-13 08:37:35', '2025-06-13 08:37:35'),
(950, '37', 'Ishita Bose', 'ishita.bose@example.com', NULL, '8980123456', '$2y$12$JT.NtJkve2gSe5ScgKjhFO27KcZ/w5dUbpH4a6PU95/R1IF6PhyBK', 'Student', NULL, '2025-06-13 08:37:35', '2025-06-13 08:37:35'),
(951, '37', 'Aritra Sen', 'aritra.sen@example.com', NULL, '9876512340', '$2y$12$YtxZNBMEXn2Wuy/gjo38iuDqUazB32GmS3HiAiKERZSRIDzaWDRyO', 'Student', NULL, '2025-06-13 08:37:51', '2025-06-13 08:37:51'),
(952, '37', 'Priya Das', 'priya.das@example.com', NULL, '9876512341', '$2y$12$KlE2OKOTIgZvNH0.h3/MIOBrGdN4onDExd7pPV4uIX/.z82b4oREi', 'Student', NULL, '2025-06-13 08:37:52', '2025-06-13 08:37:52'),
(953, '37', 'Rahul Mitra', 'rahul.mitra@example.com', NULL, '9876512342', '$2y$12$0dxSPzceTq2KWoWAvUyvoO.jVdEt9qL/sgi.iwJxyjGjO2szvBrhC', 'Student', NULL, '2025-06-13 08:37:52', '2025-06-13 08:37:52'),
(954, '37', 'Ananya Ghosh', 'ananya.ghosh@example.com', NULL, '9876512343', '$2y$12$/vLIyfNxtWJEewVq.h2HnuN5iTnS9wP1NprOFPxJfPUvFf.8E0PZ2', 'Student', NULL, '2025-06-13 08:37:52', '2025-06-13 08:37:52'),
(955, '37', 'Soham Roy', 'soham.roy@example.com', NULL, '9876512344', '$2y$12$BFdZgoPRz8xJ2eUhMeUrpuBQXQ1UjR7dI0HF39dtG.v8pw4g6kmym', 'Student', NULL, '2025-06-13 08:37:52', '2025-06-13 08:37:52'),
(956, '37', 'Tania Paul', 'tania.paul@example.com', NULL, '9876512345', '$2y$12$iOEdvlGiP2OD8cFYLLxBrO3HglQ0yA9vBOi229jkUB4wn0vpRXNHS', 'Student', NULL, '2025-06-13 08:37:53', '2025-06-13 08:37:53'),
(957, '37', 'Arindam Dey', 'arindam.dey@example.com', NULL, '9876512346', '$2y$12$tQVVgDL.epqrdxi8r2j6k.neOvST/ZnnkRZFzW1FIP6FH4v/MlOke', 'Student', NULL, '2025-06-13 08:37:53', '2025-06-13 08:37:53'),
(958, '37', 'Sneha Dasgupta', 'sneha.dasgupta@example.com', NULL, '9876512347', '$2y$12$GOTnSCFaLe8CDHNQp6FWHeJkjYVi64R2OIYGpIyaUqzOHN0p0uYMi', 'Student', NULL, '2025-06-13 08:37:53', '2025-06-13 08:37:53'),
(959, '37', 'Debayan Sarkar', 'debayan.sarkar@example.com', NULL, '9876512348', '$2y$12$3WDAIp4TEqhczhM6CtS3u.DT5vmywfpEClp5Sq5zgTuHcL0g4ZWCS', 'Student', NULL, '2025-06-13 08:37:53', '2025-06-13 08:37:53'),
(960, '37', 'Ishita Bhattacharjee', 'ishita.b@example.com', NULL, '9876512349', '$2y$12$hCx1Il1vppabrmZcnjo3l.tOetaJGFeSk9RdEqF1xjfMg9fUiviQW', 'Student', NULL, '2025-06-13 08:37:54', '2025-06-13 08:37:54'),
(961, '37', 'Kunal Sen', 'kunal.sen@example.com', NULL, '9876512350', '$2y$12$U7slvepSslEA6S4GfeQ6dun06iWuy2zIrQbmcUlF3F6A5eAiyzKZO', 'Student', NULL, '2025-06-13 08:37:54', '2025-06-13 08:37:54'),
(962, '37', 'Riya Mukherjee', 'riya.mukherjee@example.com', NULL, '9876512351', '$2y$12$jOF8KwRMRhT9d.yaKNZ6Suiha70ifsrL98eiBVRNr1squyHtFsovu', 'Student', NULL, '2025-06-13 08:37:54', '2025-06-13 08:37:54'),
(963, '37', 'Abhishek Das', 'abhishek.das@example.com', NULL, '9876512352', '$2y$12$IG0AK540OvRsjJmMcydRC.BIQDAm8CVMARUkKg0LG5AwOaqj2QXZ.', 'Student', NULL, '2025-06-13 08:37:54', '2025-06-13 08:37:54'),
(964, '37', 'Shruti Sen', 'shruti.sen@example.com', '1749900789.jpg', '9876512353', '$2y$12$pAV7lIsDammbr1U9OU.gI.A63G.ZugOtgJ7tVQBz1KdYDn2o158PC', 'Student', NULL, '2025-06-13 08:37:55', '2025-06-13 08:37:55'),
(965, '37', 'Nikhil Pal', 'ud6gedg13@example.com', NULL, '9876512354', '$2y$12$RKR1SfpQ8R5wUMk6K1o52OvuQSpKSgXJGwOhaL30HiWqfKab/24xS', 'Student', NULL, '2025-06-13 08:37:55', '2025-06-13 08:37:55'),
(966, '37', 'Nikhil Pal', '55drwedtu@example.com', NULL, '9876512354', '$2y$12$DThBVW91tyQs1.ecSQHeWemouhObvaPdIqohvQSU/6suZq3OhZ/FG', 'Student', NULL, '2025-06-13 08:37:55', '2025-06-13 08:37:55'),
(967, '38', 'Aryan Mukherjee', 'aryan.mukherjee@email.com', NULL, '9800000001', '$2y$12$DiQ90rDS1gnfNjSOIR5gsODSkY7EivOevFK3ydIKU/FRfY4Jcvej2', 'Student', NULL, '2025-06-13 15:41:59', '2025-06-13 15:41:59'),
(968, '38', 'Priya Das', 'priya.das@email.com', NULL, '9800000002', '$2y$12$OeAcVwLR6AylLoOqPluoAeKTW9/YemFARotvI5L5BSLr4FRZy7/B6', 'Student', NULL, '2025-06-13 15:42:00', '2025-06-13 15:42:00'),
(969, '38', 'Ankit Sharma', 'ankit.sharma@email.com', NULL, '9800000003', '$2y$12$5O88WU3q72adidkkzY7a7OpWE7.hyPWFoUD9NFYSbxeZktxilSvBC', 'Student', NULL, '2025-06-13 15:42:00', '2025-06-13 15:42:00'),
(970, '38', 'Riya Sen', 'riya.sen@email.com', NULL, '9800000004', '$2y$12$/o6CTL3UfQpEl7O6psCMmeltWB1yb5QXedNbXzF9bpN9AQCNXnMYC', 'Student', NULL, '2025-06-13 15:42:01', '2025-06-13 15:42:01'),
(971, '38', 'Tanmoy Ghosh', 'tanmoy.ghosh@email.com', NULL, '9800000005', '$2y$12$LY415TZyUrJ.daFo.KJ65O01QLvbRyRPzY5HfNX4oEa2Kq69y194q', 'Student', NULL, '2025-06-13 15:42:01', '2025-06-13 15:42:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_semisters`
--
ALTER TABLE `academic_semisters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_semisters_session_id_foreign` (`session_id`),
  ADD KEY `academic_semisters_department_id_foreign` (`department_id`);

--
-- Indexes for table `academic_sessions`
--
ALTER TABLE `academic_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assigned_mentor`
--
ALTER TABLE `assigned_mentor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_mentor_mentor_id_foreign` (`mentor_id`),
  ADD KEY `assigned_mentor_mentee_id_foreign` (`mentee_id`);

--
-- Indexes for table `attendance_records`
--
ALTER TABLE `attendance_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_records_mentoring_infos_id_foreign` (`mentoring_info_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `communication_pattern2`
--
ALTER TABLE `communication_pattern2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `communication_pattern2_mentoring_infos_id_foreign` (`mentoring_info_id`);

--
-- Indexes for table `communication_patterns`
--
ALTER TABLE `communication_patterns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `communication_patterns_mentoring_infos_id_foreign` (`mentoring_info_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_session_department` (`session_id`,`department_name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mentoring_infos`
--
ALTER TABLE `mentoring_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mentoring_infos_session_id_foreign` (`session_id`),
  ADD KEY `mentoring_infos_department_id_foreign` (`department_id`),
  ADD KEY `mentoring_infos_semester_id_foreign` (`semester_id`),
  ADD KEY `mentoring_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `practical_exams`
--
ALTER TABLE `practical_exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `practical_exams_mentoring_infos_id_foreign` (`mentoring_info_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester_marks`
--
ALTER TABLE `semester_marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester_marks_mentoring_infos_id_foreign` (`mentoring_info_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `student_update_request`
--
ALTER TABLE `student_update_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_update_request_userid_foreign` (`userid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_session_id_foreign` (`session_id`),
  ADD KEY `subject_department_id_foreign` (`department_id`),
  ADD KEY `subject_semester_id_foreign` (`semester_id`);

--
-- Indexes for table `theory_exams`
--
ALTER TABLE `theory_exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theory_exams_mentoring_info_id_foreign` (`mentoring_info_id`);

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
-- AUTO_INCREMENT for table `academic_semisters`
--
ALTER TABLE `academic_semisters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `academic_sessions`
--
ALTER TABLE `academic_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `assigned_mentor`
--
ALTER TABLE `assigned_mentor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `attendance_records`
--
ALTER TABLE `attendance_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `communication_pattern2`
--
ALTER TABLE `communication_pattern2`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `communication_patterns`
--
ALTER TABLE `communication_patterns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mentoring_infos`
--
ALTER TABLE `mentoring_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `practical_exams`
--
ALTER TABLE `practical_exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semester_marks`
--
ALTER TABLE `semester_marks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=928;

--
-- AUTO_INCREMENT for table `student_update_request`
--
ALTER TABLE `student_update_request`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `theory_exams`
--
ALTER TABLE `theory_exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=972;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_semisters`
--
ALTER TABLE `academic_semisters`
  ADD CONSTRAINT `academic_semisters_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `academic_semisters_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `academic_sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assigned_mentor`
--
ALTER TABLE `assigned_mentor`
  ADD CONSTRAINT `assigned_mentor_mentee_id_foreign` FOREIGN KEY (`mentee_id`) REFERENCES `student_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assigned_mentor_mentor_id_foreign` FOREIGN KEY (`mentor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance_records`
--
ALTER TABLE `attendance_records`
  ADD CONSTRAINT `attendance_records_mentoring_infos_id_foreign` FOREIGN KEY (`mentoring_info_id`) REFERENCES `mentoring_infos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `communication_pattern2`
--
ALTER TABLE `communication_pattern2`
  ADD CONSTRAINT `communication_pattern2_mentoring_infos_id_foreign` FOREIGN KEY (`mentoring_info_id`) REFERENCES `mentoring_infos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `communication_patterns`
--
ALTER TABLE `communication_patterns`
  ADD CONSTRAINT `communication_patterns_mentoring_infos_id_foreign` FOREIGN KEY (`mentoring_info_id`) REFERENCES `mentoring_infos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `academic_sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mentoring_infos`
--
ALTER TABLE `mentoring_infos`
  ADD CONSTRAINT `mentoring_infos_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mentoring_infos_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `academic_semisters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mentoring_infos_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `academic_sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mentoring_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `practical_exams`
--
ALTER TABLE `practical_exams`
  ADD CONSTRAINT `practical_exams_mentoring_infos_id_foreign` FOREIGN KEY (`mentoring_info_id`) REFERENCES `mentoring_infos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `semester_marks`
--
ALTER TABLE `semester_marks`
  ADD CONSTRAINT `semester_marks_mentoring_infos_id_foreign` FOREIGN KEY (`mentoring_info_id`) REFERENCES `mentoring_infos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_details`
--
ALTER TABLE `student_details`
  ADD CONSTRAINT `student_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_update_request`
--
ALTER TABLE `student_update_request`
  ADD CONSTRAINT `student_update_request_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `academic_semisters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `academic_sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `theory_exams`
--
ALTER TABLE `theory_exams`
  ADD CONSTRAINT `theory_exams_mentoring_info_id_foreign` FOREIGN KEY (`mentoring_info_id`) REFERENCES `mentoring_infos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
