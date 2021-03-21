-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2021 at 05:07 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_16_164507_create_suppliers_table', 1),
(5, '2021_03_16_164700_create_products_table', 1),
(6, '2021_03_16_164701_create_orders_table', 1),
(7, '2021_03_16_164702_create_supplier_products_table', 1),
(8, '2021_03_16_165432_create_order_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2021', '2021-03-20 05:24:52', '2021-03-20 05:25:00', NULL),
(2, '20210320 094844', '2021-03-20 06:48:44', '2021-03-20 06:49:12', '2021-03-20 06:49:12'),
(3, '20210320095012', '2021-03-20 06:50:12', '2021-03-20 06:50:12', NULL),
(4, '20210320095022', '2021-03-20 06:50:22', '2021-03-20 06:50:22', NULL),
(5, '20210320095025', '2021-03-20 06:50:25', '2021-03-20 06:50:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 21, '2021-03-20 08:32:01', '2021-03-20 08:32:01', NULL),
(2, 5, 21, '2021-03-20 08:32:59', '2021-03-20 08:32:59', NULL),
(3, 5, 17, '2021-03-20 08:32:59', '2021-03-20 08:32:59', NULL),
(4, 5, 17, '2021-03-20 08:35:34', '2021-03-20 08:35:34', NULL),
(5, 5, 21, '2021-03-20 08:35:34', '2021-03-20 08:35:34', NULL),
(8, 5, 17, '2021-03-20 08:46:39', '2021-03-20 08:46:39', NULL),
(9, 5, 17, '2021-03-20 08:47:10', '2021-03-20 08:47:10', NULL),
(10, 5, 21, '2021-03-20 08:47:10', '2021-03-20 08:47:10', NULL),
(11, 5, 17, '2021-03-20 08:48:24', '2021-03-20 08:48:24', NULL),
(12, 5, 21, '2021-03-20 08:48:24', '2021-03-20 08:48:24', NULL),
(13, 5, 17, '2021-03-20 08:49:33', '2021-03-20 08:49:33', NULL),
(14, 5, 17, '2021-03-20 08:49:33', '2021-03-20 09:50:26', '2021-03-20 09:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'HikVision Camera', '12 fish eye P1 description', '12', '2021-03-17 16:47:58', '2021-03-19 18:25:34', '2021-03-19 18:25:34'),
(2, 'Product 1', 'P2 description', '5 Kgs', '2021-03-18 13:03:39', '2021-03-19 18:15:15', '2021-03-19 18:15:15'),
(3, 'HCP', 'Busy Writing', '1000', '2021-03-18 17:45:08', '2021-03-19 18:12:48', '2021-03-19 18:12:48'),
(4, 'SSD', 'One 500 GB SSD', '1', '2021-03-19 16:54:37', '2021-03-19 18:02:34', '2021-03-19 18:02:34'),
(5, 'DDr3', '4GB RAMs', '2', '2021-03-19 17:03:38', '2021-03-19 18:01:22', '2021-03-19 18:01:22'),
(6, 'Lens', 'N/A', '10', '2021-03-19 17:11:50', '2021-03-19 18:00:14', '2021-03-19 18:00:14'),
(7, 'Lens', 'N/A', '10', '2021-03-19 17:12:08', '2021-03-19 17:53:17', '2021-03-19 17:53:17'),
(8, 'Lens', 'N/A', '10', '2021-03-19 17:17:51', '2021-03-19 17:51:11', '2021-03-19 17:51:11'),
(9, 'Camera', '250x zoom', '2', '2021-03-19 18:17:31', '2021-03-19 18:17:48', '2021-03-19 18:17:48'),
(10, 'Camera', '250x zoom', '2', '2021-03-19 18:20:25', '2021-03-19 18:24:11', '2021-03-19 18:24:11'),
(11, 'Camera', '250x zoom', '2', '2021-03-19 18:20:28', '2021-03-19 18:20:42', '2021-03-19 18:20:42'),
(12, 'Mouse', 'N/A', '1', '2021-03-19 18:26:15', '2021-03-19 18:32:33', '2021-03-19 18:32:33'),
(13, 'Keyboard', 'N/A', '2', '2021-03-19 18:26:32', '2021-03-19 18:27:50', '2021-03-19 18:27:50'),
(14, 'Key', 'N/a', '1', '2021-03-19 18:36:18', '2021-03-19 18:41:13', '2021-03-19 18:41:13'),
(15, 'Keyboard', 'N/a', '1', '2021-03-19 18:36:29', '2021-03-19 18:37:37', '2021-03-19 18:37:37'),
(16, 'Mouse', 'N/a', '1', '2021-03-19 18:36:40', '2021-03-19 18:36:54', '2021-03-19 18:36:54'),
(17, 'Printer', 'N/A.', '2', '2021-03-19 18:38:52', '2021-03-20 05:24:34', NULL),
(18, 'Printers', 'N/A', '2', '2021-03-19 18:39:01', '2021-03-20 05:11:25', '2021-03-20 05:11:25'),
(19, 'Printers', 'N/A', '2', '2021-03-19 18:39:03', '2021-03-19 18:43:18', '2021-03-19 18:43:18'),
(20, 'Maiyonaise', 'For seasoning', '10', '2021-03-20 05:10:34', '2021-03-20 05:10:58', '2021-03-20 05:10:58'),
(21, 'Blue Band', 'Prestige omega 3 bluband', '10', '2021-03-20 05:18:04', '2021-03-20 10:58:03', NULL),
(22, 'Blue Triangle', 'Building cement', '10', '2021-03-20 05:18:23', '2021-03-20 05:18:48', '2021-03-20 05:18:48'),
(23, 'Aqua', 'Building aqua', '10', '2021-03-20 05:18:37', '2021-03-20 05:18:44', '2021-03-20 05:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mister Morgan', '2021-03-19 19:08:25', '2021-03-19 19:08:25', NULL),
(2, 'RaiCement Ltd.', '2021-03-19 19:12:20', '2021-03-19 19:14:54', '2021-03-19 19:14:54'),
(3, 'Malcom', '2021-03-20 05:19:03', '2021-03-20 05:19:03', NULL),
(4, 'Malcom X', '2021-03-20 05:19:08', '2021-03-20 05:21:57', '2021-03-20 05:21:57'),
(5, 'Mulch Sue', '2021-03-20 05:19:20', '2021-03-20 05:21:54', '2021-03-20 05:21:54'),
(6, 'Alphayo', '2021-03-20 05:22:04', '2021-03-20 11:09:28', NULL),
(7, 'Alpharos', '2021-03-20 05:22:11', '2021-03-20 11:08:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_products`
--

CREATE TABLE `supplier_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supply_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_products`
--

INSERT INTO `supplier_products` (`id`, `supply_id`, `product_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 21, '2021-03-20 10:19:34', '2021-03-20 10:55:04', NULL),
(2, 6, 17, '2021-03-20 10:22:30', '2021-03-20 10:25:13', NULL),
(3, 7, 21, '2021-03-20 10:25:34', '2021-03-20 10:55:19', NULL),
(4, 7, 17, '2021-03-20 10:25:40', '2021-03-20 10:25:40', NULL),
(5, 7, 17, '2021-03-20 11:00:55', '2021-03-20 11:08:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dennis Kiprotich', 'dekingetich@gmail.com', NULL, '$2y$10$fBgPQzBMowOznEwM6lEZ6ecNKu9T6AHetYR/FrJtWWs63EsPGHege', NULL, '2021-03-17 09:50:17', '2021-03-17 09:50:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_products`
--
ALTER TABLE `supplier_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_products_supply_id_foreign` (`supply_id`),
  ADD KEY `supplier_products_product_id_foreign` (`product_id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplier_products`
--
ALTER TABLE `supplier_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier_products`
--
ALTER TABLE `supplier_products`
  ADD CONSTRAINT `supplier_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_products_supply_id_foreign` FOREIGN KEY (`supply_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
