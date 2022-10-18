-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2022 at 01:09 AM
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
(3, 7);

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
(50, 'e8f7875425bdd825', 1, '2022-10-19 06:02:50');

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
(61, '::1', 'akmalmf007@gmail.com', 7, '2022-10-19 06:02:37', 1);

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
(4, 7, 0, '2022-10-18 21:13:51');

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
(7, 'akmalmf007@gmail.com', 'akmalmf007936', 'Akmal Muhamad Firdaus', 'user.jpg', '$2y$10$kRPgGIwedIKVIvtwW8wp5.zwIHG0UxlfRpWF2JJ1QATv/T7Z0pWkO', NULL, NULL, NULL, NULL, '1', NULL, 0, 0, '2022-10-18 21:13:51', '2022-10-18 21:13:51', NULL);

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
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
