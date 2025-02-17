-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2020 at 10:16 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineshop`
--
-- Create the 'onlineshop' database
DROP DATABASE IF EXISTS onlineshop;

CREATE DATABASE IF NOT EXISTS onlineshop;
USE onlineshop;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getcat` (IN `cid` INT)  SELECT * FROM categories WHERE cat_id=cid$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(300) NOT NULL,
  `admin_password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@gmail.com', 'adminpassword');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'Adidas'),
(2, 'Nike'),
(3, 'Under Armour'),
(4, 'Puma'),
(5, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `ip_add`, `user_id`, `qty`) VALUES
(6, 26, '::1', 4, 1),
(9, 10, '::1', 7, 1),
(10, 11, '::1', 7, 1),
(11, 45, '::1', 7, 1),
(44, 5, '::1', 3, 0),
(48, 72, '::1', 3, 0),
(49, 60, '::1', 8, 1),
(50, 61, '::1', 8, 1),
(52, 5, '::1', 9, 1),
(54, 3, '::1', 14, 1),
(55, 5, '::1', 14, 1),
(71, 61, '127.0.0.1', -1, 1),
(155, 72, '::1', 27, 1),
(156, 22, '::1', 0, 1),
(180, 1, '::1', 30, 1),
(181, 1, '::1', 31, 1),
(182, 2, '::1', 32, 1),
(183, 82, '::1', -1, 1),
(184, 1, '::1', -1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'T-Shirts'),
(2, 'Shorts'),
(3, 'Leggings'),
(4, 'Shoes'),
(5, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `email_info`
--

CREATE TABLE `email_info` (
  `email_id` int(100) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_info`
--

INSERT INTO `email_info` (`email_id`, `email`) VALUES
(3, 'admin@gmail.com'),
(4, 'dominicteow.2020@scis.smu.edu.sg'),
(5, 'rhys.tan.2020@scis.smu.edu.sg');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `p_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `qty`, `trx_id`, `p_status`) VALUES
(1, 12, 7, 1, '07M47684BS5725041', 'Completed'),
(2, 14, 2, 1, '07M47684BS5725041', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `orders_info`
--

CREATE TABLE `orders_info` (
  `order_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` int(10) NOT NULL,
  `cardname` varchar(255) NOT NULL,
  `cardnumber` varchar(20) NOT NULL,
  `expdate` varchar(255) NOT NULL,
  `prod_count` int(15) DEFAULT NULL,
  `total_amt` int(15) DEFAULT NULL,
  `cvv` int(5) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_info`
--

-- INSERT INTO `orders_info` (`order_id`, `user_id`, `f_name`, `email`, `address`, `city`, `state`, `zip`,   `cardname`, `cardnumber`, `expdate`, `prod_count`, `total_amt`, `cvv`, `status`) VALUES
-- (1, 27, 'rhys', 'rhystan3@gmail.com', 'mysore', 'singap', 'mysore', 123456, 'ttt', '5264111122223333', '12/22', 2, 100, 211, 'pending'),
-- (2, 28, 'dom', 'dominicteow@gmail.com', 'mysore', 'singap', 'mysore', 123456, 'ttt', '5264111122223333', '12/22', 5, 750, 211, 'packing'),
-- (3, 28, 'dom', 'dominicteow@gmail.com', 'mysore', 'singap', 'mysore', 123456, 'ttt', '5264111122223333', '12/22', 5, 750, 211, 'delivering');


-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_pro_id` int(10) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(15) DEFAULT NULL,
  `amt` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text,
  `product_image` text,
  `product_keywords` text,
  `qty` int(100) NOT NULL,
  `product_discount` varchar(100),
  `product_type` varchar(100)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`, `qty`, `product_type`) VALUES
