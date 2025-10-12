-- phpMyAdmin SQL Dump
-- version 5.2.2deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 12, 2025 at 12:13 PM
-- Server version: 11.8.3-MariaDB-1+b1 from Debian
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leakhunter`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `details`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 1, 'login', 'User logged in successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:04:09'),
(2, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:04:09'),
(3, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:04:20'),
(4, 1, 'logs_view', 'Viewed activity logs', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:04:57'),
(5, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:05:03'),
(6, 1, 'profile_view', 'Viewed profile page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:05:05'),
(7, 1, 'logs_view', 'Viewed activity logs', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:05:42'),
(8, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:05:51'),
(9, 1, 'users_page_view', 'Viewed users management page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:06:05'),
(10, 1, 'users_page_view', 'Viewed users management page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:06:19'),
(11, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:07:06'),
(12, 1, 'users_page_view', 'Viewed users management page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:10:06'),
(13, 1, 'logout', 'User logged out successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:10:17'),
(14, 1, 'login', 'User logged in successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:13:32'),
(15, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:13:32'),
(16, 1, 'users_page_view', 'Viewed users management page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:13:39'),
(17, 1, 'users_page_view', 'Viewed users management page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:14:56'),
(18, 1, 'users_page_view', 'Viewed users management page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:15:31'),
(19, 1, 'users_page_view', 'Viewed users management page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:15:50'),
(20, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:15:52'),
(21, 1, 'logout', 'User logged out successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 07:15:56'),
(22, 2, 'login', 'User logged in successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:02:23'),
(23, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:02:23'),
(24, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:02:40'),
(25, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:02:46'),
(26, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:03:04'),
(27, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:03:27'),
(28, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:03:33'),
(29, 2, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:04:21'),
(30, 2, 'search', 'Searched for: isms.iaa.ac.tz, Found: 100 results, Tokens used: 3', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:05:03'),
(31, 2, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:05:03'),
(32, 2, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:05:27'),
(33, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:05:30'),
(34, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:08:13'),
(35, 2, 'unauthorized_access', 'Attempted access to admin area', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:08:19'),
(36, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:09:12'),
(37, 2, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:09:20'),
(38, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:09:22'),
(39, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:12:51'),
(40, 2, 'history_page_view', 'Viewed search history page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:12:55'),
(41, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:13:48'),
(42, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:15:00'),
(43, 2, 'history_page_view', 'Viewed search history page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:21:37'),
(44, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:21:41'),
(45, 2, 'history_page_view', 'Viewed search history page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:21:43'),
(46, 2, 'history_page_view', 'Viewed search history page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:22:25'),
(47, 2, 'export_search', 'Exported search results for: isms.iaa.ac.tz', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:22:28'),
(48, 2, 'history_page_view', 'Viewed search history page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:27:43'),
(49, 2, 'history_page_view', 'Viewed search history page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:27:51'),
(50, 2, 'history_page_view', 'Viewed search history page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:32:42'),
(51, 2, 'export_search', 'Exported search results for query: isms.iaa.ac.tz in HTML format', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:32:46'),
(52, 2, 'history_page_view', 'Viewed search history page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:34:52'),
(53, 2, 'export_data', 'Exported search results for query: isms.iaa.ac.tz in html format', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:34:54'),
(54, 2, 'history_page_view', 'Viewed search history page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:37:44'),
(55, 2, 'history_page_view', 'Viewed search history page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:37:49'),
(56, 2, 'view_results', 'Viewed results for search: isms.iaa.ac.tz', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:37:51'),
(57, 2, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:37:58'),
(58, 2, 'search', 'Searched for: bongosec, Found: 17 results, Tokens used: 3', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:38:13'),
(59, 2, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:38:13'),
(60, 2, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:38:32'),
(61, 2, 'search', 'Searched for: tcra.go.tz, Found: 4 results, Tokens used: 3', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:39:01'),
(62, 2, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:39:01'),
(63, 2, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:39:12'),
(64, 2, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:39:17'),
(65, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:39:32'),
(66, 2, 'history_page_view', 'Viewed search history page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:39:41'),
(67, 2, 'delete_search', 'Deleted search: tcra.go.tz', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:39:45'),
(68, 2, 'history_page_view', 'Viewed search history page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:39:45'),
(69, 2, 'delete_search', 'Deleted search: bongosec', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:39:48'),
(70, 2, 'history_page_view', 'Viewed search history page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:39:48'),
(71, 2, 'delete_search', 'Deleted search: isms.iaa.ac.tz', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:39:51'),
(72, 2, 'history_page_view', 'Viewed search history page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:39:51'),
(73, 2, 'logout', 'User logged out successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 09:39:54'),
(74, 1, 'login', 'User logged in successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 12:57:04'),
(75, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 12:57:04'),
(76, 1, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 12:57:08'),
(77, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:02:42'),
(78, 1, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:02:46'),
(79, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:03:14'),
(80, 1, 'users_page_view', 'Viewed users management page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:03:18'),
(81, 1, 'assign_token_page_view', 'Viewed token assignment page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:03:24'),
(82, 1, 'token_assignment', 'Assigned 50 tokens to user ID 2: tsh 5000', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:03:48'),
(83, 1, 'assign_token_page_view', 'Viewed token assignment page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:03:48'),
(84, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:03:52'),
(85, 1, 'logout', 'User logged out successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:03:57'),
(86, 2, 'login', 'User logged in successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:04:05'),
(87, 2, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:04:05'),
(88, 2, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:04:08'),
(89, 2, 'search', 'Searched for: https://nacte.go.tz/manager/index.php?r=site/login, Found: 0 results, Tokens used: 3', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:04:27'),
(90, 2, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:04:27'),
(91, 2, 'logout', 'User logged out successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:05:28'),
(92, 1, 'login', 'User logged in successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:05:39'),
(93, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:05:39'),
(94, 1, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:05:46'),
(95, 1, 'history_view', 'Viewed search history', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:07:33'),
(96, 1, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:07:35'),
(97, 1, 'search', 'Searched for: https://nacte.go.tz/manager/index.php?r=site/login, Found: 0 results, Tokens used: 0', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:08:20'),
(98, 1, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:08:20'),
(99, 1, 'history_view', 'Viewed search history', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:08:30'),
(100, 1, 'delete_search', 'Deleted search: https://nacte.go.tz/manager/index.php?r=site/login', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:08:36'),
(101, 1, 'history_view', 'Viewed search history', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:08:36'),
(102, 1, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:09:36'),
(103, 1, 'search', 'Searched for: https://auth.hostinger.com/login, Found: 100 results, Tokens used: 0', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:09:46'),
(104, 1, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:09:46'),
(105, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:09:57'),
(106, 1, 'login', 'User logged in successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:44:57'),
(107, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:44:57'),
(108, 1, 'logout', 'User logged out successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 13:45:03'),
(109, 1, 'login', 'User logged in successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:18:33'),
(110, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:18:34'),
(111, 1, 'search_page_view', 'Viewed search page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:20:46'),
(112, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:20:47'),
(113, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:25:10'),
(114, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:25:49'),
(115, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:27:33'),
(116, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:28:32'),
(117, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:30:00'),
(118, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:35:13'),
(119, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:36:59'),
(120, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:37:24'),
(121, 1, 'profile_view', 'Viewed profile page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:37:38'),
(122, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:37:41'),
(123, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:43:12'),
(124, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:43:42'),
(125, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:54:18'),
(126, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:55:46'),
(127, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:56:11'),
(128, 1, 'users_page_view', 'Viewed users management page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:56:18'),
(129, 1, 'assign_token_page_view', 'Viewed token assignment page', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:56:31'),
(130, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:56:43'),
(131, 1, 'logs_view', 'Viewed activity logs', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:56:51'),
(132, 1, 'history_view', 'Viewed search history', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:56:54'),
(133, 1, 'results_view', 'Viewed detailed results for search: https://auth.hostinger.com/login', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:57:01'),
(134, 1, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 18:57:05'),
(135, 1, 'logout', 'User logged out successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-10 19:00:02'),
(136, 3, 'user_registration', 'New user registered: test@test.com', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-12 11:56:51'),
(137, 3, 'login', 'User logged in successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-12 11:57:18'),
(138, 3, 'dashboard_view', 'Viewed dashboard', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-12 11:57:18'),
(139, 3, 'logout', 'User logged out successfully', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-12 11:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `api_usage`
--

CREATE TABLE `api_usage` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `requests_count` int(11) DEFAULT 0,
  `tokens_consumed` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_fingerprints`
