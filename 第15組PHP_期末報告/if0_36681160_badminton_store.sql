-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： sql313.infinityfree.com
-- 生成日期： 2024-06-14 00:55:47
-- 服务器版本： 10.4.17-MariaDB
-- PHP 版本： 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `if0_36681160_badminton_store`
--

-- --------------------------------------------------------

--
-- 表的结构 `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'cy0215', '$2y$10$yLJYJ4dwVWYHf7mOCddx4.HQj7ZldBH6tGaJNpmpH/dD3DMtJAOBK', 'chenyitang0435@gmail.com', '2024-05-22 10:09:09');

-- --------------------------------------------------------

--
-- 表的结构 `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_address` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `order_status`, `payment_method`, `shipping_address`, `created_at`) VALUES
(1, 1, '3000.00', 'Pending', '', '', '2024-06-05 13:02:33'),
(2, 1, '7000.00', 'Pending', 'credit_card', 'qqqqqq', '2024-06-05 13:03:27'),
(3, 1, '7000.00', 'Pending', 'credit_card', 'aaaaaaa', '2024-06-05 13:06:02'),
(4, 1, '7000.00', 'Pending', 'credit_card', 'fffff', '2024-06-05 13:09:29'),
(5, 1, '8500.00', 'Pending', 'credit_card', '高雄大學管院', '2024-06-06 01:18:49'),
(6, 1, '8500.00', 'Pending', 'credit_card', 'aaa', '2024-06-09 05:30:55'),
(7, 1, '7000.00', 'Pending', 'credit_card', 'national university', '2024-06-11 01:32:32'),
(8, 1, '8500.00', 'Pending', 'credit_card', 'kaohsiong\r\n', '2024-06-13 02:07:57');

-- --------------------------------------------------------

--
-- 表的结构 `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`) VALUES
(1, 1, 1, 1, '3000.00'),
(2, 2, 2, 1, '7000.00'),
(3, 3, 2, 1, '7000.00'),
(4, 4, 2, 1, '7000.00'),
(5, 5, 6, 1, '8500.00'),
(6, 6, 6, 1, '8500.00'),
(7, 7, 2, 1, '7000.00'),
(8, 8, 6, 1, '8500.00');

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_hot` tinyint(1) DEFAULT 0,
  `is_new` tinyint(1) DEFAULT 0,
  `is_special` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `is_hot`, `is_new`, `is_special`) VALUES
