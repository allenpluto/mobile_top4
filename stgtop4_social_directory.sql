-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2014 at 04:33 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stgtop4_social_directory`
--

-- --------------------------------------------------------

--
-- Table structure for table `top4_image_object`
--

DROP TABLE IF EXISTS `top4_image_object`;
CREATE TABLE IF NOT EXISTS `top4_image_object` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Universal ID',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `alternate_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Text - An alias for the item.',
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Text - A short description of the item.',
  `image_id` int(11) NOT NULL DEFAULT '-1',
  `enter_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `caption` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Caption. Image title attribute.',
  `exifData` text COLLATE utf8_unicode_ci,
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0',
  `file_path` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `top4_person`
--

DROP TABLE IF EXISTS `top4_person`;
CREATE TABLE IF NOT EXISTS `top4_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `friendly_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `alternate_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `image_id` int(11) NOT NULL DEFAULT '-1',
  `enter_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `address_id` int(11) NOT NULL DEFAULT '-1',
  `birth_date` date DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `family_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Given name, first name',
  `additional_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'An additional name for a Person, can be used for a middle name.',
  `given_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `gender` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unspecified' COMMENT 'Male;Female',
  PRIMARY KEY (`id`),
  KEY `address` (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `top4_person`
--

INSERT INTO `top4_person` (`id`, `friendly_url`, `name`, `alternate_name`, `description`, `image_id`, `enter_time`, `update_time`, `address_id`, `birth_date`, `email`, `family_name`, `additional_name`, `given_name`, `gender`) VALUES
(1, 'allen-woo-1', 'Allen Woo 1', 'Allen Alt', 'some test', -1, '2014-12-09 23:04:32', '2014-12-10 01:16:02', -1, '1980-12-01', 'allen@twmg.com.au', 'Wu', '', 'Daixi', 'Male'),
(2, 'allen-woo-2', 'Allen Woo 2', 'Allen Alt', 'some test', -1, '2014-12-09 06:03:01', '2014-12-10 01:16:02', -1, '1980-12-02', 'allen@twmg.com.au', 'Wu', '', 'Daixi', 'Male'),
(3, 'allen-woo-3', 'Allen Woo 3', 'Allen Alt', 'some test', -1, '2014-12-09 23:04:32', '2014-12-10 01:16:02', -1, '1980-12-03', 'allen@twmg.com.au', 'Wu', '', 'Daixi', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `top4_thing`
--

DROP TABLE IF EXISTS `top4_thing`;
CREATE TABLE IF NOT EXISTS `top4_thing` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Universal ID',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `alternate_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Text - An alias for the item.',
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Text - A short description of the item.',
  `image_id` int(11) NOT NULL DEFAULT '-1' COMMENT 'ImageObject - An image of the item',
  `enter_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
