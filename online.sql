-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2021 at 05:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online`
--

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_rate` int(11) NOT NULL,
  `dc` int(11) NOT NULL,
  `sale_rate` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=active , 1=Complete , 2=delete',
  `latest` int(11) NOT NULL DEFAULT 0 COMMENT '0=latest , 1=old',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `user`, `description`, `purchase_rate`, `dc`, `sale_rate`, `profit`, `status`, `latest`, `created_at`, `updated_at`) VALUES
(1, 4, 'Trip', 100, 50, 1000, 850, 1, 1, '2021-01-03 07:12:15', '2021-01-11 11:06:30'),
(2, 4, 'FABB', 500, 100, 1000, 400, 2, 1, '2021-01-11 09:30:53', '2021-01-11 11:00:01'),
(3, 4, 'Ragbi', 100, 10, 500, 390, 0, 1, '2021-01-11 09:31:28', '2021-01-11 11:03:20');

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
(3, '2021_01_02_112359_add_user_role', 2),
(4, '2021_01_02_141329_add_status', 3),
(5, '2021_01_03_094141_create_details_table', 4),
(7, '2021_01_03_114626_add_status_detail', 5),
(8, '2021_01_11_151111_add_lat_order', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userRole` int(11) NOT NULL COMMENT '1=Admin , 2=Buyers',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=active , 1=delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `userRole`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Arooba', 'aroobaanmol@gmail.com', '$2y$10$1/pdVG14KRGNbqoGxtQKI.8/XItqpcaYM6y6OKSrQ5KkNAMIn0BiG', 1, 0, '2021-01-01 19:00:00', '2021-01-01 19:00:00'),
(2, 'Khubaib Waheed', '03001234567', '$2y$10$SlUB3lGJt0Ej1Y4MUXyWI./Mgt1G3lhDm57j8v6c2XRkBAGwguVt.', 2, 0, '2021-01-02 09:04:46', '2021-01-03 04:32:30'),
(3, 'Saad', '03256585455', '$2y$10$Lnuz8QSvwz0XJYo2AB/E5OdSbCvgJjYNd7iU/rvSOhKG3mgFwhm5i', 2, 0, '2021-01-02 09:21:07', '2021-01-03 04:32:28'),
(4, 'Mena', '03052855885', '$2y$10$6l3aIRRaEbb03leLPsuPbe6PCuZeUOy1ado8jU5.Sen3RCuJdxmcS', 2, 0, '2021-01-03 03:52:54', '2021-01-03 04:38:21'),
(5, 'Allied', '14351354651', '$2y$10$khDFzsRpnkWVmm3eiNTAK.w/cKWl6cbbMHf1dImExZWi8YsP9.xKG', 2, 0, '2021-01-03 07:10:12', '2021-01-03 07:10:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