(1, 'NANOFLARE 002 CLEAR', '特性:SPEED;平衡點-Head Light Balance;彈性-Hi-Flex;中管結構-Graphite;球拍長度-10mm longer;握把-G5;重量 /建議穿線磅數-4U (Ave. 83g) 20-30lbs', '3000.00', 'racket/NANOFLARE 002 CLEAR.jpg', 0, 0, 1),
(2, 'NANOFLARE 70', '特性:SPEED;平衡點:Head Light Balance;彈性:Hi-Flex;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer;握把尺寸:G5', '7000.00', 'racket/NANOFLARE 70.jpg', 1, 0, 0),
(3, 'NANOFLARE NEXTAGE', '特性:SPEED;平衡點:Head Light Balance;彈性:Medium;球拍長度:10mm longer;握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-28lbs', '4200.00', 'racket/NANOFLARE NEXTAGE.jpg', 0, 1, 0),
(4, 'NANOFLARE 1000 GAME', '特性:SPEED;平衡點:Head Light Balance;彈性:Medium;拍框結構:Graphite;中管結構:Graphite;球拍長度:10mm longer;握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-28lbs', '3500.00', 'racket/NANOFLARE 1000 GAME.jpg', 0, 0, 0),
(5, 'NANOFLARE 1000 TOUR', '特性:SPEED;平衡點:Head Light Balance;彈性:Extra Stiff;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer;握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-28lbs', '4700.00', 'racket/NANOFLARE 1000 TOUR.jpg', 0, 0, 0),
(6, 'NANOFLARE 1000 Z', '特性:SPEED;平衡點:Head Light Balance;彈性:Extra Stiff;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer;握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-28lbs', '8500.00', 'racket/NANOFLARE 1000 Z.jpg', 1, 0, 0),
(7, 'NANOFLARE 800 GAME', '特性:SPEED;平衡點:Head Light Balance;彈性:Medium;拍框結構:Graphite;中管結構:Graphite;球拍長度:10mm longer;握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-28lbs', '3300.00', 'racket/NANOFLARE 800 GAME.jpg', 0, 0, 0),
(8, 'NANOFLARE 800 TOUR', '特性:SPEED;平衡點:Head Light Balance;彈性:Stiff;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer;握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-28lbs', '4700.00', 'racket/NANOFLARE 800 TOUR.jpg', 0, 0, 0),
(9, 'NANOFLARE 800 PRO', '特性:SPEED;平衡點:Head Light Balance;彈性:Stiff;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer;握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-28lbs', '8300.00', 'racket/NANOFLARE 800 PRO.jpg', 1, 0, 0),
(10, 'ASTROX NEXTAGE', '特性:POWER;平衡點:Head Light Balance;彈性:Medium;拍框結構:Graphite;中管結構:Graphite;球拍長度:10mm longer;握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-28lbs', '4200.00', 'racket/ASTROX NEXTAGE.jpg', 0, 1, 0),
(11, 'ASTROX 70', '特性:POWER;平衡點:Head Light Balance;彈性:HI-FLEX;拍框結構:HM Graphite中管結構:HM Graphite;球拍長度:10mm longer;握把尺寸:G5', '7000.00', 'racket/ASTROX 70.jpg', 0, 0, 1),
(12, 'ASTROX 77 PRO', '特性:POWER;平衡點:Head Heavy Balance;彈性:Medium;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer:握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-28lbs', '7300.00', 'racket/ASTROX 77 PRO.jpg', 0, 0, 0),
(13, 'ASTROX 88 D PRO', '特性:POWER;平衡點:Head Heavy Balance;彈性:Stiff;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer:握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-28lbs', '8100.00', 'racket/ASTROX 88 D PRO.jpg', 1, 0, 0),
(14, 'ASTROX 88 S PRO', '特性:POWER;平衡點:Head Heavy Balance;彈性:Stiff;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer:握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-28lbs', '8100.00', 'racket/ASTROX 88 S PRO.jpg', 0, 0, 0),
(15, 'ARCSABER 7 PRO', '特性:ACCURACY;平衡點:Head Heavy Balance;彈性:Stiff;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer:握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 19-27lbs', '7300.00', 'racket/ARCSABER 7 PRO.jpg', 0, 0, 0),
(16, 'ARCSABER 11 PRO', '特性:ACCURACY;平衡點:Head Heavy Balance;彈性:Stiff;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer:握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 19-27lbs', '8100.00', 'racket/ARCSABER 11 PRO.jpg', 0, 0, 0),
(17, 'ASTROX 100ZZ', '特性:POWER;平衡點:Head Heavy Balance;彈性:Extra Stiff;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer:握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-28lbs', '7800.00', 'racket/ASTROX 100ZZ.jpg', 0, 0, 0),
(18, 'ASTROX 99 PRO', '特性:POWER;平衡點:Head Heavy Balance;彈性:Extra Stiff;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer:握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-28lbs', '7700.00', 'racket/ASTROX 99 PRO.jpg', 0, 0, 0),
(19, 'NANOFLARE 270 SPEED', '特性:SPEED;平衡點:Head Light Balance;彈性:Medium;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer;握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 19-26lbs', '3100.00', 'racket/NANOFLARE 270 SPEED.jpg', 0, 0, 0),
(20, 'NANOFLARE 700', '特性:SPEED;平衡點:Head Light Balance;彈性:Medium;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer;握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 19-27lbs', '7000.00', 'racket/NANOFLARE 700.jpg', 0, 0, 0),
(21, 'ASTROX 22 F', '特性:POWER;平衡點:Head Heavy Balance;彈性:Medium;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer;握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-28lbs', '4000.00', 'racket/ASTROX 22 F.jpg', 0, 0, 0),
(22, 'ASTROX 3 DG HF', '特性:POWER;平衡點:Head Heavy Balance;彈性:HI-FLEX;拍框結構:HM Graphite;中管結構:HM Graphite;球拍長度:10mm longer;握把尺寸:G5;重量 /建議穿線磅數:4U (Ave. 83g) 20-35lbs', '2800.00', 'racket/ASTROX 3 DG HF.jpg', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'a1103329', '$2y$10$rkHbjNRGbPVk1KdWXiVx9.4.8uzsRZW6CwlgezveH99m4Ijp.XtyK', 'a1103329@mail.nuk.edu.tw', '2024-05-22 09:29:15');

--
-- 转储表的索引
--

--
-- 表的索引 `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- 表的索引 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 表的索引 `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- 表的索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- 表的索引 `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- 表的索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 限制导出的表
--

--
-- 限制表 `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- 限制表 `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- 限制表 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- 限制表 `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