--

CREATE TABLE `device_fingerprints` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fingerprint` varchar(255) NOT NULL,
  `user_agent` varchar(512) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `device_fingerprints`
--

INSERT INTO `device_fingerprints` (`id`, `user_id`, `fingerprint`, `user_agent`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 3, 'b1e1ca75403d00c719463f65a022941cc93446d181473d77d394637eff6986f7', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '::1', '2025-10-12 11:56:51', '2025-10-12 11:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `search_history`
--

CREATE TABLE `search_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `query` varchar(500) NOT NULL,
  `results_count` int(11) DEFAULT 0,
  `tokens_used` int(11) DEFAULT 0,
  `search_type` enum('email','username','name','phone','other') DEFAULT 'other',
  `results_data` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `search_history`
--

INSERT INTO `search_history` (`id`, `user_id`, `query`, `results_count`, `tokens_used`, `search_type`, `results_data`, `created_at`) VALUES
(4, 2, 'https://nacte.go.tz/manager/index.php?r=site/login', 0, 3, 'other', '{\"List\":{\"No results found\":{\"Data\":[[]],\"InfoLeak\":\"<em> At your request, no results were found. Either they are not, or all the words in your request are found too often so that they can be checked. Try to change the request. <\\/em>\",\"NumOfResults\":1}},\"NumOfDatabase\":1,\"NumOfResults\":1,\"free_requests_left\":20,\"price\":0,\"search time\":0.0156236}', '2025-10-10 13:04:27'),
(6, 1, 'https://auth.hostinger.com/login', 100, 0, 'other', '{\"List\":{\"Alien TxtBase\":{\"Data\":[{\"Email\":\"hrawork2022@gmail.com\",\"Password\":\"Hami@2024\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"itsaamirum01@gmail.com\",\"Password\":\"Shopify@006\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"ghoomovacations@gmail.com\",\"Password\":\"shubham@0987a\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"g7.perfume@gmail.com\",\"Password\":\"Alimervan3!\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"fernando@flashpainting.com.au\",\"Password\":\"ETERNAL@2024\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"henriquehse2015@gmail.com\",\"Password\":\"Aa!@112233\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"goldenarrowdigitalsolutions@gmail.com\",\"Password\":\"Golden132@**\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"h.magdy@trendlix.com\",\"Password\":\"HMs_491991\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"feelingsmaker@gmail.com\",\"Password\":\"Allah0487b@nk\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"ignaciosoluciones@outlook.com\",\"Password\":\"(1970Andorra2023)\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"luciarochapagina@gmail.com\",\"Password\":\"ros@roch@11\",\"Url\":\"auth.hostinger.com\\/login\"},{\"NickName\":\"suhailiqbal9900\",\"Password\":\"Hosman@786 \",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"inarnolutfi@gmail.com\",\"Password\":\"InventoryAdmin2017\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"info@pragatiassociate.com\",\"Password\":\"Ndk@9212\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"keithmunyorot@gmail.com\",\"Password\":\"Ping....1234!\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"hassanmk7253@gmail.com\",\"Password\":\"zaeem@hassan2114438\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"gaurisi406@gmail.com\",\"Password\":\"Cwl!pass123\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"ferozibushra@gmail.com\",\"Password\":\"Ferozi_313313\",\"Url\":\"auth.hostinger.com\\/login\"},{\"NickName\":\"admindas1\",\"Password\":\"king$men123 \",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"Logexlhr@gmail.com\",\"Password\":\"Logex#931275!\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"hoseinsoheily96@gmail.com\",\"Password\":\"Hajhosein0913#\",\"Url\":\"auth.hostinger.com\\/login\"},{\"NickName\":\"chhayank_bhardwaj_\",\"Password\":\"Karan@2329 \",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"info@joyeriaflores.es\",\"Password\":\"JO579003a@\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"itskhalilurrehman@gmail.com\",\"Password\":\"Romazkz@220\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"kamandanelson@gmail.com\",\"Password\":\"JRtu5v#!8.7T.QY\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"hamzasdoger@gmail.com\",\"Password\":\"Asd@39760\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"lsamancio@hotmail.com\",\"Password\":\"Senha12!\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"igorcamara.igui@gmail.com\",\"Password\":\"Ilaine145!\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"evertck@gmail.com\",\"Password\":\"05k4r2020\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"koykarona93@gmail.com\",\"Password\":\"1iR2673@9393991\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"info@nabeelhindi.com\",\"Password\":\"Aln@123123#\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"iig-qa@outlook.com\",\"Password\":\"Khalifa$$123\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"justiceamaram@gmail.com\",\"Password\":\"Apptalic194906..\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"iconnectjosh@gmail.com\",\"Password\":\"Bt2A^ns,X2LNBnK\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"lauane.teste2@gmail.com\",\"Password\":\"Gefim3367\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"hamel.mourad28@gmail.com\",\"Password\":\"Mourad181985+\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"ivoryteks@outlook.com.tr\",\"Password\":\"Yldrm0120+1\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"hagolh0@gmail.com\",\"Password\":\"AA445566aa!!\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"Kausarmehmood60691@gmail.com\",\"Password\":\"Khan@11223\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"hostingshahispecial@gmail.com\",\"Password\":\"137458@ikD\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"lacosta@3monjes.com.ar\",\"Password\":\"piRata00#\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"hrawork2022@gmail.com\",\"Password\":\"Zemfar55@5&\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"exxdeath@hotmail.com\",\"Password\":\"1977@Interkobb\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"igor.santana@isstechnology.inf.br\",\"Password\":\"adminISS12$$\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"gratefulview@outlook.com\",\"Password\":\"j2111B$>^\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"info@jemertomotors.com\",\"Password\":\"bMM+?)SBVtg5zrc\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"Knomodaymas.pr@gmail.com\",\"Password\":\"Knomoda24@\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"khnaeemt@gmail.com\",\"Password\":\"Knt@88800888\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"krana3857@gmail.com\",\"Password\":\"SDSDispatch123@\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"hafrul2010@gmail.com\",\"Password\":\"b@diz2010\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"info@blackdiamondlimoservice.com\",\"Password\":\"ELIANA@2022\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"iaibafah@gmail.com\",\"Password\":\"Siwuran123\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"jamalkhardi@gmail.com\",\"Password\":\"J@mjo1970*\\/*\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"kannan@drroze.com\",\"Password\":\"O4YzGcoMfI9c@3rcC\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"evocreatix@gmail.com\",\"Password\":\"Pakistan123@\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"ketillien308@hotmail.com\",\"Password\":\"frittwim72\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"fxsttoken@gmail.com\",\"Password\":\"e%PbzZ$Y9J\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"gokoav@gmail.com\",\"Password\":\"specijalec123\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"jwswashim3@gmail.com\",\"Password\":\"Khairul21$\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"jamesmorgan@gmx.ca\",\"Password\":\"11jamisco20A.@@\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"lawrencewakiama10@gmail.com\",\"Password\":\"Lawremwaos@10\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"loatemophuting@gmail.com\",\"Password\":\"oletilwe2003\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"gerard.najem@gmail.com\",\"Password\":\"WideScreen93)\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"malekalilat4@gmail.com\",\"Password\":\"StreamVisionSpot@@@789\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"itechbreeze@gmail.com\",\"Password\":\"ZikkiGold661@$\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"jusour4interns@gmail.com\",\"Password\":\"Aa-1272004\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"macanop001@gmail.com\",\"Password\":\"macan33goblok\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"francisharoon95@gmail.com\",\"Password\":\"wjt6@k&xfb-j*m9\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"ing_rorg@hotmail.com\",\"Password\":\"Lup1t@2912\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"imaedmond777@gmail.com\",\"Password\":\"Newpassword@agora2023\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"machelleonyango27@gmail.com\",\"Password\":\"Genzyle2024*\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"laasiriyounesse587@gmail.com\",\"Password\":\"AAaa2514587911@\\/\\/*\\/\\/985425youness\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"innovativeinteriors09@gmail.com\",\"Password\":\"papa@590616\",\"Url\":\"auth.hostinger.com\\/login\"},{\"NickName\":\"ilyasinoslo\",\"Password\":\"HASHtag=1086 \",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"khaledism2002@gmail.com\",\"Password\":\"$Ahmed@220\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"fk8329669@gmail.com\",\"Password\":\"Db@30122000\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"fatimahashmi959@gmail.com\",\"Password\":\"1234\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"haspin88@gmail.com\",\"Password\":\"Rzamhr0010@\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"faizibaloch169@gmail.com\",\"Password\":\"Faizan@0987\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"ginju10@gmail.com\",\"Password\":\"Saibaba10$\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"jeremiahjames510@gmail.com\",\"Password\":\"Mwanaid@60tz\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"gifswithsound2018@gmail.com\",\"Password\":\"Ztoloviche1\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"falecom@gustrago.com\",\"Password\":\"Bankole@93\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"generationalgenerations@gmail.com\",\"Password\":\"Usha4627!\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"info@nileps.com\",\"Password\":\"@hebapoplove555\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"hassanjaved176@gmail.com\",\"Password\":\"xQ9wIPx+wkWg6DSE\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"fras11734@gmail.com\",\"Password\":\"FU4T7Zzp6VkGtx9\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"gpag-editora@outlook.com\",\"Password\":\"Filipe2024\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"hassanyousfani555@gmail.com\",\"Password\":\"Usfani537737@\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"luchofloresf@gmail.com\",\"Password\":\"HosP8n0ch8t0$$\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"founder.conveyuall@gmail.com\",\"Password\":\"ConveyU@!!123\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"familiarspunch89@gmail.com\",\"Password\":\"(Deltadigitizing587)\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"fahad.mustafa9598@gmail.com\",\"Password\":\"Aa11bb22cc@c\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"gerard.najem@gmail.com\",\"Password\":\"H#ostinger#123\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"haitamchamrahi@gmail.com\",\"Password\":\"Haitam@2017\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"Greensignaldxb@gmail.com\",\"Password\":\"Swat12345\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"liberal.asif@gmail.com\",\"Password\":\"ali*1&abdu*2*3madi\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"karsaikat363@gmail.com\",\"Password\":\"Saikat@321\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"katheline888@gmail.com\",\"Password\":\"Katheline888\",\"Url\":\"auth.hostinger.com\\/login\"},{\"Email\":\"Hello@trinbow.com\",\"Password\":\"Yassine159753@\",\"Url\":\"auth.hostinger.com\\/login\"}],\"InfoLeak\":\"At the beginning of 2025, a huge collection of logs was published in the ALEN TXTBASE telegram channel. The data in it were collected using stylers - viruses stolen by login and passwords stored in browsers. The collection contained 23 billion lines, but among them there were many duplicates, as well as signs of generation. After removing duplicates and notes from NAZ.api and other similar leaks, 2.8 billion unique records remained. They contain mail, phones, nicknames, IP addresses, passwords in open form and the name of sites or installed applications in which they were used.\",\"NumOfResults\":100}},\"NumOfDatabase\":1,\"NumOfResults\":100,\"free_requests_left\":17,\"price\":0,\"search time\":0.046874}', '2025-10-10 13:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `token_transactions`
--

CREATE TABLE `token_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `tokens_assigned` int(11) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `token_transactions`
--

INSERT INTO `token_transactions` (`id`, `user_id`, `admin_id`, `tokens_assigned`, `reason`, `created_at`) VALUES
(1, 2, 1, 50, 'tsh 5000', '2025-10-10 13:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `api_token` varchar(500) DEFAULT NULL,
  `tokens_remaining` int(11) DEFAULT 9,
  `device_id` varchar(64) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `is_banned` tinyint(1) DEFAULT 0,
  `registration_date` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `full_name`, `api_token`, `tokens_remaining`, `device_id`, `role`, `is_banned`, `registration_date`, `created_at`, `updated_at`, `last_login`, `is_active`) VALUES
(1, 'admin@fsociety.com', '$2y$12$6RHbXhtDjxwmjx9KZMD9yuX7oRegt.MoUV7gNl0RBbbnrw/qCsszC', 'System Administrator', NULL, 999999, NULL, 'admin', 0, '2025-10-10 06:49:34', '2025-10-10 06:49:34', '2025-10-10 18:18:33', '2025-10-10 18:18:33', 1),
(2, 'iddy@fsociety.com', '$2y$12$q4zW0TYZp4qkNa1dxYBOG.9Zo4kY/jcmPIF1kzCZRVQDCUXcFJnKS', 'iddy', NULL, 47, NULL, 'user', 0, '2025-10-10 09:02:06', '2025-10-10 09:02:06', '2025-10-10 13:04:27', '2025-10-10 13:04:05', 1),
(3, 'test@test.com', '$2y$12$OhetWBZ3baDT9lIOdhyoieJGqasMdZ.A9mBGiOZcT4Spy2oYuJViO', 'benja', NULL, 9, 'b1e1ca75403d00c719463f65a022941cc93446d181473d77d394637eff6986f7', 'user', 0, '2025-10-12 11:56:51', '2025-10-12 11:56:51', '2025-10-12 11:57:18', '2025-10-12 11:57:18', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_activity_logs_user_id` (`user_id`),
  ADD KEY `idx_activity_logs_created_at` (`created_at`);

--
-- Indexes for table `api_usage`
--
ALTER TABLE `api_usage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_date` (`user_id`,`date`),
  ADD KEY `idx_api_usage_user_date` (`user_id`,`date`);

--
-- Indexes for table `device_fingerprints`
--
ALTER TABLE `device_fingerprints`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fingerprint` (`fingerprint`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `search_history`
--
ALTER TABLE `search_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_search_history_user_id` (`user_id`),
  ADD KEY `idx_search_history_created_at` (`created_at`);

--
-- Indexes for table `token_transactions`
--
ALTER TABLE `token_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `device_id` (`device_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `api_usage`
--
ALTER TABLE `api_usage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_fingerprints`
--
ALTER TABLE `device_fingerprints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `search_history`
--
ALTER TABLE `search_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `token_transactions`
--
ALTER TABLE `token_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `api_usage`
--
ALTER TABLE `api_usage`
  ADD CONSTRAINT `api_usage_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `search_history`
--
ALTER TABLE `search_history`
  ADD CONSTRAINT `search_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `token_transactions`
--
ALTER TABLE `token_transactions`
  ADD CONSTRAINT `token_transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `token_transactions_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
