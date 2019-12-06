-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 04, 2019 at 06:29 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abay`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `user_id` int(16) NOT NULL AUTO_INCREMENT,
  `email` varchar(340) NOT NULL,
  `password` varchar(128) NOT NULL,
  `hash` varchar(80) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_id`, `email`, `password`, `hash`, `active`) VALUES
(1, 'jasongjames2012@hotmail.com', '$2y$10$kKhiVYVNKYKtK3j9DtDgWe5VHBr2K0Cy.uDKHW1VvvpEct8vWyk6W', '92c8c96e4c37100777c7190b76d28233', NULL),
(2, 'test@hotmail.com', '$2y$10$8Ws0Ic93YMWvyqJJEPtHU.ebMhFq5Qussk5qfup1mRpqylPZfMoxe', 'ad71c82b22f4f65b9398f76d8be4c615', NULL),
(3, 'test@gmail.com', '$2y$10$1KO0GCJq46b9LiB4PIhQSeGYcZEVZA7BX8I1WGQPzk5JPvWXAXj7i', '7f5d04d189dfb634e6a85bb9d9adf21e', NULL),
(4, 'test2@gmail.com', '$2y$10$UQ874JdDbbysWINQ8Dr2Qu90yPOgCaHYWQq5i9hWsVcQwamQf3eTe', 'df12ecd077efc8c23881028604dbb8cc', NULL),
(5, 'test4@gmail.com', '$2y$10$sta.rs6iVrgjfx/hnl5g9OWzKA096OrbqqHZInZIiYmklwSmjztfO', 'af21d0c97db2e27e13572cbf59eb343d', NULL),
(6, 'test5@gmail.com', '$2y$10$aEqnYILxoM3k2QxfzHT6xOoqtLbCsr4mys3a0pqGJ6DAiEyFSVwNa', 'f0adc8838f4bdedde4ec2cfad0515589', NULL),
(7, 'test6@gmail.com', '$2y$10$NyeXO/CNimB41aLZ2T9jbuiJ.TC6RwKwKkGdiD8BlLIuLuZlD1xve', '1587965fb4d4b5afe8428a4a024feb0d', NULL),
(8, 'test7@gmail.com', '$2y$10$ptvDVXmuHKcvxaogV88PlexdQhBt0jlD5E3lCORlxLS124hx11vE2', '5487315b1286f907165907aa8fc96619', NULL),
(9, 'jayz@gmail.com', '$2y$10$AzIZerd.qn7NNcJJUw94I..uuw7cvjGLSzztWSjbFHeq0ebsHnN/a', '4c5bde74a8f110656874902f07378009', NULL),
(10, 'testemail1@gmail.com', '$2y$10$DohUIqPhdAHkikdhLb.XSeiaRD9qEoJ/SViZ/fy1bnf5VDbUeMK/C', '8a146f1a3da4700cbf03cdc55e2daae6', NULL),
(11, 'test00@gmail.com', '$2y$10$5o0lnjNRLNcXMa8Trpbgr.RghhoP/Qtp4Oe27IfMb2rJozmC2lnXS', '1905aedab9bf2477edc068a355bba31a', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `address_id` int(16) NOT NULL AUTO_INCREMENT,
  `user_fk` int(16) NOT NULL,
  `address1` varchar(240) NOT NULL,
  `address2` varchar(240) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(2) NOT NULL,
  `postcode` varchar(12) NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `user_fk` (`user_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `user_fk`, `address1`, `address2`, `city`, `country`, `postcode`) VALUES
(1, 1, '136 Broadlands Avenue', '', 'Enfield', 'GB', 'EN3 5AG'),
(2, 2, '136 Broadlands Avenue', '', 'Enfield', 'GB', 'EN3 5AG'),
(3, 3, '1234 Main St', '', 'New York City', 'US', '2389323'),
(4, 4, '12 Westminister Ave', '', 'London', 'GB', 'N4 1NQ'),
(5, 5, '13 Bluestreet Road', '', 'London', 'GB', 'N13 5QX'),
(6, 6, '132 Address Street', '', 'Zurich', 'CH', '248992'),
(7, 7, '13 Wanstead Rd', '', 'Sussex', 'GB', 'SW3 1F2'),
(8, 8, '43 Test address ', '', 'London', 'GB', 'N23 5Xh'),
(9, 9, '12 NYC Road', '', 'NYC', 'US', '392030'),
(10, 10, '12 Main street', '', 'London', 'GB', 'NW1 5QH'),
(11, 11, '14 Bluestreet Road', '', 'London', 'GB', 'Nw5 5jk');

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

DROP TABLE IF EXISTS `bid`;
CREATE TABLE IF NOT EXISTS `bid` (
  `bid_id` int(16) NOT NULL AUTO_INCREMENT,
  `bid_amount` float NOT NULL,
  `bid_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bidder_fk` int(16) NOT NULL,
  `bid_on_fk` int(16) NOT NULL,
  PRIMARY KEY (`bid_id`),
  KEY `bidder_fk` (`bidder_fk`),
  KEY `bid_on_fk` (`bid_on_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`bid_id`, `bid_amount`, `bid_timestamp`, `bidder_fk`, `bid_on_fk`) VALUES
(1, 21, '2019-11-27 20:59:52', 1, 3),
(2, 10, '2019-11-29 19:54:13', 2, 1),
(3, 385, '2019-11-29 19:57:08', 2, 3),
(4, 400, '2019-11-29 19:59:25', 2, 3),
(5, 100000000, '2019-11-29 20:04:11', 2, 3),
(6, 100000000, '2019-11-29 20:42:30', 2, 3),
(7, 451, '2019-11-29 20:46:21', 2, 4),
(8, 1020, '2019-12-01 23:21:25', 1, 5),
(9, 600, '2019-12-02 12:45:09', 1, 11),
(10, 12, '2019-12-02 12:47:02', 1, 12),
(11, 12, '2019-12-02 12:47:29', 1, 13),
(12, 1000, '2019-12-02 12:55:22', 1, 14),
(13, 10000, '2019-12-02 12:55:44', 1, 15),
(14, 1000, '2019-12-02 13:03:18', 1, 16),
(15, 1005, '2019-12-02 13:04:56', 1, 16),
(16, 1006, '2019-12-02 13:06:23', 1, 16),
(17, 1050, '2019-12-02 13:07:08', 1, 16),
(18, 1100, '2019-12-02 13:07:52', 1, 16),
(19, 1200, '2019-12-02 13:09:06', 1, 16),
(20, 1300, '2019-12-02 13:09:44', 1, 16),
(21, 1310, '2019-12-02 13:10:39', 1, 16),
(22, 1320, '2019-12-02 13:12:40', 1, 16),
(23, 56, '2019-12-02 13:25:57', 1, 19),
(24, 12, '2019-12-02 13:26:36', 1, 20),
(25, 12, '2019-12-02 13:28:14', 1, 21),
(26, 1000, '2019-12-02 13:28:23', 1, 21),
(27, 34, '2019-12-02 13:31:14', 1, 22),
(28, 34, '2019-12-02 13:31:28', 1, 22),
(29, 65, '2019-12-02 13:31:33', 1, 22),
(30, 1100, '2019-12-02 21:15:54', 2, 24),
(31, 11, '2019-12-02 21:16:50', 2, 25),
(32, 12, '2019-12-02 21:17:19', 2, 25),
(33, 11, '2019-12-02 21:19:14', 2, 26),
(34, 12, '2019-12-02 21:19:25', 2, 26),
(35, 15, '2019-12-02 21:19:31', 2, 26),
(36, 620, '2019-12-04 17:59:49', 7, 27),
(37, 630, '2019-12-04 18:02:01', 8, 27),
(38, 310, '2019-12-04 18:02:47', 8, 28),
(39, 651, '2019-12-04 18:05:56', 9, 27),
(40, 60, '2019-12-04 18:06:07', 9, 29),
(41, 22, '2019-12-04 18:08:47', 10, 31),
(42, 660, '2019-12-04 18:08:56', 10, 27),
(43, 200, '2019-12-04 18:09:51', 10, 30),
(44, 670, '2019-12-04 18:11:59', 1, 27),
(45, 315, '2019-12-04 18:12:22', 1, 28),
(46, 65, '2019-12-04 18:12:40', 1, 29);

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

DROP TABLE IF EXISTS `buyer`;
CREATE TABLE IF NOT EXISTS `buyer` (
  `buyer_fk` int(16) NOT NULL,
  KEY `buyer_fk` (`buyer_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(16) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `size` varchar(30) NOT NULL,
  `location` varchar(2) NOT NULL,
  `state` varchar(12) NOT NULL,
  `category` set('Electronics','Gaming','Fashion','Entertainment','Books','Sports','Other') NOT NULL,
  `seller_fk` int(16) NOT NULL,
  `image_location` text,
  PRIMARY KEY (`item_id`),
  KEY `seller_fk` (`seller_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `description`, `size`, `location`, `state`, `category`, `seller_fk`, `image_location`) VALUES
(1, 'Custom PC i7 8700k 1080 Ti RGB', 'Its sick', 'Large', 'GB', 'Used', 'Electronics', 1, 'uploads/5ddee2696b86d9.76794550.jpg'),
(2, 'Hong Kong', 'The city', 'Massive', 'GB', 'New', 'Entertainment', 1, ''),
(3, 'Hong Kong', 'The city\'s best', 'Massive', 'GB', 'New', 'Entertainment', 1, 'uploads/5ddee3b219acd3.98489142.jpg'),
(4, 'Asus ROG 1440p monitor', 'Babe', 'Large', 'GB', 'New', 'Gaming', 2, 'uploads/5de183713485b1.36535886.jpg'),
(5, 'Custom PC i7 8700k 1080 Ti RGB', 'It\'s a beast', 'Large', 'GB', 'New', 'Gaming', 1, 'uploads/5de44ab39171b6.51231683.jpg'),
(6, 'Testing new', 'Test', 'Test', 'GB', 'Used', 'Other', 1, 'uploads/5de501a6f3bc97.26302182.jpg'),
(7, 'Testing new new', 'test', 'test', 'GB', 'New', 'Other', 1, 'uploads/5de5035345a030.81644813.jpg'),
(8, 'Testing new', 'test', 'test', 'GB', 'New', 'Other', 2, 'uploads/5de57f3dcfb054.89298141.jpg'),
(9, 'Apple iPhone 11 128 GB', 'Apple iPhone 11 128 GB', '300 x 800 mm', 'US', 'New', 'Electronics', 3, 'uploads/5de7f0a2f07e39.59415280.jpg'),
(10, 'Apple Smart Watch with GPS 32gb', 'Smart watch', 'Medium', 'GB', 'New', 'Electronics', 4, 'uploads/5de7f17a15e676.36357677.jpg'),
(11, 'DeLonghi Cafe Corso Bean to Cup Coffee Machine', 'Coffee Machine', 'Large', 'GB', 'New', 'Electronics', 5, 'uploads/5de7f241371216.77192780.jpg'),
(12, 'iPad Pro 10.5 inch Space Grey 64gb', 'iPad Pro 10.5 inch', '10.5 inch', 'CH', 'New', 'Electronics', 6, 'uploads/5de7f327dcf806.35355767.jpg'),
(13, 'Mens Superdry Vintage Logo Hoodie', 'Superdry hoodie', 'Medium', 'GB', 'New', 'Fashion', 7, 'uploads/5de7f3c20b0cf1.52689401.jpg'),
(14, 'Samsung EU43RU7400 Dynamic Crystal Colour HDR TV', 'Large HDR TV 43 inch', '43 inches', 'GB', 'New', 'Electronics', 8, 'uploads/5de7f48a9679b4.25632599.jpg'),
(15, 'Nintendo Switch Lite Turquoise', 'Nintendo Switch games console', 'Large', 'US', 'New', 'Electronics', 9, 'uploads/5de7f57806d8f5.04365299.jpg'),
(16, 'Samsung Galaxy Tab 10 inch', 'Galaxy Samsung tablet', '10 inch', 'GB', 'Used', 'Electronics', 10, 'uploads/5de7f6077ba796.95485751.jpg'),
(17, 'Microwave 800 W', 'Microwave', 'Large', 'GB', 'New', 'Other', 11, 'uploads/5de7f6cb1dc497.81576428.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

DROP TABLE IF EXISTS `listing`;
CREATE TABLE IF NOT EXISTS `listing` (
  `listing_id` int(16) NOT NULL AUTO_INCREMENT,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL,
  `number_of_bids` int(11) NOT NULL,
  `latest_bid_amount` int(11) NOT NULL,
  `number_watching` int(11) NOT NULL,
  `buy_now_price` double NOT NULL,
  `starting_price` double NOT NULL,
  `winning_bid` int(16) DEFAULT NULL,
  `item_id` int(16) NOT NULL,
  `is_active_listing` tinyint(1) NOT NULL,
  PRIMARY KEY (`listing_id`),
  KEY `winning_bid` (`winning_bid`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`listing_id`, `start_time`, `end_time`, `number_of_bids`, `latest_bid_amount`, `number_watching`, `buy_now_price`, `starting_price`, `winning_bid`, `item_id`, `is_active_listing`) VALUES
(1, '2019-11-27 20:54:01', '2019-12-02 21:15:54', 0, 10, 0, 2000, 1200, 2, 1, 0),
(2, '2019-11-27 20:58:30', '2019-12-02 21:15:54', 0, 0, 0, 10000000000, 100000000, NULL, 2, 1),
(3, '2019-11-27 20:59:30', '2019-12-02 21:15:54', 0, 100000001, 0, 10000000000, 100000000, 1, 3, 0),
(4, '2019-11-29 20:45:37', '2019-12-02 21:15:54', 0, 451, 0, 600, 450, 7, 4, 0),
(5, '2019-12-01 23:20:19', '2019-12-02 21:15:54', 0, 1020, 0, 1800, 1000, NULL, 5, 1),
(6, '2019-12-02 12:08:22', '2019-12-02 21:15:54', 0, 0, 0, 1000, 10, NULL, 1, 1),
(7, '2019-12-02 12:20:55', '2019-12-02 21:15:54', 0, 0, 0, 1000, 10, NULL, 6, 1),
(8, '2019-12-02 12:21:31', '2019-12-02 21:15:54', 0, 0, 0, 1000, 1000, NULL, 3, 0),
(9, '2019-12-02 12:26:26', '2019-12-02 21:15:54', 0, 0, 0, 1000, 10, NULL, 6, 1),
(10, '2019-12-02 12:28:03', '2019-12-02 21:15:54', 0, 0, 0, 350, 30, NULL, 7, 0),
(11, '2019-12-02 12:44:59', '2019-12-02 21:15:54', 0, 600, 0, 1000, 10, 9, 1, 0),
(12, '2019-12-02 12:46:59', '2019-12-02 21:15:54', 0, 12, 0, 1000, 10, NULL, 1, 0),
(13, '2019-12-02 12:47:26', '2019-12-02 21:15:54', 0, 12, 0, 1000, 10, 11, 1, 0),
(14, '2019-12-02 12:55:13', '2019-12-02 21:15:54', 0, 1000, 0, 1000, 10, 12, 1, 0),
(15, '2019-12-02 12:55:39', '2019-12-02 21:15:54', 0, 10000, 0, 1000, 10, 13, 1, 0),
(16, '2019-12-02 13:03:04', '2019-12-02 21:15:54', 0, 1320, 0, 1000, 10, 22, 1, 0),
(17, '2019-12-02 13:19:34', '2019-12-02 21:15:54', 0, 0, 0, 1000, 10, NULL, 1, 0),
(18, '2019-12-02 13:22:06', '2019-12-02 21:15:54', 0, 0, 0, 1000, 10, NULL, 1, 0),
(19, '2019-12-02 13:25:53', '2019-12-02 21:15:54', 0, 56, 0, 1000, 10, 23, 1, 0),
(20, '2019-12-02 13:26:27', '2019-12-02 21:15:54', 0, 12, 0, 1000, 10, 24, 1, 0),
(21, '2019-12-02 13:28:09', '2019-12-02 21:15:54', 0, 1000, 0, 1000, 10, 26, 1, 0),
(22, '2019-12-02 13:29:44', '2019-12-02 21:15:54', 0, 65, 0, 1000, 10, 29, 1, 0),
(23, '2019-12-02 13:41:01', '2019-12-02 21:15:54', 0, 0, 0, 1000, 1000, NULL, 4, 1),
(24, '2019-12-02 21:14:13', '2019-12-02 21:15:54', 0, 1100, 0, 1000, 10, 30, 4, 0),
(25, '2019-12-02 21:16:45', '2019-12-02 21:19:00', 0, 12, 0, 1000, 10, NULL, 8, 1),
(26, '2019-12-02 21:18:10', '2019-12-02 21:20:00', 0, 15, 0, 10000, 10, 35, 8, 0),
(27, '2019-12-04 17:45:06', '2019-12-19 12:51:00', 0, 670, 0, 1100, 600, NULL, 9, 1),
(28, '2019-12-04 17:48:42', '2020-01-01 17:50:00', 0, 315, 0, 600, 300, NULL, 10, 1),
(29, '2019-12-04 17:52:01', '2019-12-21 12:00:00', 0, 65, 0, 80, 50, NULL, 11, 1),
(30, '2019-12-04 17:55:51', '2019-12-18 19:46:00', 0, 200, 0, 299, 180, NULL, 12, 1),
(31, '2019-12-04 17:58:26', '2020-01-04 20:16:00', 0, 22, 0, 45, 20, NULL, 13, 1),
(32, '2019-12-04 18:01:46', '2019-12-18 04:36:00', 0, 0, 0, 500, 300, NULL, 14, 1),
(33, '2019-12-04 18:05:44', '2019-12-19 18:08:00', 0, 0, 0, 280, 150, NULL, 15, 1),
(34, '2019-12-04 18:08:07', '2020-01-05 13:00:00', 0, 0, 0, 260, 150, NULL, 16, 1),
(35, '2019-12-04 18:11:23', '2019-12-16 18:23:00', 0, 0, 0, 60, 30, NULL, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `seller_fk` int(16) NOT NULL,
  KEY `seller_fk` (`seller_fk`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`seller_fk`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_fk` int(16) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `date_of_birth` date NOT NULL,
  KEY `user_fk` (`user_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_fk`, `first_name`, `surname`, `username`, `date_of_birth`) VALUES
(1, 'Jason', 'James', 'jason', '1996-06-10'),
(2, 'Jason', 'James', 'tester', '2019-11-22'),
(3, 'Rick', 'Sanchez', 'ricksanchez', '2000-02-04'),
(4, 'Offset', 'Migo', 'migos', '1996-12-04'),
(5, 'Kanye', 'West', 'kanyewest', '2001-12-04'),
(6, 'Joe ', 'Bloggs', 'joebloggs', '2019-12-04'),
(7, 'John', 'Does', 'johnathon329', '1996-06-10'),
(8, 'Test', 'Name', 'drake', '2005-05-02'),
(9, 'Jay', 'Z', 'jayz', '2005-11-10'),
(10, 'Boris', 'Johnson', 'bojo', '1999-11-01'),
(11, 'Jeremy', 'Corbyn', 'jcorbyn', '2000-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

DROP TABLE IF EXISTS `watchlist`;
CREATE TABLE IF NOT EXISTS `watchlist` (
  `user_fk` int(16) NOT NULL,
  `listing_watched_fk` int(16) NOT NULL,
  KEY `user_fk` (`user_fk`),
  KEY `listing_watched_fk` (`listing_watched_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `watchlist`
--

INSERT INTO `watchlist` (`user_fk`, `listing_watched_fk`) VALUES
(1, 3),
(2, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_fk`) REFERENCES `account` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`bidder_fk`) REFERENCES `account` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`bid_on_fk`) REFERENCES `listing` (`listing_id`);

--
-- Constraints for table `buyer`
--
ALTER TABLE `buyer`
  ADD CONSTRAINT `buyer_ibfk_1` FOREIGN KEY (`buyer_fk`) REFERENCES `account` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `seller_ibfk_2` FOREIGN KEY (`seller_fk`) REFERENCES `account` (`user_id`);

--
-- Constraints for table `listing`
--
ALTER TABLE `listing`
  ADD CONSTRAINT `listing_ibfk_1` FOREIGN KEY (`winning_bid`) REFERENCES `bid` (`bid_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `listing_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON UPDATE CASCADE;

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `seller_ibfk_1` FOREIGN KEY (`seller_fk`) REFERENCES `account` (`user_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_fk`) REFERENCES `account` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD CONSTRAINT `watchlist_ibfk_1` FOREIGN KEY (`user_fk`) REFERENCES `account` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `watchlist_ibfk_2` FOREIGN KEY (`listing_watched_fk`) REFERENCES `listing` (`listing_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
