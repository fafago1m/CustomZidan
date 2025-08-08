-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2025 at 06:10 PM
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
-- Database: `laravel_act_toko`
--

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
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1754569056),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1754569056;', 1754569056),
('laravel-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1754572806),
('laravel-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1754572806;', 1754572806);

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
(4, '2025_08_07_120138_create_produks_table', 2),
(5, '2025_08_07_120217_create_transaksis_table', 2),
(6, '2025_08_07_125543_create_payment_settings_table', 3),
(7, '2025_08_07_134703_add_codeqr_to_payment_settings_table', 4),
(8, '2025_08_07_144523_add_amount_and_kode_unik_to_transaksis_table', 5);

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
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `apikey` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `codeqr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `apikey`, `username`, `token`, `created_at`, `updated_at`, `codeqr`) VALUES
(1, 'fafa1', 'fafa', '1300158%3AAfjoc12nKqxvLzFQHbU87JO5BWtiTr', '2025-08-07 06:15:55', '2025-08-08 09:06:47', ';k;mkjkljklj');

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tipe` enum('file','link') NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `harga` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `nama`, `deskripsi`, `gambar`, `tipe`, `file_path`, `link`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'test', 'aaaa', 'produk-images/01K227CRYKBWYVNW4JJ3T3Q5PJ.PNG', 'link', NULL, 'https://web.fafastore.com/', 300, '2025-08-07 05:16:48', '2025-08-08 09:05:15');

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
('b9HLb3NXFHZlcrn2DkXkLGnr2ch6Ba3DbnUoZKvT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVUlFcWZLVXVxYnhmVVhTVUw2bVRva2JGRDV5TG90S2x4VHV5SGJKWSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEyJGxiOFB3amRMcTVMazkwV0RSZFhBWk9oZmNJT0pKQnZ2ZzhXMk41dzluMi5razY4RnhaZ2YyIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1MToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3BheW1lbnQtc2V0dGluZ3MvMS9lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1754669383),
('fbbMMPyTKwX5IO29s6nMxabU5ZdSoLDi40rZkWm0', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMlBNZTB1NjFIWnlPSXg0R2hmTjZoa0hwSkk3czhNRE5IVXFVYjVhRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRsYjhQd2pkTHE1TGs5MFdEUmRYQVpPaGZjSU9KSkJ2dmc4VzJONXc5bjIua2s2OEZ4WmdmMiI7fQ==', 1754666348),
('Io69Ka3VovrD0Jgv9oTnIiwO6TqfqraXcWr5aYxS', 1, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiOVRJVFgzRDF4Q1NnRmk3ZUgwUGxhTGpkcDJIUno4MDhqOEdtQlJGeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjE6e2k6MDtzOjU6ImVycm9yIjt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkbGI4UHdqZExxNUxrOTBXRFJkWEFaT2hmY0lPSkpCdnZnOFcyTjV3OW4yLmtrNjhGeFpnZjIiO3M6NToiZXJyb3IiO3M6MjQ2OiJHYWdhbCBjZWsgbXV0YXNpOiBmaWxlX2dldF9jb250ZW50cyhodHRwczovL2FjdHJlc3NhcGkudmVyY2VsLmFwcC9vcmRlcmt1b3RhL211dGFzaXFyP2FwaWtleT1mYWZhMSZhbXA7dXNlcm5hbWU9ZmFmYWdhbWluZyZhbXA7dG9rZW49MTMwMDE1OCUzQUFmam9jMTJuS3F4dkx6RlFIYlU4N0pPNUJXdGlUcjNEKTogRmFpbGVkIHRvIG9wZW4gc3RyZWFtOiBIVFRQIHJlcXVlc3QgZmFpbGVkISBIVFRQLzEuMSA0MDMgRm9yYmlkZGVuDQoiO30=', 1754668238),
('skiDnWdKc1JEfWpP3fmxWC3p4bCgX9MJSGk25Jnh', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTHB6TG1kaHZFUzhubE5Xdms4S2Yyb3daaG1pRk9Pb3hyWHdEanRPTCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEyJGxiOFB3amRMcTVMazkwV0RSZFhBWk9oZmNJT0pKQnZ2ZzhXMk41dzluMi5razY4RnhaZ2YyIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1MToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3BheW1lbnQtc2V0dGluZ3MvMS9lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1754669385),
('xJdIVvowephOsL35nc6TnXJ5UxZtlkmfz3PpR9vz', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiZmJVS2xnSEZMMW91ZFd6V1JuTk1yMjJxUnNxNVZYbDB3WHVkYnpTcyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYXltZW50LXNldHRpbmdzLzEvZWRpdCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRsYjhQd2pkTHE1TGs5MFdEUmRYQVpPaGZjSU9KSkJ2dmc4VzJONXc5bjIua2s2OEZ4WmdmMiI7czo2OiJ0YWJsZXMiO2E6MTp7czo0MToiMzRmNTAxZmE5Nzg2NWJhMDUzMzJiYzYzMmRiMmVkMTBfcGVyX3BhZ2UiO3M6MzoiYWxsIjt9czo4OiJmaWxhbWVudCI7YTowOnt9fQ==', 1754669218);

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_wa` varchar(255) NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `kode_unik` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `nama`, `email`, `no_wa`, `produk_id`, `status`, `created_at`, `updated_at`, `amount`, `kode_unik`) VALUES
(1, 'fafa', 'oteyyalfin@gmail.com', '0898989', 1, 'paid', '2025-08-07 05:36:58', '2025-08-07 05:52:30', NULL, NULL),
(2, 'fafa', 'oteyyalfin@gmail.com', '0898989', 1, 'paid', '2025-08-07 05:37:01', '2025-08-07 05:43:51', NULL, NULL),
(3, 'HENDI IFRABOWO SDR', 'alfacastel3@gmail.com', '0898989', 1, 'pending', '2025-08-07 07:17:55', '2025-08-07 07:17:55', NULL, NULL),
(4, 'HENDI IFRABOWO SDR', 'alfacastel3@gmail.com', '0898989', 1, 'pending', '2025-08-07 07:18:07', '2025-08-07 07:18:07', NULL, NULL),
(5, 'HENDI IFRABOWO SDR', 'alfacastel3@gmail.com', '0898989', 1, 'pending', '2025-08-07 07:18:55', '2025-08-07 07:18:55', NULL, NULL),
(6, 'HENDI IFRABOWO SDR', 'alfacastel3@gmail.com', '0898989', 1, 'pending', '2025-08-07 07:27:08', '2025-08-07 07:27:08', NULL, NULL),
(7, 'HENDI IFRABOWO SDR', 'alfacastel3@gmail.com', '0898989', 1, 'pending', '2025-08-07 07:55:57', '2025-08-07 07:55:57', NULL, 97),
(8, 'HENDI IFRABOWO SDR', 'alfacastel3@gmail.com', '0898989', 1, 'pending', '2025-08-07 08:01:32', '2025-08-07 08:01:32', NULL, 10),
(9, 'HENDI IFRABOWO SDR', 'alfacastel3@gmail.com', '0898989', 1, 'pending', '2025-08-07 08:08:52', '2025-08-07 08:08:52', NULL, 73),
(10, 'HENDI IFRABOWO SDR', 'alfacastel3@gmail.com', '0898989', 1, 'pending', '2025-08-07 08:13:05', '2025-08-07 08:13:05', 361, 61),
(11, 'HENDI IFRABOWO SDR', 'alfacastel3@gmail.com', '0898989', 1, 'paid', '2025-08-07 08:16:41', '2025-08-07 09:15:24', 394, 94),
(12, 'HENDI IFRABOWO SDR', 'alfacastel3@gmail.com', '0898989', 1, 'pending', '2025-08-07 08:42:44', '2025-08-07 08:42:44', 342, 42),
(13, 'HENDI IFRABOWO SDR', 'alfacastel3@gmail.com', '0898989', 1, 'pending', '2025-08-07 08:47:54', '2025-08-07 08:47:54', 391, 91),
(14, 'HENDI IFRABOWO SDR', 'alfacastel3@gmail.com', '0898989', 1, 'paid', '2025-08-07 08:49:03', '2025-08-07 09:15:24', 319, 19),
(15, '3rr', 'admin@example.com', '0898989', 1, 'pending', '2025-08-08 00:25:12', '2025-08-08 00:25:12', 339, 39),
(16, '3rr', 'admin@example.com', '0898989', 1, 'pending', '2025-08-08 00:25:20', '2025-08-08 00:25:20', 364, 64),
(17, '3rr', 'admin@example.com', '0898989', 1, 'pending', '2025-08-08 00:25:24', '2025-08-08 00:25:24', 366, 66),
(18, 'HENDI IFRABOWO SDR', 'prazudadoni@gmail.com', '0898989', 1, 'paid', '2025-08-08 00:44:57', '2025-08-08 00:48:04', 347, 47),
(19, 'kjkjnkj', 'prazudadoni@gmail.com', '0898989', 1, 'pending', '2025-08-08 01:13:30', '2025-08-08 01:13:30', 310, 10),
(20, 'HENDI IFRABOWO SDR', 'admin@example.com', '0898989', 1, 'pending', '2025-08-08 06:24:13', '2025-08-08 06:24:13', 398, 98),
(21, 'HENDI IFRABOWO SDR', 'admin@example.com', '0898989', 1, 'pending', '2025-08-08 06:24:22', '2025-08-08 06:24:22', 375, 75),
(22, 'HENDI IFRABOWO SDR', 'admin@example.com', '0898989', 1, 'pending', '2025-08-08 06:52:26', '2025-08-08 06:52:26', 304, 4),
(23, 'HENDI IFRABOWO SDR', 'admin@example.com', '0898989', 1, 'pending', '2025-08-08 07:30:52', '2025-08-08 07:30:52', 396, 96),
(24, 'HENDI IFRABOWO SDR', 'admin@example.com', '0898989', 1, 'paid', '2025-08-08 07:52:07', '2025-08-08 08:59:27', 374, 74),
(25, 'risky', 'alfacastel3@gmail.com', '08976544368', 1, 'paid', '2025-08-08 09:00:56', '2025-08-08 09:01:23', 303, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'fafa', 'fafa@gmail.com', NULL, '$2y$12$lb8PwjdLq5Lk90WDRdXAZOhfcIOJJBvvg8W2N5w9n2.kk68FxZgf2', '02Mlu1ENkR5lvUITKkYPpNJsiJX6OUv8yNzclincEXUuEgIdNg1XRnuq6ozR', '2025-08-07 04:19:17', '2025-08-07 04:19:17');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksis_produk_id_foreign` (`produk_id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
