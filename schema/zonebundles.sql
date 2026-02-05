-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 05, 2026 at 03:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zonebundles`
--

-- --------------------------------------------------------

--
-- Table structure for table `at_bundles`
--

CREATE TABLE `at_bundles` (
  `id` int(11) NOT NULL,
  `bundle_size_gb` int(11) NOT NULL,
  `price_ghs` decimal(10,2) NOT NULL,
  `label` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `at_bundles`
--

INSERT INTO `at_bundles` (`id`, `bundle_size_gb`, `price_ghs`, `label`, `created_at`) VALUES
(1, 1, 4.50, 'Cheapest', '2026-02-04 01:13:45'),
(2, 2, 9.00, NULL, '2026-02-04 01:13:45'),
(3, 5, 22.50, NULL, '2026-02-04 01:13:45'),
(4, 10, 44.00, 'Popular', '2026-02-04 01:13:45'),
(5, 20, 84.00, NULL, '2026-02-04 01:13:45'),
(6, 50, 199.50, 'Best Value', '2026-02-04 01:13:45'),
(7, 100, 390.00, 'Business', '2026-02-04 01:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `mtn_bundles`
--

CREATE TABLE `mtn_bundles` (
  `id` int(11) NOT NULL,
  `bundle_size_gb` int(11) NOT NULL,
  `price_ghs` decimal(10,2) NOT NULL,
  `label` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mtn_bundles`
--

INSERT INTO `mtn_bundles` (`id`, `bundle_size_gb`, `price_ghs`, `label`, `created_at`) VALUES
(1, 1, 4.70, NULL, '2026-02-04 01:09:21'),
(2, 2, 9.45, NULL, '2026-02-04 01:09:21'),
(3, 3, 14.25, NULL, '2026-02-04 01:09:21'),
(4, 4, 19.10, NULL, '2026-02-04 01:09:21'),
(5, 5, 24.00, 'Most Popular', '2026-02-04 01:09:21'),
(6, 10, 47.00, NULL, '2026-02-04 01:09:21'),
(7, 20, 90.00, NULL, '2026-02-04 01:09:21'),
(8, 50, 205.00, 'Best Value', '2026-02-04 01:09:21'),
(9, 100, 395.00, 'Wholesale', '2026-02-04 01:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `recipient_number` varchar(15) NOT NULL,
  `network` varchar(20) NOT NULL,
  `bundle_size` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `reference`, `recipient_number`, `network`, `bundle_size`, `amount`, `status`, `created_at`) VALUES
(1, 'ZB-993105060', '0591107181', 'mtn', '1GB', 4.70, 'completed', '2026-02-04 02:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `telecel_bundles`
--

CREATE TABLE `telecel_bundles` (
  `id` int(11) NOT NULL,
  `bundle_size_gb` int(11) NOT NULL,
  `price_ghs` decimal(10,2) NOT NULL,
  `label` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `telecel_bundles`
--

INSERT INTO `telecel_bundles` (`id`, `bundle_size_gb`, `price_ghs`, `label`, `created_at`) VALUES
(1, 10, 42.00, 'Starter', '2026-02-04 01:11:18'),
(2, 15, 63.50, NULL, '2026-02-04 01:11:18'),
(3, 20, 85.00, 'Most Popular', '2026-02-04 01:11:18'),
(4, 30, 126.00, NULL, '2026-02-04 01:11:18'),
(5, 50, 200.00, 'Best Value', '2026-02-04 01:11:18'),
(6, 70, 275.00, NULL, '2026-02-04 01:11:18'),
(7, 100, 385.00, 'Business Plan', '2026-02-04 01:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  `referrer_url` text DEFAULT NULL,
  `visit_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `device_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_logs`
--

INSERT INTO `visitor_logs` (`id`, `ip_address`, `user_agent`, `page_url`, `referrer_url`, `visit_time`, `device_type`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/', 'Direct', '2026-02-04 20:24:59', 'Desktop'),
(2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/sitevisits/', 'Direct', '2026-02-04 20:29:29', 'Desktop'),
(3, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/sitevisits/', 'Direct', '2026-02-04 20:30:03', 'Desktop'),
(4, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/sitevisits/', 'Direct', '2026-02-04 20:30:28', 'Desktop'),
(5, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/sitevisits/', 'Direct', '2026-02-04 20:30:51', 'Desktop'),
(6, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/sitevisits/', 'Direct', '2026-02-04 20:36:25', 'Desktop'),
(7, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/sitevisits/', 'http://localhost/zonebundles/orders/', '2026-02-04 20:40:22', 'Desktop'),
(8, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/sitevisits/', 'http://localhost/zonebundles/orders/', '2026-02-04 20:46:56', 'Desktop'),
(9, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/sitevisits/', 'http://localhost/zonebundles/orders/', '2026-02-04 20:47:18', 'Desktop'),
(10, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/sitevisits/', 'http://localhost/zonebundles/orders/', '2026-02-04 20:47:23', 'Desktop'),
(11, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/sitevisits/', 'http://localhost/zonebundles/orders/', '2026-02-04 20:47:26', 'Desktop'),
(12, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/sitevisits/', 'http://localhost/zonebundles/orders/', '2026-02-04 20:47:29', 'Desktop'),
(13, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/sitevisits/', 'http://localhost/zonebundles/orders/', '2026-02-04 20:47:35', 'Desktop'),
(14, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/sitevisits/', 'http://localhost/zonebundles/orders/', '2026-02-04 20:47:38', 'Desktop'),
(15, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/', 'Direct', '2026-02-04 20:50:18', 'Desktop'),
(16, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/', 'Direct', '2026-02-04 20:55:09', 'Desktop'),
(17, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/', 'Direct', '2026-02-04 20:56:01', 'Desktop'),
(18, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:148.0) Gecko/20100101 Firefox/148.0', '/zonebundles/', 'Direct', '2026-02-04 20:57:19', 'Desktop');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `at_bundles`
--
ALTER TABLE `at_bundles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mtn_bundles`
--
ALTER TABLE `mtn_bundles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- Indexes for table `telecel_bundles`
--
ALTER TABLE `telecel_bundles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `at_bundles`
--
ALTER TABLE `at_bundles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mtn_bundles`
--
ALTER TABLE `mtn_bundles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `telecel_bundles`
--
ALTER TABLE `telecel_bundles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
