-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2022 at 01:24 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `product_code` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `units_product` int(11) NOT NULL,
  `total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` int(12) NOT NULL,
  `units` int(5) NOT NULL,
  `total` int(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_code`, `product_name`, `price`, `units`, `total`, `date`, `email`) VALUES
(11, 'WEB2', 'Whiskas 40gr', 40000, 1, 40000, '2019-05-07 01:13:16', 'rizkyhh1999@gmail.com'),
(12, 'WEB3', 'Dog Food', 120000, 1, 120000, '2019-05-07 01:25:55', ''),
(13, 'WEB7', 'Toy Dog', 10230000, 1, 10230000, '2022-07-08 10:45:40', 'pedro@gmail.com'),
(14, 'WEB1', 'Cihuahua Wah', 9000000, 1, 9000000, '2022-07-08 10:45:46', 'pedro@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productid` int(11) NOT NULL,
  `product_code` varchar(60) NOT NULL,
  `product_desc` tinytext DEFAULT NULL,
  `product_img_name` varchar(60) NOT NULL,
  `qty_product` int(11) NOT NULL,
  `price_product` float NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_type` varchar(30) DEFAULT 'pet',
  `product_rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productid`, `product_code`, `product_desc`, `product_img_name`, `qty_product`, `price_product`, `product_name`, `product_type`, `product_rating`) VALUES
(1, 'WEB1', 'Ini adalah anjing cihuahua yang wah', 'chihuahuawah.jpg', 0, 9000000, 'Cihuahua Wah', 'pet', 4),
(2, 'WEB2', 'Makanan kucing terbaik whiskas 40gr', 'whiskas.jpg', 43, 40000, 'Whiskas 40gr', 'food', 3),
(3, 'WEB3', 'Ini makanan anjing terbaik', 'dogfood.jpg', 97, 120000, 'Dog Food', 'food', 5),
(4, 'WEB4', 'Mainan landak Terbaik', 'landaktoy.jpg', 20, 100000, 'Landak Roll', 'toy', 2),
(5, 'WEB5', 'Aquarium terbaik dari atlantis', 'aquarium1.jpg', 4, 50000000, 'Aquarium Aquaman', 'place', 3),
(6, 'WEB6', 'Decor Untuk Kamar Kucing', 'decorcat.jpg', 15, 340000, 'Decor Cat Room', 'acessoris', 5),
(7, 'WEB7', 'Mainan Untuk Anjing Jinak Kalo Galak Jangan Beli', 'jinak.jpg', 29, 10230000, 'Toy Dog', 'toy', 2),
(8, 'WEB8', 'Baju Untuk Kucing Eksclusif', 'bajukucing.jpg', 100, 60000000, 'Baju Kucing', 'clothes', 5),
(9, 'WEB9', 'Baju Untuk Kucing Miskin', 'bajukucingmis.jpg', 200, 5999, 'Baju Kucing Miskin', 'clothes', 1),
(10, 'VCS', 'Anjing ras Asia umur 2tahun', '5cd0c8a69b596.jpg', 4, 200000, 'Anjing Ras Asia', 'pet', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_city` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `user_sex` enum('M','F') NOT NULL,
  `date_entered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_address`, `user_city`, `email`, `password`, `user_type`, `user_sex`, `date_entered`) VALUES
(13, 'admin', 'admin', 'admin', 'admin', 'admin@gmail.com', '$2y$10$1E2rbSpUXZJutIyF5lISEuLHabqE9qm6vuCjDo3b9h4PorpahNt4G', 'admin', 'M', '2022-07-08 10:52:56'),
(17, 'pedro', 'pedro', 'pedro', 'bekasi', 'pedro@gmail.com', '$2y$10$AdJcYYEq6.M4AJavtr7TK.0XpWscqLIesNe9voeBtm7KtaTFOYKcS', 'user', 'M', '2022-07-08 10:44:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_cartproduct` (`product_code`),
  ADD KEY `fk_cartuser` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productid`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_cartproduct` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`),
  ADD CONSTRAINT `fk_cartuser` FOREIGN KEY (`email`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