(1, 1, 1, 'Adidas Men T-Shirt', 100, 'Adidas Men T-Shirt', '/mens/adidas_men_tshirt_1.webp', 'Adidas', 100, "Men"),
(2, 1, 2, 'Nike Men T-Shirt', 100, 'Nike Men T-Shirt', '/mens/nike_men_tshirt_1.jpg', 'Nike', 100, "Men"),
(3, 1, 1, 'Adidas Women T-Shirt', 100, 'Adidas Women T-Shirt', '/womens/adidas_women_tshirt_1.jpg', 'Adidas', 100, "Women"),
(4, 3, 2, 'Nike Women Leggings', 150, 'Nike Women Leggings', '/womens/nike_women_leggings_1.webp', 'Nike', 100, "Women"),
(5, 1, 1, 'Adidas Women T-Shirt Black Classic', 65, 'Adidas Women T-Shirt','/womens/adidas_women_tshirt_2.jpg', 'Adidas', 80, 'Women'),
(6, 1, 1, 'Adidas Women T-Shirt Baby Pink Classic', 50, 'Adidas Women T-Shirt', '/womens/adidas_women_tshirt_3.jpg', 'Adidas', 80, 'Women'),
(7, 3, 2, 'Nike Women Side Logo Leggings', 180, 'Nike Women Leggings', '/womens/nike_women_leggings_2.jpg', 'Nike', 100, "Women"),
(8, 3, 2, 'Nike Women Hot Pink Leggings', 140, 'Nike Women Leggings', '/womens/nike_women_leggings_3.webp', 'Nike', 100, "Women"),
(9, 4, 2, 'Nike Limited Edition Air Force', 450, 'Nike Women Shoes', '/womens/nike_women_shoes_1.webp', 'Nike', 30, 'Women'),
(10, 4, 2, 'Nike Running Shoes', 95, 'Nike Women Shoes', '/womens/nike_women_shoes_2.webp', 'Nike', 100, 'Women'),
(11, 4, 2, 'Nike Pink and Cream Dunks', 315, 'Nike Women Shoes', '/womens/nike_women_shoes_3.webp', 'Nike', 70, 'Women'),
(12, 5, 5, 'Basic Cargo Skirt', 50, 'Cargo Skirt Women','/womens/womens9.webp', 'Others', 80, 'Women'),
(13, 1, 1, 'Adidas Red Men T-Shirt', 80, 'Adidas Men T-Shirt', '/mens/adidas_men_tshirt_2.webp', 'Adidas', 100, "Men"),
(14, 1, 1, 'Adidas Men Yellow Dry-Fit T-Shirt', 30, 'Adidas Men T-Shirt', '/mens/adidas_men_tshirt_3.webp', 'Adidas', 70, "Men"),
(15, 2, 2, 'Nike Men Classic Shorts', 45, 'Adidas Men Shorts', '/mens/nike_men_shorts_1.jpg', 'Nike', 100, "Men"),
(16, 1, 2, 'Nike Spotted Men T-Shirt', 55, 'Adidas Men T-Shirt', '/mens/nike_men_tshirt_2.webp', 'Nike', 70, "Men"),
(17, 2, 3, 'Under Armour Men SHorts', 40, 'Under Armour Men Shorts', '/mens/ua_men_shorts_1.webp', 'Under Armour', 100, "Men");

-- --------------------------------------------------------

--
-- Table structure for table `sup_info`
--

CREATE TABLE `sup_info` (
  `id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `login_time` varchar(100) NOT NULL,
  `logout_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sup_info`
--

INSERT INTO `sup_info` (`id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`, `login_time`, `logout_time`) VALUES
(11, 'nikhil', 'l', 'nikhilkeshav76@gmail.com', 'nikhil', '3366445588', 'mysore', 'mysore', 'Feb,20,2020 01:44:13 PM', 'Feb,18,2020 05:39:43 PM');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL,
  `last_login` varchar(100) NOT NULL,
  `last_logout` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`, `last_login`, `last_logout`) VALUES
(26, 'nikhil', 'k', 'nikhil@gmail.com', 'nikhilkeshav', '9964716807', 'mysore', 'mysore', 'Feb,20,2020 02:26:18 PM', 'Feb,18,2020 05:53:29 PM'),
(27, 'rhys', 'tan', 'rhystan3@gmail.com', 'rhyspassword', '9964716807', 'mysore', 'mysore', 'Feb,20,2020 02:26:18 PM', 'Feb,18,2020 05:53:29 PM'),
(28, 'dom', 'teow', 'dominicteow@gmail.com', 'dompassword', '9964716807', 'mysore', 'mysore', 'Feb,20,2020 02:26:18 PM', 'Feb,18,2020 05:53:29 PM')
;

--
-- Triggers `user_info`
--
DELIMITER $$
CREATE TRIGGER `after_user_info_insert` AFTER INSERT ON `user_info` FOR EACH ROW BEGIN 
INSERT INTO user_info_backup VALUES(new.user_id,new.first_name,new.last_name,new.email,new.password,new.mobile,new.address1,new.address2);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_info_backup`
--

CREATE TABLE `user_info_backup` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `email_info`
--
ALTER TABLE `email_info`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders_info`
--
ALTER TABLE `orders_info`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_pro_id`),
  ADD KEY `order_products` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sup_info`
--
ALTER TABLE `sup_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_info_backup`
--
ALTER TABLE `user_info_backup`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `email_info`
--
ALTER TABLE `email_info`
  MODIFY `email_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_info`
--
ALTER TABLE `orders_info`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `order_pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `sup_info`
--
ALTER TABLE `sup_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_info_backup`
--
ALTER TABLE `user_info_backup`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_info`
--
ALTER TABLE `orders_info`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products` FOREIGN KEY (`order_id`) REFERENCES `orders_info` (`order_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
