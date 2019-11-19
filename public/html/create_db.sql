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
DROP DATABASE Abay;
CREATE DATABASE IF NOT EXISTS `abay` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
GRANT SELECT, UPDATE, INSERT, DELETE
    ON Abay.*
    TO 'root'@'localhost'
    IDENTIFIED BY '';
USE `abay`;

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
                                         `active` BOOLEAN,
                                         PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
                                      `description` text NOT NULL,
                                      `size` varchar(30) NOT NULL,
                                      `location` int(16) NOT NULL,
                                      `category` varchar(40) NOT NULL,
                                      PRIMARY KEY (`item_id`),
                                      KEY `location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
                                         `winning_bid` int(16) NOT NULL,
                                         `item_id` int(16) NOT NULL,
                                         PRIMARY KEY (`listing_id`),
                                         KEY `winning_bid` (`winning_bid`),
                                         KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
                                        `seller_fk` int(16) NOT NULL,
                                        KEY `seller_fk` (`seller_fk`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
    ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`location`) REFERENCES `addresses` (`address_id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
