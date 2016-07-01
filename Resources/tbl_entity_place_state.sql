-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2016 at 10:12 AM
-- Server version: 5.6.30
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
-- Table structure for table `tbl_entity_place_state`
--

DROP TABLE IF EXISTS `tbl_entity_place_state`;
CREATE TABLE IF NOT EXISTS `tbl_entity_place_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `friendly_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `alternate_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `image_id` int(11) NOT NULL DEFAULT '0',
  `enter_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `place_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `formatted_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `geometry_location_lat` decimal(11,8) NOT NULL DEFAULT '0.00000000',
  `geometry_location_lng` decimal(11,8) NOT NULL DEFAULT '0.00000000',
  `geometry_viewport_northeast_lat` decimal(11,8) NOT NULL DEFAULT '0.00000000',
  `geometry_viewport_northeast_lng` decimal(11,8) NOT NULL DEFAULT '0.00000000',
  `geometry_viewport_southwest_lat` decimal(11,8) NOT NULL DEFAULT '0.00000000',
  `geometry_viewport_southwest_lng` decimal(11,8) NOT NULL DEFAULT '0.00000000',
  `geometry_bounds_northeast_lat` decimal(11,8) NOT NULL DEFAULT '0.00000000',
  `geometry_bounds_northeast_lng` decimal(11,8) NOT NULL DEFAULT '0.00000000',
  `geometry_bounds_southwest_lat` decimal(11,8) NOT NULL DEFAULT '0.00000000',
  `geometry_bounds_southwest_lng` decimal(11,8) NOT NULL DEFAULT '0.00000000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `place_id` (`place_id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_entity_place_state`
--

INSERT INTO `tbl_entity_place_state` (`id`, `friendly_url`, `name`, `alternate_name`, `description`, `image_id`, `enter_time`, `update_time`, `place_id`, `formatted_address`, `geometry_location_lat`, `geometry_location_lng`, `geometry_viewport_northeast_lat`, `geometry_viewport_northeast_lng`, `geometry_viewport_southwest_lat`, `geometry_viewport_southwest_lng`, `geometry_bounds_northeast_lat`, `geometry_bounds_northeast_lng`, `geometry_bounds_southwest_lat`, `geometry_bounds_southwest_lng`) VALUES
(11, '', 'New South Wales', 'NSW', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:04:39', 'ChIJDUte93TLDWsRLZ_EIhGvgBc', 'New South Wales, Australia', '-33.86417400', '151.20528680', '-28.15619200', '153.63878160', '-37.50503180', '140.99921230', '-28.15619200', '153.63878160', '-37.50503180', '140.99921230'),
(12, '', 'Victoria', 'VIC', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:04:39', 'ChIJT5UYfksx1GoRNJWCvuL8Tlo', 'Victoria, Australia', '-36.60289060', '145.46948280', '-33.98105070', '149.97648820', '-39.22473060', '140.96247730', '-33.98105070', '149.97648820', '-39.22473060', '140.96247730'),
(13, '', 'Queensland', 'QLD', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:04:39', 'ChIJ_dxieiTf1GsRmb4SdiLQ8vU', 'Queensland, Australia', '-20.91757380', '142.70279560', '-9.93344000', '153.55180960', '-29.17858760', '137.99457480', '-9.92973000', '153.55291990', '-29.17858760', '137.99457480'),
(14, '', 'Western Australia', 'WA', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:04:39', 'ChIJ0YTziS4qOSoRmaMAMt9KDm4', 'Western Australia, Australia', '-27.67281680', '121.62830980', '-13.68949010', '129.00259790', '-35.18835000', '112.92132640', '-13.68949010', '129.00259790', '-35.19399440', '112.92121910'),
(15, '', 'South Australia', 'SA', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:04:39', 'ChIJ88foW55Yp2oR2ND6PZl5fts', 'South Australia, Australia', '-32.02880100', '135.00169830', '-25.99639200', '141.00288040', '-38.06121000', '129.00051620', '-25.99639200', '141.00288040', '-38.06121000', '129.00051620'),
(16, '', 'Tasmania', 'TAS', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:04:39', 'ChIJz_o0fifteqoRZEBAKd2ljyo', 'Tasmania, Australia', '-41.36504190', '146.62849050', '-39.43803550', '148.49876010', '-43.74298000', '143.81834610', '-39.43803550', '148.49876010', '-43.74298000', '143.81828520'),
(17, '', 'Australian Capital Territory', 'ACT', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:04:39', 'ChIJSxCboN9MFmsRA3huXDhEWOc', 'Australian Capital Territory, Australia', '-35.47346790', '149.01236790', '-35.12451280', '149.39928480', '-35.92053070', '148.76409710', '-35.12451280', '149.39928480', '-35.92053070', '148.76409710'),
(18, '', 'Northern Territory', 'NT', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:04:39', 'ChIJDxnz5sJyUSsRdScAAAAAAAA', 'Northern Territory, Australia', '-19.49141080', '132.55096030', '-10.90569630', '137.99900920', '-26.01686980', '129.00042440', '-10.90551960', '137.99900920', '-26.01686980', '129.00042440');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
