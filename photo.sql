-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 09:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photo`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_album` varchar(191) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_dibuat` date NOT NULL DEFAULT current_timestamp(),
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `nama_album`, `deskripsi`, `tgl_dibuat`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Tempat', 'Wisata', '2024-02-29', 1, '2024-02-28 18:22:35', '2024-02-28 18:22:35'),
(2, 'Icon', 'icon daerah wisata', '2024-02-29', 1, '2024-02-28 18:26:56', '2024-02-28 18:26:56'),
(3, 'Budaya', 'budaya kota', '2024-02-29', 1, '2024-02-28 21:29:06', '2024-02-28 21:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `isikomentar` text NOT NULL,
  `tglkomentar` date DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tgl_like` date NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `tgl_like`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '2024-02-29', NULL, NULL),
(3, 1, 8, '2024-02-29', NULL, NULL),
(4, 1, 3, '2024-02-29', NULL, NULL),
(5, 1, 7, '2024-02-29', NULL, NULL),
(6, 1, 5, '2024-02-29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_02_24_021941_create_album_table', 1),
(5, '2024_02_24_022016_create_post_table', 1),
(6, '2024_02_24_022036_create_like_table', 2),
(7, '2024_02_24_022054_create_comment_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('zuhro@gmail.com', '$2y$10$HmrCEm3suqA6ogF5o4H0CeqKewyiC3AHqQI0df6c9Suti0Ub/WgPO', '2024-02-28 23:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `judulfoto` varchar(191) NOT NULL,
  `deskripsifoto` text NOT NULL,
  `tglunggah` date NOT NULL DEFAULT current_timestamp(),
  `path` varchar(191) NOT NULL,
  `album_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `likes_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `judulfoto`, `deskripsifoto`, `tglunggah`, `path`, `album_id`, `user_id`, `likes_count`, `created_at`, `updated_at`) VALUES
(1, 'Tugu Malang', 'loc. Malang', '2024-02-29', '-2024-02-29-65dfdce1e3044.jpg', 1, 1, 1, NULL, NULL),
(2, 'Tugu Jojga is the most icon in Yogyakarta', 'loc. Jojga', '2024-02-29', '-2024-02-29-65dfdf4915cf5.jpg', 2, 1, 0, NULL, NULL),
(3, 'Stasiun malang', 'loc. Malang', '2024-02-29', '-2024-02-29-65dfe0850bfb4.jpg', 1, 1, 1, NULL, NULL),
(4, 'Cathedral', 'loc. Malang', '2024-02-29', '-2024-02-29-65dfe095f1713.jpg', 1, 1, 0, NULL, NULL),
(5, 'Malioboro at Midnight', 'loc. Jogja', '2024-02-29', '-2024-02-29-65dfe0b2cd5a4.jpg', 2, 1, 1, NULL, NULL),
(6, 'Beautiful Prambanan', 'salah satu candi yang berada di Indonesia', '2024-02-29', '-2024-02-29-65dfe13f310b3.jpg', 2, 1, 0, NULL, NULL),
(7, 'Masjid Raya Sheikh Zayed', 'masjid', '2024-02-29', '-2024-02-29-65dfe83aa17b6.jpg', 1, 1, 1, NULL, NULL),
(8, 'Malio Street', 'loc. Jogja', '2024-02-29', '-2024-02-29-65dfe858a5ba2.jpg', 2, 1, 1, NULL, NULL),
(10, 'Prambanan', 'candi di Indonesia', '2024-02-29', '-2024-02-29-65dfe8a315421.jpg', 2, 1, 0, NULL, NULL),
(11, 'Pasar Klewer', 'loc. Solo', '2024-02-29', '-2024-02-29-65dfe8b53cc86.jpg', 1, 1, 0, NULL, NULL),
(12, 'Wayang', 'loc. solo', '2024-02-29', '-2024-02-29-65e008593797d.jpg', 3, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `fullname` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `address` text NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `fullname`, `email`, `email_verified_at`, `password`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Zuhro', 'Zuhrotun Auliyaus', 'zuhro@gmail.com', NULL, '$2y$10$doYEVtS8sfB6vtHWE42KBeK7PIQ5Tq/ezSGp2ATSS5lOFEj2Hee5i', 'Sukerjo', NULL, '2024-02-28 18:20:48', '2024-02-28 18:20:48'),
(2, 'bilqis', 'Bilqis Rahmadhani', 'user@gmail.com', NULL, '$2y$10$t7n/59zLjR0BXUealKs54exP/zTOuO33p6H9pm13Pa4mjyJlnSKRu', 'Kebomas', NULL, '2024-02-28 18:36:27', '2024-02-28 18:36:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_user_id_foreign` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_album_id_foreign` (`album_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
