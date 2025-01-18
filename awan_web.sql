-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2024 at 06:15 PM
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
-- Database: `if0_37257636_theroyal`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `product_ids` text NOT NULL,
  `quantity` text NOT NULL,
  `details` text NOT NULL,
  `reffer_id` int(11) NOT NULL,
  `status` enum('neworder','processing','completed','cancelled') NOT NULL DEFAULT 'neworder',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `discounted` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `images` text NOT NULL,
  `description` text NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refference`
--

CREATE TABLE `refference` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `slider` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `in_eng` text NOT NULL,
  `in_urdu` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` text NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `store_name`, `logo`, `slider`, `password`, `in_eng`, `in_urdu`, `email`, `number`, `address`) VALUES
(1, 'The Royal', 'logo.png', 'banner.png', '$2y$10$iO76m6KmvM3mznSP6PXW7.wKXU4saumX8CwCZ8k1b6Ih3cXlpznPa', '<div class=\"order-check\">     <p>To check your order, please check the email you provided when placing the order.</p>     <p>If you didn\'t receive an order ID in your email, or if you mistakenly provided the wrong email, click on the WhatsApp icon to contact us.</p> <form method=\"post\">     <div class=\"d-flex justify-content-between align-items-center\">     <strong>Thank you!</strong>     <input type=\"submit\" value=\"Translate\" class=\"translate-btn\" name=\"translate\">     </div>     </form> </div>', '<div class=\"order-check\"> <p>اپنے آرڈر کی تصدیق کے لیے، براہ کرم وہ ای میل چیک کریں جو آپ نے آرڈر دیتے وقت فراہم کی تھی۔</p> <p>اگر آپ کو اپنی ای میل میں آرڈر آئی ڈی موصول نہیں ہوئی یا آپ نے غلط ای میل فراہم کی ہے، تو واٹس ایپ آئیکن پر کلک کر کے ہم سے رابطہ کریں۔</p>  <form method=\"post\"> <div class=\"d-flex justify-content-between align-items-center\"> <strong>شکریہ!</strong> <input type=\"submit\" value=\"Translate\" class=\"translate-btn\" name=\"translate\"> </div> </form> </div>', 'theroyal.info4u@gmail.com', '+92 308 6272910', 'Mohallah Babu Gulab, Gujar Khan, Rawalpindi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refference`
--
ALTER TABLE `refference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `refference`
--
ALTER TABLE `refference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
