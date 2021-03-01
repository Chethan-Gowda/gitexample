-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Feb 26, 2021 at 09:31 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` varchar(200) NOT NULL,
  `unit_price` varchar(200) NOT NULL,
  `offer_type` varchar(200) NOT NULL COMMENT '0 - No offer, 1 - Multiple Products 2. Multiple Product With Diff quantity 3. Combo',
  `offer_1` varchar(200) NOT NULL,
  `offer_1_price` varchar(200) NOT NULL,
  `offer_2` varchar(200) NOT NULL,
  `offer_2_price` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `unit_price`, `offer_type`, `offer_1`, `offer_1_price`, `offer_2`, `offer_2_price`) VALUES
(1, 'A', '50', '1', '3', '130', '', ''),
(2, 'B', '30', '1', '2', '45', '', ''),
(3, 'C', '20', '2', '3', '50', '2', '38'),
(4, 'D', '15', '3', 'A', '5', '', ''),
(5, 'E', '5', '0', '', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
