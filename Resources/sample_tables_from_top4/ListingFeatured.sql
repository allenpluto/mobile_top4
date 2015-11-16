-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2015 at 11:03 AM
-- Server version: 5.5.46-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stgtop4_domain1`
--

-- --------------------------------------------------------

--
-- Table structure for table `ListingFeatured`
--

DROP TABLE IF EXISTS `ListingFeatured`;
CREATE TABLE IF NOT EXISTS `ListingFeatured` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `listing_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Listing featured period' AUTO_INCREMENT=24 ;

--
-- Dumping data for table `ListingFeatured`
--

INSERT INTO `ListingFeatured` (`id`, `date_start`, `date_end`, `listing_id`) VALUES
(16, '2015-08-05 00:00:00', '2015-12-05 00:00:00', 12026),
(17, '2015-08-05 00:00:00', '2015-12-05 00:00:00', 10596),
(18, '2015-08-05 00:00:00', '2015-12-05 00:00:00', 11760),
(19, '2015-08-05 00:00:00', '2015-12-05 00:00:00', 65031),
(20, '2015-08-05 00:00:00', '2015-12-05 00:00:00', 65083),
(21, '2015-08-05 00:00:00', '2015-12-05 00:00:00', 65100),
(22, '2015-08-05 00:00:00', '2015-12-05 00:00:00', 65217),
(23, '2015-08-05 00:00:00', '2015-12-05 00:00:00', 65667);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
