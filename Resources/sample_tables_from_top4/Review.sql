-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2016 at 06:21 PM
-- Server version: 5.5.48-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `top4_domain1`
--

-- --------------------------------------------------------

--
-- Table structure for table `Review`
--

DROP TABLE IF EXISTS `Review`;
CREATE TABLE IF NOT EXISTS `Review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `member_id` int(11) NOT NULL,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `review_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `review` text COLLATE utf8_unicode_ci,
  `reviewer_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reviewer_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reviewer_location` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `rating` tinyint(2) NOT NULL DEFAULT '0',
  `approved` int(1) NOT NULL DEFAULT '0',
  `response` text COLLATE utf8_unicode_ci NOT NULL,
  `responseapproved` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `listing_id` (`item_id`),
  KEY `approved` (`approved`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

--
-- Dumping data for table `Review`
--

INSERT INTO `Review` (`id`, `item_type`, `item_id`, `member_id`, `added`, `ip`, `review_title`, `review`, `reviewer_name`, `reviewer_email`, `reviewer_location`, `rating`, `approved`, `response`, `responseapproved`) VALUES
(15, 'listing', 10961, 77, '2013-10-09 21:26:32', '110.139.14.64', 'Good Job', '', 'John Doe', 'johndoe.sydney@gmail.com', '', 3, 1, '', 0),
(14, 'listing', 10953, 90, '2013-10-09 21:21:29', '110.139.14.64', 'Good Job', '', 'BND Owner', 'bnd@top4.com.au', '', 3, 1, '', 0),
(11, 'listing', 10953, 146, '2013-10-09 11:37:22', '120.150.255.175', 'Good', '', 'Allen Woo', 'allen@thewebsitemarketinggroup.com.au', '', 5, 1, '', 0),
(24, 'listing', 10953, 77, '2014-04-28 13:58:45', '120.150.255.175', 'Excellent', '', 'John Doyles', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 4, 1, '', 0),
(18, 'listing', 10596, 146, '2014-04-17 14:57:07', '120.150.255.175', 'Good', '', 'Allen Woo', 'allen@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 3, 1, '', 0),
(19, 'listing', 10596, 146, '2014-04-17 16:09:21', '120.150.255.175', 'Perfect', '', 'Allen Woo', 'allen@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 5, 1, '', 0),
(20, 'listing', 10953, 146, '2014-04-23 16:07:04', '120.150.255.175', 'Perfect', '', 'Allen Woo', 'allen@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 5, 1, '', 0),
(21, 'listing', 10953, 146, '2014-04-23 16:29:48', '120.150.255.175', 'Perfect', '', 'Allen Woo', 'allen@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 5, 1, '', 0),
(22, 'listing', 10953, 146, '2014-04-23 16:35:24', '120.150.255.175', 'Good', '', 'Allen Woo', 'allen@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 3, 1, '', 0),
(23, 'listing', 10953, 146, '2014-04-23 16:41:09', '120.150.255.175', 'Perfect', '', 'Allen Woo', 'allen@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 5, 1, '', 0),
(25, 'listing', 10829, 77, '2014-04-28 14:01:09', '120.150.255.175', 'Perfect', '', 'John Doyles', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 5, 1, '', 0),
(26, 'listing', 10596, 77, '2014-04-28 14:10:35', '120.150.255.175', 'Perfect', '', 'John Doyles', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 5, 1, '', 0),
(27, 'listing', 10953, 77, '2014-04-30 14:59:28', '120.150.255.175', 'Perfect', '', 'John Doyles', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 5, 1, '', 0),
(28, 'listing', 10596, 146, '2014-05-02 11:56:33', '120.150.255.175', 'Perfect', '', 'Allen Woo', 'allen@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 5, 1, '', 0),
(29, 'listing', 10596, 146, '2014-05-02 12:02:05', '120.150.255.175', 'Perfect', '', 'Allen Woo', 'allen@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 5, 1, '', 0),
(30, 'listing', 10596, 146, '2014-05-02 12:08:04', '120.150.255.175', 'Perfect', '', 'Allen Woo', 'allen@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 5, 1, '', 0),
(31, 'listing', 10596, 146, '2014-05-02 12:25:03', '120.150.255.175', 'Perfect', '', 'Allen Woo', 'allen@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 5, 1, '', 0),
(32, 'listing', 10596, 146, '2014-05-05 16:35:53', '120.150.255.175', 'Perfect', '', 'Allen Woo', 'allen@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 5, 1, '', 0),
(33, 'listing', 11473, 190, '2014-09-12 15:23:35', '120.150.255.175', 'Perfect', '', 'Isuru Chamikara', 'isuru@thewebsitemarketinggroup.com.au', '', 5, 1, '', 0),
(34, 'listing', 11475, 190, '2014-09-12 15:55:23', '120.150.255.175', 'Perfect', '', 'Isuru Chamikara', 'isuru@thewebsitemarketinggroup.com.au', '', 5, 1, '', 0),
(35, 'listing', 11483, 77, '2014-10-21 12:23:05', '120.150.255.175', 'Perfect', '', 'John Doyle', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 5, 1, '', 0),
(36, 'listing', 11739, 77, '2014-11-12 14:31:17', '120.150.255.175', 'Perfect', '', 'John Doyle', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 5, 1, '', 0),
(37, 'listing', 11503, 77, '2014-12-01 10:27:08', '120.150.255.175', 'Good', '', 'John Doyle', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 3, 1, '', 0),
(38, 'listing', 11587, 77, '2014-12-01 14:12:49', '120.150.255.175', 'Good', '', 'John Doyle', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 3, 1, '', 0),
(39, 'listing', 11761, 118, '2014-12-05 12:16:13', '120.150.255.175', 'Perfect', '', 'Shailendra Shrestha', 'shailen@thewebsitemarketinggroup.com.au', '', 5, 1, '', 0),
(40, 'listing', 11761, 169, '2014-12-05 12:22:00', '120.150.255.175', 'Perfect', '', 'Shailen Sresta', 'shailen17@gmail.com', '', 5, 1, '', 0),
(41, 'listing', 11454, 169, '2014-12-05 12:24:50', '120.150.255.175', 'Poor Performance', '', 'Shailen Sresta', 'shailen17@gmail.com', '', 1, 1, '', 0),
(42, 'listing', 11762, 208, '2015-01-07 15:30:49', '120.150.255.175', 'Perfect', '', 'Marc LARROUY', 'marclarrouy@yahoo.fr', 'Sydney', 5, 1, '', 0),
(43, 'listing', 11762, 209, '2015-01-07 15:38:41', '120.150.255.175', 'Excellent', '', 'QUENTIN LIBREAU', 'quentinlibreau@gmail.com', 'Sydney', 4, 1, '', 0),
(44, 'listing', 11763, 209, '2015-01-07 15:39:01', '120.150.255.175', 'Perfect', '', 'QUENTIN LIBREAU', 'quentinlibreau@gmail.com', 'Sydney', 5, 1, '', 0),
(45, 'listing', 10953, 77, '2015-04-21 16:02:38', '120.150.255.175', 'Poor Performance', '', 'John Doyle', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 1, 1, '', 0),
(46, 'listing', 11789, 216, '2015-04-23 11:15:03', '120.150.255.175', 'Excellent', '', 'Amber Tiles Australia', 'ambertiles.twmg@gmail.com', '', 4, 1, '', 0),
(47, 'listing', 11787, 77, '2015-04-28 08:52:46', '203.215.118.156', 'Good', '', 'John Doyle', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 3, 1, '', 0),
(52, 'listing', 11760, 146, '2015-07-24 17:09:03', '120.150.255.175', 'Perfect', '', 'Allen Woo', 'allen@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 5, 1, '', 0),
(49, 'listing', 11283, 221, '2015-05-27 16:02:25', '120.150.255.175', 'Good', '', 'Kartik K', 'kartik@thewebsitemarketinggroup.com.au', '', 3, 1, '', 0),
(50, 'listing', 11761, 77, '2015-06-02 15:05:19', '120.150.255.175', 'Good', '', 'John Doyle', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 3, 1, '', 0),
(51, 'listing', 64374, 77, '2015-06-25 11:27:29', '120.150.255.175', 'Poor Performance', '', 'John Doyle', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 1, 1, '', 0),
(53, 'listing', 64877, 77, '2015-07-30 12:28:26', '120.150.255.175', 'Good', '', 'John Doyle', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 3, 1, '', 0),
(54, 'listing', 10596, 77, '2015-09-10 16:39:31', '120.150.255.175', 'Good', '', 'John Doyle', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 3, 1, '', 0),
(55, 'listing', 12026, 77, '2015-09-17 16:44:41', '120.150.255.175', 'Excellent', '', 'John Doyle', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 4, 1, '', 0),
(56, 'listing', 88748, 249, '2015-10-22 16:34:49', '120.150.255.175', 'Excellent', '', 'Heath  Wilson  ', 'reggie@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 4, 1, '', 0),
(57, 'listing', 10596, 249, '2015-10-30 14:24:44', '120.150.255.175', 'Perfect', '', 'Heath  Wilson  ', 'reggie@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 5, 1, '', 0),
(58, 'listing', 10596, 184, '2015-11-12 16:18:21', '120.150.255.175', 'Perfect', '', 'Annie Smith', 'yanli@thewebsitemarketinggroup.com.au', '', 5, 1, '', 0),
(59, 'listing', 12026, 77, '2015-12-08 14:30:13', '120.150.255.175', 'Perfect', '', 'John Doyle', 'johndoe.sydney@gmail.com', 'BAULKHAM HILLS', 5, 1, '', 0),
(60, 'listing', 10596, 146, '2016-01-12 17:02:08', '120.150.255.175', 'Perfect', '', 'Allen Woo', 'allen@thewebsitemarketinggroup.com.au', 'Baulkham Hills', 5, 1, '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
