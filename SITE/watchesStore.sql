-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 17, 2013 at 06:41 PM
-- Server version: 5.5.34
-- PHP Version: 5.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `watchstore`
--
CREATE DATABASE IF NOT EXISTS `watchstore` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `watchstore`;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(45) NOT NULL DEFAULT '"N/A"',
  PRIMARY KEY (`brand_id`),
  UNIQUE KEY `brand_name_UNIQUE` (`brand_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
(1, 'Adidas'),
(2, 'Armani'),
(3, 'Burberry'),
(4, 'Bvlgari'),
(5, 'Casio'),
(6, 'Citizen'),
(7, 'Diesel'),
(8, 'Fossil'),
(9, 'Gucci'),
(10, 'Hugo'),
(11, 'Lacoste'),
(12, 'Rolex'),
(13, 'Swatch'),
(14, 'Tissot');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) NOT NULL DEFAULT '"N/A"',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name_UNIQUE` (`category_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(3, 'Casual'),
(2, 'Fashion'),
(1, 'Luxury'),
(4, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `birthday`, `email`, `country`, `city`, `address`) VALUES
(1, 'Stephanie', 'Laird', '1954-04-02', 'Parsimonious@gmail.com', 'Guernsey', 'San Marcos', '15 Jefferies Way'),
(2, 'Adrian', 'Shoulders', '1962-01-06', 'Royal@gmail.com', 'American Samoa', 'Guatemala City', '40 Vicarage Gardens'),
(3, 'Taylor', 'Thomanson', '1968-07-01', 'Troubled@gmail.com', 'Mongolia', 'Citrus Heights', '19 Parklands'),
(4, 'Francesca ', 'Valenzuela', '1969-01-17', 'Encouraging@gmail.com', 'Antigua and Barbuda', 'Grand Rapids', '6A Redwood Avenue'),
(5, 'Velia', 'Rush', '1973-10-05', 'Earsplitting@gmail.com', 'Canada', 'Bakersfield', '3 Trecerus, Padstow'),
(6, 'Johnnie', 'Eddy', '1980-06-10', 'Inquisitive@gmail.com', 'Turkmenistan', 'Schaumburg', '1 Jex Way'),
(7, 'Neisha', 'Vanegas', '1981-06-03', 'Lonely@gmail.com', 'Mauritania', 'Eau Claire', '1 Front Street'),
(8, 'Jann', 'Goodloe', '1983-04-03', 'Beneficial@gmail.com', 'Uganda', 'Tallyrand', '44 Colman Court'),
(9, 'Cuc', 'Mood', '1986-09-11', 'Reminiscent@gmail.com', 'Martinique', 'Fairfax Station', '111-113 Bayswater Road'),
(10, 'Jeramy', 'Ward', '1990-04-05', 'Inquisitive@gmail.com', 'Venezuela', 'Taunton', '13 Cumberland Road');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_amount` int(11) NOT NULL,
  `order_price` float NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id_idx` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `order_amount`, `order_price`) VALUES
(1, 8, '2013-04-20 15:23:58', 3, 276.5),
(2, 3, '2013-06-06 16:26:57', 2, 411.03),
(3, 2, '2013-06-16 12:46:50', 1, 30120),
(4, 3, '2013-03-21 15:07:57', 1, 177),
(5, 4, '2013-03-29 09:12:45', 1, 400.57),
(6, 1, '2013-05-18 13:38:10', 2, 180),
(7, 5, '2013-04-02 10:44:31', 4, 975.75),
(8, 7, '2013-03-07 13:23:21', 2, 850.24),
(9, 9, '2013-05-24 11:41:04', 1, 420.75),
(10, 2, '2013-06-14 17:21:23', 2, 84.33),
(11, 8, '2013-06-15 16:26:52', 1, 53.77),
(12, 1, '2013-02-18 14:05:36', 1, 76.96);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `watch_id` int(11) NOT NULL,
  PRIMARY KEY (`order_detail_id`),
  KEY `watch_id_idx` (`watch_id`),
  KEY `order_id_idx` (`order_id`,`watch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `watch_id`) VALUES
(1, 1, 1),
(2, 1, 12),
(3, 1, 37),
(4, 2, 15),
(5, 2, 78),
(6, 3, 67),
(7, 4, 58),
(8, 5, 84),
(9, 6, 32),
(10, 6, 33),
(11, 7, 16),
(12, 7, 32),
(13, 7, 34),
(14, 7, 52),
(15, 8, 77),
(16, 8, 80),
(17, 9, 13),
(18, 10, 5),
(19, 10, 6),
(20, 11, 66),
(21, 12, 43);

-- --------------------------------------------------------

--
-- Table structure for table `watches`
--

CREATE TABLE IF NOT EXISTS `watches` (
  `watch_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `gender` enum('F','M','UNISEX') NOT NULL,
  `amount` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`watch_id`),
  KEY `category_id_idx` (`category_id`),
  KEY `brand_id_idx` (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
-- Dumping data for table `watches`
--

INSERT INTO `watches` (`watch_id`, `category_id`, `brand_id`, `name`, `gender`, `amount`, `price`) VALUES
(1, 4, 1, 'Candy Digital', 'UNISEX', 5, 54),
(2, 4, 1, 'Candy Sport', 'UNISEX', 5, 48),
(3, 2, 1, 'Cambridge Dial', 'UNISEX', 5, 87.57),
(4, 2, 1, 'Cambridge Chronograph', 'M', 3, 105.09),
(5, 3, 1, 'White Cambridge', 'F', 6, 50.95),
(6, 3, 1, 'Seoul Digital Resin', 'M', 4, 33.38),
(7, 2, 2, 'Ceramica Chronograph', 'M', 2, 182.45),
(8, 2, 2, 'Sportivo Chronograph', 'M', 3, 214.5),
(9, 1, 2, 'Mother of pearl', 'F', 4, 192.5),
(10, 1, 2, 'Sportivo Chronograph', 'F', 2, 258.17),
(11, 3, 2, 'Ceramic Chronograph', 'M', 4, 378.96),
(12, 3, 2, 'Black Code', 'M', 7, 156),
(13, 1, 3, 'Pioneer Gold Dial', 'F', 3, 420.75),
(14, 1, 3, 'Silver Dial Nova', 'F', 2, 334.9),
(15, 2, 3, 'Black Check Pattern', 'F', 1, 335),
(16, 2, 3, 'Grey Dial Black Polyvinl', 'M', 3, 335.75),
(17, 3, 3, 'Military Black Dial', 'M', 2, 329.99),
(18, 3, 3, 'White Dial Tan Leather', 'F', 3, 420.75),
(19, 1, 4, 'Rettangolo', 'F', 1, 1425),
(20, 1, 4, 'Mother of Pearl', 'F', 3, 3196),
(21, 4, 4, 'Diagono', 'M', 2, 3150),
(22, 4, 4, 'Diagono Automatic', 'M', 2, 2999),
(23, 3, 4, 'Bvlgari Black', 'UNISEX', 2, 3570),
(24, 3, 4, '18kt Yellow Gold', 'F', 1, 3135),
(25, 4, 5, 'G-Shock Military', 'M', 3, 150),
(26, 4, 5, 'Baby G', 'F', 2, 205),
(27, 1, 5, 'LA670WGA', 'F', 3, 500),
(28, 1, 5, 'G-Shock Mudman', 'M', 2, 375),
(29, 3, 5, 'A159WGEA', 'M', 3, 268.99),
(30, 3, 5, 'Vintage Genuine', 'UNISEX', 2, 569.99),
(31, 2, 6, 'Chronograph', 'M', 3, 112.5),
(32, 2, 6, 'WR100', 'M', 2, 100),
(33, 3, 6, 'Black Dial', 'M', 4, 80),
(34, 3, 6, 'Eco-Drive Silver', 'M', 3, 108),
(35, 4, 6, 'Eco-Drive Military', 'UNISEX', 4, 87.5),
(36, 4, 6, 'Eco-Drive Black', 'M', 2, 87.5),
(37, 2, 7, 'DZ15 Black Dial', 'M', 3, 75),
(38, 2, 7, 'Analog Green Dial', 'UNISEX', 3, 102.67),
(39, 3, 7, 'Rectangular Stainless', 'F', 2, 105),
(40, 3, 7, 'Large Rectangular', 'M', 3, 103.88),
(41, 4, 7, 'Domination Beige', 'UNISEX', 4, 64.17),
(42, 4, 7, 'Digital Dial Red', 'UNISEX', 3, 70.86),
(43, 1, 8, 'Dean Chronograph', 'M', 4, 76.96),
(44, 1, 8, 'Nate Chronograph', 'M', 3, 135),
(45, 2, 8, 'Retro Traveler', 'M', 2, 63.37),
(46, 2, 8, 'Georgia White', 'F', 3, 48.32),
(47, 3, 8, 'Stella Mother of Pearl', 'F', 2, 53.9),
(48, 3, 8, 'Mini Georgia Ch', 'F', 3, 57.86),
(49, 1, 9, 'G-Coupe Quartz', 'M', 2, 577.1),
(50, 1, 9, 'Gucci Coupe', 'F', 2, 597),
(51, 2, 9, 'Brown Dial Stain', 'F', 1, 465),
(52, 2, 9, 'Black Dial Ya', 'F', 2, 432),
(53, 3, 9, '114 I-Gucci', 'M', 3, 697.5),
(54, 3, 9, 'Grammy Edition', 'UNISEX', 4, 589),
(55, 1, 10, 'Square Chronograph', 'M', 2, 177),
(56, 1, 10, 'Chronograph Black', 'M', 1, 177),
(57, 2, 10, 'Silver Dial ', 'UNISEX', 3, 141),
(58, 2, 10, 'Silver Dial Rose', 'UNISEX', 2, 177),
(59, 3, 10, 'Square Digital', 'F', 2, 90),
(60, 3, 10, 'Mother of Pearl', 'F', 1, 194.7),
(61, 4, 11, 'Tomero Green', 'F', 3, 71.25),
(62, 4, 11, 'Borneo Red', 'M', 2, 91.52),
(63, 4, 11, 'Borneo Black', 'M', 2, 91.52),
(64, 4, 11, 'GOA Green', 'UNISEX', 3, 66.26),
(65, 3, 11, 'GOA Purple', 'UNISEX', 2, 56.91),
(66, 3, 11, 'GOA Black Dial', 'UNISEX', 3, 53.77),
(67, 1, 12, 'Submariner', 'M', 2, 30120),
(68, 1, 12, 'PearlMaster', 'M', 3, 23215),
(69, 1, 12, 'Air King', 'M', 4, 4393),
(70, 1, 12, 'Oyster Perpetual', 'F', 1, 6481),
(71, 1, 12, 'Yachtmaster', 'M', 2, 8159),
(72, 1, 12, 'Day-Date', 'F', 5, 22830),
(73, 4, 13, 'Touch Blue', 'UNISEX', 2, 97.41),
(74, 4, 13, 'Touch Black', 'UNISEX', 3, 97.41),
(75, 3, 13, 'Yellow Drops', 'F', 2, 59.98),
(76, 3, 13, 'Irony Brown', 'M', 3, 76.5),
(77, 3, 13, 'Irony Botancius', 'F', 2, 75.14),
(78, 3, 13, 'Feature Steel', 'M', 1, 76.03),
(79, 2, 14, 'T-Sport Seastar', 'M', 2, 543.95),
(80, 2, 14, 'Seastar 1000', 'M', 3, 775.1),
(81, 2, 14, 'Seastar Blue Dial', 'F', 2, 628.9),
(82, 3, 14, 'T-Touch Classic', 'M', 3, 378.13),
(83, 3, 14, 'T-Touch Black', 'M', 2, 377.13),
(84, 3, 14, 'T-Touch Silver', 'M', 1, 400.57);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `watch_id` FOREIGN KEY (`watch_id`) REFERENCES `watches` (`watch_id`) ON UPDATE CASCADE;

--
-- Constraints for table `watches`
--
ALTER TABLE `watches`
  ADD CONSTRAINT `brand_id` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE;
