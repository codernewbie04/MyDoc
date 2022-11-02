-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2022 at 06:54 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Bisa mengakses semua fitur dan mengatur semua user MyDoc'),
(2, 'instansi-kesehatan', 'Regular User / Pasien'),
(3, 'user', 'Menambah, mengatur dan menghapus dokter, mengatur instansi, mengatus harga berobat dokter');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 1),
(2, 2),
(3, 7),
(3, 8),
(3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `auth_jwt`
--

CREATE TABLE `auth_jwt` (
  `id` int(11) NOT NULL,
  `jti` varchar(16) NOT NULL,
  `blacklist` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_jwt`
--

INSERT INTO `auth_jwt` (`id`, `jti`, `blacklist`, `created_at`) VALUES
(1, 'd357b9cf2744e189', 0, '2022-10-18 21:15:19'),
(2, '140a76dd60447a23', 0, '2022-10-18 21:20:49'),
(3, 'bcc2af212e55c97a', 0, '2022-10-18 21:26:04'),
(4, '075101d4726f5f10', 0, '2022-10-18 21:27:18'),
(5, 'f14657b5e788d739', 0, '2022-10-18 21:27:42'),
(6, 'b3755da2141cda11', 0, '2022-10-18 21:28:13'),
(7, '4d2b8b9aa633b337', 0, '2022-10-18 21:28:25'),
(8, '7e831087c0c73c65', 0, '2022-10-18 21:34:13'),
(9, '12ec583f78412e16', 0, '2022-10-18 21:34:25'),
(10, 'f82bdd3f242f408c', 0, '2022-10-18 21:34:41'),
(11, 'd29667159c892b55', 0, '2022-10-18 21:35:03'),
(12, '9d2b82dac39251ea', 0, '2022-10-18 21:35:13'),
(13, 'a0befcba3e0c9484', 0, '2022-10-18 21:35:20'),
(14, 'c93607f2ebcaa292', 0, '2022-10-18 21:38:15'),
(15, '77a7975feb762be6', 0, '2022-10-18 21:38:25'),
(16, '003df6dfeb18d901', 0, '2022-10-18 21:44:52'),
(17, '875cb755c069d517', 0, '2022-10-19 03:07:14'),
(18, 'cb5af31795361068', 0, '2022-10-19 03:12:29'),
(19, '714cd9e29a2ad441', 0, '2022-10-19 03:12:51'),
(20, '748a69576ac4ce37', 0, '2022-10-19 03:12:56'),
(21, '9fd7db3f714b31b6', 0, '2022-10-19 03:13:48'),
(22, '82838ba4f6629633', 0, '2022-10-19 03:15:49'),
(23, '6d4fa198b2726670', 0, '2022-10-19 03:23:25'),
(24, '845557e69270a806', 0, '2022-10-19 04:03:25'),
(25, 'a8fbccdeaff7c245', 0, '2022-10-19 04:06:56'),
(26, 'bd61bb4b8ff1fc7f', 0, '2022-10-19 04:33:12'),
(27, '3f6c76e479c0e56c', 0, '2022-10-19 04:39:04'),
(28, 'ae70a73f5b129425', 0, '2022-10-19 04:45:54'),
(29, 'c8f909e33e1a1ef7', 0, '2022-10-19 04:46:38'),
(30, '623f0a08f7427de1', 0, '2022-10-19 04:46:50'),
(31, 'be50ff16d97b8439', 0, '2022-10-19 04:50:14'),
(32, 'c3b6da8ac20f5356', 0, '2022-10-19 04:59:26'),
(33, '44a61505fa91c5e5', 0, '2022-10-19 05:03:24'),
(34, '7c3f80932441c87e', 0, '2022-10-19 05:03:37'),
(35, 'b06e9362897fc191', 0, '2022-10-19 05:05:26'),
(36, 'f2908f469d18d552', 0, '2022-10-19 05:09:14'),
(37, 'b09fac35aac0bb0b', 1, '2022-10-19 05:11:13'),
(38, '784781575a33f21d', 0, '2022-10-19 05:16:35'),
(39, '8edf32451df0a6b7', 0, '2022-10-19 05:16:47'),
(40, '1e159e6f8fce7f0c', 1, '2022-10-19 05:35:31'),
(41, '74e297a899dfcc9e', 1, '2022-10-19 05:46:54'),
(42, '65dfae32ee44b393', 1, '2022-10-19 05:49:48'),
(43, 'daf9424859fb0d7d', 1, '2022-10-19 06:00:09'),
(44, 'd18decb4766508b8', 0, '2022-10-19 06:00:16'),
(45, 'c0c037971c639196', 1, '2022-10-19 06:01:27'),
(46, 'cbba7531ec44a789', 0, '2022-10-19 06:01:31'),
(47, '41b3eee4ac7f3235', 1, '2022-10-19 06:01:45'),
(48, '9caf82815418dc9d', 0, '2022-10-19 06:02:19'),
(49, 'c9f457caa476f0ea', 1, '2022-10-19 06:02:37'),
(50, 'e8f7875425bdd825', 1, '2022-10-19 06:02:50'),
(51, '2acafe4b952fb3be', 0, '2022-10-30 15:31:17'),
(52, '13dd5302ec342d60', 0, '2022-10-30 15:31:54'),
(53, '6637e22e59efc263', 0, '2022-10-30 15:33:54'),
(54, 'a812dbbe18e95a03', 0, '2022-10-30 15:34:20'),
(55, 'd99033969f6c63de', 0, '2022-10-30 15:34:57'),
(56, '769a9ba4afb666d4', 0, '2022-10-30 15:36:02'),
(57, '41bebd6c3fbcd5f7', 0, '2022-10-30 15:38:44'),
(58, '000cc100de36b9a0', 0, '2022-10-30 15:40:13'),
(59, '2c978c736dc8d4f2', 0, '2022-10-30 15:42:38'),
(60, '7e1fa6b2cd5fbd82', 0, '2022-10-30 15:42:46'),
(61, '3b1f9617087f66d7', 0, '2022-10-30 15:44:10'),
(62, 'd9060e9d2b72cbe7', 0, '2022-10-30 15:47:06'),
(63, '983e7e522e83c7fb', 0, '2022-10-30 15:47:12'),
(64, '23292f34d73a0518', 0, '2022-10-31 00:57:08'),
(65, '3c9094cb7d2d473d', 0, '2022-10-31 00:57:21'),
(66, 'd9b13fa69e4ac962', 0, '2022-10-31 00:57:23'),
(67, '4ade33dcea3fb53e', 0, '2022-10-31 00:57:26'),
(68, '2787f47aad6d6bbd', 0, '2022-10-31 18:30:25'),
(69, '77b1df10139c6f52', 0, '2022-10-31 18:30:40'),
(70, '8711c70d95546bf0', 0, '2022-10-31 18:38:31'),
(71, 'a757092d50d2a844', 0, '2022-10-31 18:38:44'),
(72, 'c42545fa6da8df1c', 0, '2022-10-31 18:47:21'),
(73, 'b0f7632b5b18f42d', 0, '2022-11-01 02:13:55'),
(74, '795369fe4ef1637c', 0, '2022-11-01 02:28:22'),
(75, '0542e7b29ced1e1a', 0, '2022-11-01 02:42:46'),
(76, 'fc0abf3fd0e76355', 0, '2022-11-01 02:43:37'),
(77, '812bd74163b948d8', 0, '2022-11-01 02:51:23'),
(78, 'dfae231d256f7505', 0, '2022-11-01 02:51:48'),
(79, 'e286f5afdbea07a8', 0, '2022-11-01 11:46:44'),
(80, 'a351fa0a81103d2e', 0, '2022-11-01 17:59:49'),
(81, 'd92895716ff1045c', 1, '2022-11-01 19:01:25'),
(82, '3e4762bbd1c19570', 1, '2022-11-01 19:05:30'),
(83, '5b893dba1677843f', 1, '2022-11-01 19:05:36'),
(84, '01f371319a7911f8', 0, '2022-11-01 19:05:38'),
(85, '76e93b5e2139bc0a', 1, '2022-11-01 19:45:30'),
(86, '4f8c12191018a835', 1, '2022-11-01 19:45:33'),
(87, 'a8ace14001807baa', 0, '2022-11-01 19:49:28'),
(88, 'd8d0fc4960b251d5', 0, '2022-11-01 19:50:14'),
(89, '0f01a110a087e910', 0, '2022-11-01 19:51:31'),
(90, '31a68bad13b8555e', 0, '2022-11-01 20:07:56'),
(91, '4d9006298718edb3', 0, '2022-11-01 20:14:38'),
(92, 'f53ca6eec0fcc410', 0, '2022-11-01 20:18:03'),
(93, '3f7772f2f002c0b2', 0, '2022-11-01 20:23:55'),
(94, 'cf4083f29720ac95', 0, '2022-11-01 20:42:43'),
(95, 'e1c4bb2ecafbbad8', 0, '2022-11-01 20:58:23'),
(96, '8953fdd25cee9af3', 0, '2022-11-01 21:19:30'),
(97, 'a990e255ba1ef4ee', 1, '2022-11-02 00:56:17'),
(98, '5ef8fdfab06c9af4', 0, '2022-11-02 01:21:28'),
(99, '31840ceb91ba3302', 0, '2022-11-02 02:06:23'),
(100, '60eb5f7049178f62', 1, '2022-11-02 02:44:16'),
(101, '1e46e7646e15b1a1', 1, '2022-11-02 04:03:38'),
(102, 'd841836cda787ce8', 0, '2022-11-02 04:03:53'),
(103, '0b833164eae64db4', 0, '2022-11-02 04:04:32'),
(104, '7e265aad0607b979', 0, '2022-11-02 04:04:34'),
(105, 'cf8e8d3d0705679f', 0, '2022-11-02 04:04:35'),
(106, '165a9005acf0ad8b', 0, '2022-11-02 04:04:36'),
(107, 'f13631ac91922d9d', 1, '2022-11-02 04:06:36'),
(108, '053f7889f78b3177', 1, '2022-11-02 04:07:25'),
(109, '07432aa57d387c98', 1, '2022-11-02 04:07:33'),
(110, '8e5e6cdfb708f782', 1, '2022-11-02 04:08:32'),
(111, 'a706c6c7a6e19bd9', 1, '2022-11-02 04:08:34'),
(112, 'a706c6c7a6e19bd9', 0, '2022-11-02 04:08:34'),
(113, '537ae3c3185fa751', 1, '2022-11-02 04:08:49'),
(114, 'b163bbfa747e5f4b', 1, '2022-11-02 04:12:02'),
(115, '21c753df7abf7f55', 1, '2022-11-02 04:13:51'),
(116, '990dfbd1933fa71d', 0, '2022-11-02 04:14:03'),
(117, '5398bcf2e627f600', 1, '2022-11-02 04:14:06'),
(118, '5ebb09c2a6dbb263', 0, '2022-11-02 04:14:12'),
(119, '7fcf9c311bcac4ae', 1, '2022-11-02 04:14:22'),
(120, 'c3ad603bb2af533e', 0, '2022-11-02 04:14:51'),
(121, 'f0c75ea9d2701c80', 0, '2022-11-02 04:16:16'),
(122, '2888bde0f9506706', 1, '2022-11-02 04:16:34'),
(123, '279d630f17014d08', 0, '2022-11-02 04:18:06'),
(124, '8cc8ce2f7a0b0a88', 0, '2022-11-02 04:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(16, '::1', 'akmalmf007@gmail.com', NULL, '2022-10-18 21:19:31', 0),
(17, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:20:49', 1),
(18, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:26:04', 1),
(19, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:27:18', 1),
(20, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:27:42', 1),
(21, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:28:13', 1),
(22, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:28:25', 1),
(23, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:34:13', 1),
(24, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:34:25', 1),
(25, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:34:41', 1),
(26, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:35:03', 1),
(27, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:35:13', 1),
(28, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:35:20', 1),
(29, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:38:15', 1),
(30, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:38:25', 1),
(31, '::1', 'akmalmf007@gmail.com', 7, '2022-10-18 21:44:52', 1),
(32, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 03:07:14', 1),
(33, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 03:12:29', 1),
(34, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 03:12:51', 1),
(35, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 03:12:56', 1),
(36, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 03:13:48', 1),
(37, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 03:15:49', 1),
(38, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 03:23:25', 1),
(39, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 04:03:25', 1),
(40, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 04:06:56', 1),
(41, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 04:33:12', 1),
(42, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 04:39:04', 1),
(43, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 04:45:54', 1),
(44, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 04:46:38', 1),
(45, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 04:46:50', 1),
(46, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 04:50:14', 1),
(47, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 04:59:26', 1),
(48, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 05:03:24', 1),
(49, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 05:03:37', 1),
(50, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 05:05:26', 1),
(51, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 05:09:14', 1),
(52, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 05:11:13', 1),
(53, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 05:16:35', 1),
(54, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 05:16:47', 1),
(55, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 05:35:31', 1),
(56, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 05:46:54', 1),
(57, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 05:49:48', 1),
(58, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 06:00:09', 1),
(59, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 06:01:27', 1),
(60, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 06:01:45', 1),
(61, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 06:02:37', 1),
(62, '::1', 'akmalmf007@gmail.com', 7, '2022-10-30 15:31:17', 1),
(63, '::1', 'akmalmf007@gmail.com', 7, '2022-10-30 15:31:54', 1),
(64, '::1', 'akmalmf007@gmail.com', 7, '2022-10-30 15:33:54', 1),
(65, '::1', 'akmalmf007@gmail.com', 7, '2022-10-30 15:34:20', 1),
(66, '::1', 'akmalmf007@gmail.com', 7, '2022-10-30 15:34:57', 1),
(67, '::1', 'akmalmf007@gmail.com', 7, '2022-10-30 15:35:02', 1),
(68, '::1', 'akmalmf007@gmail.com', 7, '2022-10-30 15:36:02', 1),
(69, '::1', 'akmalmf007@gmail.com', 7, '2022-10-30 15:38:44', 1),
(70, '::1', 'akmalmf007@gmail.com', 7, '2022-10-30 15:40:13', 1),
(71, '::1', 'akmalmf007@gmail.com', 7, '2022-10-30 15:42:38', 1),
(72, '::1', 'akmalmf007@gmail.com', 7, '2022-10-30 15:42:46', 1),
(73, '::1', 'akmalmf007@gmail.com', 7, '2022-10-30 15:44:10', 1),
(74, '::1', 'akmalmf007@gmail.com', 7, '2022-10-30 15:47:06', 1),
(75, '::1', 'akmalmf007@gmail.com', 7, '2022-10-30 15:47:12', 1),
(76, '::1', 'akmalmf007@gmail.com', 7, '2022-10-31 00:57:08', 1),
(77, '::1', 'akmalmf007@gmail.com', 7, '2022-10-31 00:57:21', 1),
(78, '::1', 'akmalmf007@gmail.com', 7, '2022-10-31 00:57:23', 1),
(79, '::1', 'akmalmf007@gmail.com', 7, '2022-10-31 00:57:26', 1),
(80, '::1', 'akmalmf007@gmail.com', 7, '2022-10-31 18:30:25', 1),
(81, '::1', 'akmalmf007@gmail.com', 7, '2022-10-31 18:30:40', 1),
(82, '::1', 'akmalmf007@gmail.com', 7, '2022-10-31 18:38:31', 1),
(83, '::1', 'akmalmf007@gmail.com', 7, '2022-10-31 18:38:44', 1),
(84, '::1', 'akmalmf007@gmail.com', 7, '2022-10-31 18:47:21', 1),
(85, '::1', 'akmalmf007@gmail.com', NULL, '2022-10-31 18:49:29', 0),
(86, '192.168.1.25', 'akmalmf007@gmail.com', NULL, '2022-11-01 02:13:44', 0),
(87, '192.168.1.25', 'akmalmf007@gmail.com', NULL, '2022-11-01 02:13:53', 0),
(88, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-01 02:13:55', 1),
(89, '192.168.1.25', 'akmal@a.a', NULL, '2022-11-01 02:24:39', 0),
(90, '192.168.1.25', 'akmal@a.a', NULL, '2022-11-01 02:24:44', 0),
(91, '192.168.1.25', 'akmal@a.a', NULL, '2022-11-01 02:26:20', 0),
(92, '::1', 'akmalmf007@gmail.com', 7, '2022-11-01 02:28:22', 1),
(93, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-01 02:42:46', 1),
(94, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-01 02:43:37', 1),
(95, '192.168.1.25', 'akmalmf007@gmail.com', NULL, '2022-11-01 02:51:20', 0),
(96, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-01 02:51:23', 1),
(97, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-01 02:51:48', 1),
(98, '192.168.1.25', 'akmalmf007@gmail.com', NULL, '2022-11-01 11:19:01', 0),
(99, '::1', 'akmalmf007@gmail.com', 7, '2022-11-01 11:46:44', 1),
(100, '::1', 'akmalmf007@gmail.com', 7, '2022-11-01 17:59:49', 1),
(101, '::1', 'akmalmf007@gmail.com', 7, '2022-11-01 19:01:25', 1),
(102, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-01 19:45:30', 1),
(103, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-01 19:49:28', 1),
(104, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-01 19:50:14', 1),
(105, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-01 19:51:31', 1),
(106, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-01 20:07:56', 1),
(107, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-01 20:14:38', 1),
(108, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-01 20:18:03', 1),
(109, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-01 20:23:55', 1),
(110, '192.168.137.16', 'akmalmf007@gmail.com', 7, '2022-11-01 20:42:43', 1),
(111, '192.168.137.16', 'akmalmf007@gmail.com', 7, '2022-11-01 20:58:23', 1),
(112, '192.168.137.16', 'akmalmf007@gmail.com', 7, '2022-11-01 21:19:30', 1),
(113, '192.168.137.59', 'akmalmf007@gmail.com', 7, '2022-11-02 00:56:17', 1),
(114, '192.168.137.16', 'akmalmf007@gmail.com', 7, '2022-11-02 01:21:28', 1),
(115, '169.254.213.64', 'akmalmf007@gmail.com', 7, '2022-11-02 02:06:23', 1),
(116, '192.168.1.25', 'akmalmf007@gmail.co', NULL, '2022-11-02 02:44:06', 0),
(117, '192.168.1.25', 'akmalmf007@gmail.co', NULL, '2022-11-02 02:44:10', 0),
(118, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-02 02:44:16', 1),
(119, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-02 04:06:36', 1),
(120, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-02 04:08:49', 1),
(121, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-02 04:14:06', 1),
(122, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-02 04:14:22', 1),
(123, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-02 04:16:16', 1),
(124, '192.168.1.25', 'akmalmf007@gmail.com', 7, '2022-11-02 04:16:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-users', 'Admin can manage users'),
(2, 'manage-profile', 'Manage user\'s profile');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `id` int(11) NOT NULL,
  `uid` int(11) UNSIGNED NOT NULL,
  `balance` int(11) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`id`, `uid`, `balance`, `updated_at`) VALUES
(4, 7, 200000, '2022-10-18 21:13:51'),
(5, 8, 0, '2022-11-01 03:21:52'),
(7, 10, 0, '2022-11-01 11:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `instansi_id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `profession` varchar(60) NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT 'dokter.png',
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `instansi_id`, `nama`, `profession`, `image`, `price`, `created_at`) VALUES
(1, 2, 'Dr. Akmal Muhamad Firdaus', 'Dokter Cinta', 'dokter.png', 25000, '2022-11-01 12:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `fcm_token`
--

CREATE TABLE `fcm_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `token` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fcm_token`
--

INSERT INTO `fcm_token` (`id`, `user_id`, `token`, `created_at`) VALUES
(1, 7, '$2y$10$1FeJvB6Ov9Hc3408ZChmoOxgsw9q67YvO0WrRJzidG39dugjIg7bK', '2022-10-30 15:47:06'),
(2, 7, '123', '2022-11-01 02:13:55');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `no_invoice` varchar(12) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `total_price` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `registration_code` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `no_invoice`, `user_id`, `dokter_id`, `price`, `discount`, `total_price`, `status`, `registration_code`, `created_at`) VALUES
(1, 'MD-0111-001', 7, 1, 25000, 0, 25000, 0, 'OjTNG7aPYU', '2022-11-01 12:43:40'),
(2, 'MD-0111-002', 7, 1, 25000, 4000, 21000, 0, 'OjTNG7a23s', '2022-11-01 19:11:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1664877094, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `url` varchar(255) NOT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `vaNumber` varchar(60) NOT NULL,
  `payment_method` varchar(10) NOT NULL,
  `payment_name` varchar(60) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `invoice_id`, `reference`, `url`, `qr_code`, `vaNumber`, `payment_method`, `payment_name`, `amount`, `status`, `created_at`) VALUES
(1, 1, 'D6195KK7NFYUPFP3GI1A', 'https://sandbox.duitku.com/topup/topupdirectv2.aspx?ref=BCCMC8YIKQZ7ODFOE', NULL, '7007014004000306', 'BC', 'BCA VA', 25000, 0, '2022-11-01 11:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `reviewed_by` int(11) UNSIGNED NOT NULL,
  `star` int(1) NOT NULL COMMENT '(1-5)',
  `description` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `invoice_id`, `reviewed_by`, `star`, `description`, `created_at`) VALUES
(1, 1, 7, 5, 'Jospar jos genk!', '2022-11-01 19:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'user.jpg',
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `fullname`, `image`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@admin.com', 'admin_123', 'Admin MyDoc', 'user.jpg', '$2y$10$kRPgGIwedIKVIvtwW8wp5.zwIHG0UxlfRpWF2JJ1QATv/T7Z0pWkO', NULL, NULL, NULL, NULL, '1', NULL, 1, 0, '2022-11-01 12:09:22', '2022-11-01 12:09:22', NULL),
(2, 'instansi@instansi.com', 'instansi_kesehatan', 'Rs. Instansi Kesehatan', 'user.jpg', '$2y$10$kRPgGIwedIKVIvtwW8wp5.zwIHG0UxlfRpWF2JJ1QATv/T7Z0pWkO', NULL, NULL, NULL, NULL, '1', NULL, 1, 0, '2022-11-01 12:10:50', '2022-11-01 12:10:50', NULL),
(7, 'akmalmf007@gmail.com', 'akmalmf007936', 'Akmal Muhamad Firdaus', 'user.jpg', '$2y$10$kRPgGIwedIKVIvtwW8wp5.zwIHG0UxlfRpWF2JJ1QATv/T7Z0pWkO', NULL, NULL, NULL, NULL, '1', NULL, 0, 0, '2022-10-18 21:13:51', '2022-10-18 21:13:51', NULL),
(8, 'coder.newbie04@gmail.com', 'coder.newbie04398', 'Akmal Muhamad Firdaus', 'user.jpg', '$2y$10$kRPgGIwedIKVIvtwW8wp5.zwIHG0UxlfRpWF2JJ1QATv/T7Z0pWkO', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2022-11-01 03:21:52', '2022-11-01 03:21:52', NULL),
(10, 'akmalmf0017@gmail.com', 'akmalmf0017883', 'Akmal Muhamad Firdaus', 'user.jpg', '$2y$10$ItIbCN4ldZuv0fE2b58TuO6f9B8icsQcmDItRLx0GoEOii/draijC', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2022-11-01 11:43:10', '2022-11-01 11:43:10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_jwt`
--
ALTER TABLE `auth_jwt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid_2` (`uid`),
  ADD UNIQUE KEY `uid_3` (`uid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instansi_id` (`instansi_id`);

--
-- Indexes for table `fcm_token`
--
ALTER TABLE `fcm_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `dokter_id` (`dokter_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `reviewed_by` (`reviewed_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_jwt`
--
ALTER TABLE `auth_jwt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fcm_token`
--
ALTER TABLE `fcm_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `balance`
--
ALTER TABLE `balance`
  ADD CONSTRAINT `balance_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`instansi_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `fcm_token`
--
ALTER TABLE `fcm_token`
  ADD CONSTRAINT `fcm_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
