-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 27, 2016 at 06:49 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

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
-- Table structure for table `tbl_entity_place_area`
--

DROP TABLE IF EXISTS `tbl_entity_place_area`;
CREATE TABLE IF NOT EXISTS `tbl_entity_place_area` (
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
  `region_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `place_id` (`place_id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=251 ;

--
-- Dumping data for table `tbl_entity_place_area`
--

INSERT INTO `tbl_entity_place_area` (`id`, `friendly_url`, `name`, `alternate_name`, `description`, `image_id`, `enter_time`, `update_time`, `place_id`, `formatted_address`, `geometry_location_lat`, `geometry_location_lng`, `geometry_viewport_northeast_lat`, `geometry_viewport_northeast_lng`, `geometry_viewport_southwest_lat`, `geometry_viewport_southwest_lng`, `geometry_bounds_northeast_lat`, `geometry_bounds_northeast_lng`, `geometry_bounds_southwest_lat`, `geometry_bounds_southwest_lng`, `region_id`) VALUES
(201, '', 'Sydney CBD', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJKaeYMj-uEmsRAgZ4clX6UO8', 'Sydney CBD, Sydney NSW, Australia', '-33.87084640', '151.20733000', '-33.85351460', '151.22295490', '-33.88541620', '151.18606030', '-33.85351460', '151.22295490', '-33.88541620', '151.18606030', 101),
(202, '', 'Inner West', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJZeeFT7C6EmsRGhSuYufXqNA', 'Inner West, Sydney NSW, Australia', '-33.85848270', '151.12866860', '-33.82038290', '151.20698030', '-33.93405540', '151.04627200', '-33.82038290', '151.20698030', '-33.93405540', '151.04627200', 101),
(203, '', 'Eastern Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJiZjXtY2xEmsRWlivIxkJYaA', 'Eastern Suburbs, NSW, Australia', '-33.95084920', '151.21024420', '-33.83298200', '151.28745690', '-34.00156780', '151.15988920', '-33.83298200', '151.28745690', '-34.00156780', '151.15988920', 101),
(204, '', 'St George', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJ1-pE06O5EmsRlTHJW4q3R_M', 'St George, Sydney NSW, Australia', '-33.95475040', '151.10536910', '-33.92553240', '151.16671770', '-34.00594420', '151.03207010', '-33.92553240', '151.16671770', '-34.00594420', '151.03207010', 101),
(205, '', 'Northern Beaches', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJaY3_V_5UDWsRqlqafFwilIM', 'Northern Beaches, Sydney NSW, Australia', '-33.68919760', '151.26853820', '-33.57823880', '151.34263610', '-33.82329040', '151.22504650', '-33.57823880', '151.34263610', '-33.82329040', '151.22504650', 101),
(206, '', 'North Shore', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJ9VWX9OlWDWsRheMBDAvY010', 'North Shore, NSW, Australia', '-33.67147600', '151.19858790', '-33.47234160', '151.31086750', '-33.85526570', '151.09732710', '-33.47234160', '151.31086750', '-33.85526570', '151.09732710', 101),
(207, '', 'North West & Ryde', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJu_mcEo5YDWsReJdQHdY119U', 'North West & Ryde, Sydney NSW, Australia', '-33.71058720', '151.07042630', '-33.51248440', '151.18016060', '-33.84492330', '150.98664510', '-33.51248440', '151.18016060', '-33.84492330', '150.98664510', 101),
(208, '', 'Parramatta', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJl7NUgNGiEmsRI9wicpgEVMM', 'Parramatta, Sydney NSW, Australia', '-33.82274000', '150.98892380', '-33.75798890', '151.06585100', '-33.89880430', '150.91277510', '-33.75798890', '151.06585100', '-33.89880430', '150.91277510', 101),
(209, '', 'Sutherland Shire', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJS4I_MY3GEmsR6cztMlnEGYc', 'Sutherland Shire, NSW, Australia', '-34.07129480', '151.08207300', '-33.99526030', '151.23190300', '-34.16924890', '150.93604330', '-33.99526030', '151.23190300', '-34.16924890', '150.93604330', 101),
(210, '', 'The Hills District', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJU1nOYsJeDWsRKV58y323CP0', 'The Hills District, Sydney NSW, Australia', '-33.72771330', '150.97728410', '-33.46055010', '151.16125490', '-33.78849660', '150.88795630', '-33.46055010', '151.16125490', '-33.78849660', '150.88795630', 101),
(211, '', 'South West Sydney', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJ7-TgrKS_EmsRg5V6Tw-19PY', 'South West Sydney, Sydney NSW, Australia', '-34.01377810', '150.97728410', '-33.82540630', '151.15496820', '-34.09660170', '150.83177670', '-33.82540630', '151.15496820', '-34.09660170', '150.83177670', 101),
(212, '', 'Campbelltown Macarthur', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJUZpX3BOpE2sR09BwzayybT8', 'Campbelltown Macarthur, NSW, Australia', '-34.01854500', '150.83767690', '-33.95685670', '150.91287650', '-34.25999060', '150.70919860', '-33.95685670', '150.91287650', '-34.65558000', '150.12693990', 101),
(213, '', 'Greater Western Sydney', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJN3OIUxqQEmsR1euorDN3FwE', 'Greater Western Sydney, NSW, Australia', '-33.80484880', '150.72143620', '-33.54742370', '150.96495650', '-34.03547140', '150.58877980', '-33.54742370', '150.96495650', '-34.03547140', '150.58877980', 101),
(214, '', 'CBD & South Melbourne', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJORuuCkxd1moRNMrml7yk-C8', 'CBD & South Melbourne, VIC, Australia', '-37.83621640', '144.95017080', '-37.77296240', '145.01556380', '-37.85749940', '144.89849460', '-37.77296240', '145.01556380', '-37.85749940', '144.89849460', 120),
(215, '', 'Northern Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJf7fg57JP1moREHtcMzP1LSU', 'Northern Suburbs, Melbourne VIC, Australia', '-37.70349270', '144.91714120', '-37.50270700', '145.18673190', '-37.80790940', '144.79755980', '-37.50270700', '145.18673190', '-37.80790940', '144.79755980', 120),
(216, '', 'Eastern Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJ5yHPDKE51moR4155W18Zb5Y', 'Eastern Suburbs, Melbourne VIC, Australia', '-37.79301340', '145.18174070', '-37.70285600', '145.41326910', '-37.88891140', '144.98777710', '-37.70285600', '145.41326910', '-37.88891140', '144.98777710', 120),
(217, '', 'North Eastern Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJSUarniA11moRYoi01vQmSKo', 'North Eastern Suburbs, VIC, Australia', '-37.65441170', '145.15965920', '-37.49368030', '145.31155320', '-37.77040340', '145.05124420', '-37.49368030', '145.31155320', '-37.77040340', '145.05124420', 120),
(218, '', 'Western Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJ01MUMsyM1moR6QcQoafpmVI', 'Western Suburbs, Melbourne VIC, Australia', '-37.83740180', '144.65337470', '-37.46401680', '144.94023130', '-38.00464400', '144.39449210', '-37.46401680', '144.94023130', '-38.00464400', '144.39449210', 120),
(219, '', 'South Eastern Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJkUndBQka1moRFOjqe__e8A0', 'South Eastern Suburbs, Australia', '-38.04710840', '145.27012350', '-37.82797830', '145.66926130', '-38.24775080', '144.96574120', '-37.82797830', '145.66926130', '-38.24775080', '144.96574120', 120),
(220, '', 'Dandenongs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJr5P_RZom1moRe9Uf6vZwu6Q', 'Dandenongs, Melbourne VIC, Australia', '-37.89333940', '145.42501180', '-37.76398180', '145.62680360', '-38.00161020', '145.19693000', '-37.76398180', '145.62680360', '-38.00161020', '145.19693000', 120),
(221, '', 'Mornington Peninsula', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJA6hDiY7F1WoRldPZzU9z9iA', 'Mornington Peninsula, VIC, Australia', '-38.28540530', '145.09344900', '-38.16187860', '145.28671250', '-38.49910120', '144.65163260', '-38.16187860', '145.28671250', '-38.49910120', '144.65163260', 120),
(222, '', 'Macedon Ranges', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJ9Y91m4QE12oRFT8rCkB0-LQ', 'Macedon Ranges, VIC, Australia', '-37.31378380', '144.65337470', '-37.11895100', '144.86381820', '-37.56736030', '144.42476330', '-37.11895100', '144.86381820', '-37.56736030', '144.42476330', 120),
(223, '', 'Geelong', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJpVxUb14U1GoRQToZFUI0ktE', 'Geelong, VIC, Australia', '-38.23561930', '144.30300160', '-37.96412650', '144.59668150', '-38.39880370', '144.14455130', '-37.96412650', '144.59668150', '-38.39880370', '144.14455130', 121),
(224, '', 'Surf Coast', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJ8yadx2tA1GoRNQfmAXcrvjM', 'Surf Coast, Geelong VIC, Australia', '-38.21164810', '144.49990010', '-38.10765170', '144.77158660', '-38.43011050', '144.14892240', '-38.10765170', '144.77158660', '-38.43011050', '144.14892240', 121),
(225, '', 'CBD and Inner Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJ66YzWqlQkWsR1Laou2VLW20', 'CBD and Inner Suburbs, Brisbane QLD, Australia', '-27.47484980', '153.02653150', '-27.43091310', '153.05745750', '-27.50174660', '152.96233350', '-27.43091310', '153.05745750', '-27.50174660', '152.96233350', 134),
(226, '', 'Southside', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJmeOHASdbkWsRw0u3KwzwhB8', 'Southside, Brisbane QLD, Australia', '-27.57493210', '153.03830590', '-27.42812940', '153.15477580', '-27.66022070', '152.97454720', '-27.42812940', '153.15477580', '-27.66022070', '152.97454720', 134),
(227, '', 'Western Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJXVXzkuNNkWsRI2QKWKZ57m4', 'Western Suburbs, Brisbane QLD, Australia', '-27.50201610', '152.89705690', '-27.44337300', '153.02048800', '-27.64127620', '152.81058310', '-27.44337300', '153.02048800', '-27.64127620', '152.81058310', 134),
(228, '', 'Northern Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJ2yWb3Kf8k2sRCNU2k7ARLC8', 'Northern Suburbs, Brisbane QLD, Australia', '-27.29492180', '152.94412930', '-27.10817380', '153.16697740', '-27.46579830', '152.84434920', '-27.10817380', '153.16697740', '-27.46579830', '152.84434920', 134),
(229, '', 'Ipswich', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJ47m6m9LKlmsR0DIKlV_ZakY', 'Ipswich, QLD, Australia', '-27.63205310', '152.89705690', '-27.57378980', '152.94315710', '-27.70858630', '152.71279970', '-27.57378980', '152.94315710', '-27.85555740', '152.70583410', 134),
(230, '', 'Bayside', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJQ2bkIbbek2sRp78YtLyItdM', 'Bayside, Brisbane QLD, Australia', '-27.52726810', '153.22678380', '-27.02178730', '153.46866910', '-27.71145550', '153.11154970', '-27.02178730', '153.46866910', '-27.71145550', '153.11154970', 134),
(231, '', 'Logan', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJGaOaDGlHkWsRjskn8MXmvzk', 'Logan, QLD, Australia', '-27.71489000', '153.08540990', '-27.54504150', '153.36189830', '-27.89713180', '152.80325790', '-27.54504150', '153.36189830', '-27.89713180', '152.80325790', 134),
(232, '', 'Redcliffe', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJBacFL33lk2sR6Zws52AQYbA', 'Redcliffe, Brisbane QLD, Australia', '-27.21917940', '153.05008090', '-27.15793030', '153.11943330', '-27.26422640', '152.98190900', '-27.15793030', '153.11943330', '-27.26422640', '152.98190900', 134),
(233, '', 'Caboolture', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJc3SOpGiNk2sRnkHbq-FBAMU', 'Caboolture, Brisbane QLD, Australia', '-27.05374360', '153.03830590', '-26.81021150', '153.20734390', '-27.17768610', '152.80612380', '-26.81021150', '153.20734390', '-27.17768610', '152.80612380', 134),
(234, '', 'CBD', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJw_muKM26MioRU2te4Rn3sAg', 'CBD, Perth WA, Australia', '-31.95056720', '115.85809140', '-31.91376380', '115.88787920', '-31.97374770', '115.81788520', '-31.91376380', '115.88787920', '-31.97374770', '115.81788520', 148),
(235, '', 'Western Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJLy43j6ylMioRksGMzvR3lyY', 'Western Suburbs, Perth WA, Australia', '-31.95940730', '115.79301980', '-31.90815860', '115.84667520', '-32.02672660', '115.74949070', '-31.90815860', '115.84667520', '-32.02672660', '115.74949070', 148),
(236, '', 'Southern & Fremantle', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJabpVIcePMioRi7L9Pf0NqsE', 'Southern & Fremantle, WA, Australia', '-32.20096120', '115.89949230', '-31.93990950', '116.13410610', '-32.61079890', '115.63164230', '-31.93990950', '116.13410610', '-32.61079890', '115.63164230', 148),
(237, '', 'Eastern Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJXzau1JG3MioRGbqpKswo008', 'Eastern Suburbs, Perth WA, Australia', '-31.80465900', '116.06503070', '-31.74170890', '116.10898870', '-31.99760830', '115.90883240', '-31.74170890', '116.10898870', '-31.99760830', '115.90883240', 148),
(238, '', 'Perth Hills', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJL9SxZcruMioRjva7A6lv_Uo', 'Perth Hills, Perth WA, Australia', '-32.13848210', '116.18320680', '-31.92196800', '116.35808850', '-32.28682150', '115.96300390', '-31.92196800', '116.35808850', '-32.28682150', '115.96300390', 148),
(239, '', 'Northern Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJueymwI1TzSsRqnzaJEIfb0E', 'Northern Suburbs, Perth WA, Australia', '-31.54253500', '115.80485210', '-31.45486000', '115.96918710', '-31.95326770', '115.56467760', '-31.45486000', '115.96918710', '-31.95326770', '115.56467760', 148),
(240, '', 'Adelaide CBD', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJ56QDo9fOsGoRPpiLnizCzAk', 'Adelaide CBD, Adelaide SA 5000, Australia', '-34.93282940', '138.60381290', '-34.90925160', '138.62451490', '-34.94216640', '138.57710820', '-34.90925160', '138.62451490', '-34.94216640', '138.57710820', 155),
(241, '', 'Inner North', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJe5a-blXIsGoRIILMTtUYWSY', 'Inner North, Adelaide SA, Australia', '-34.88539640', '138.58878750', '-34.83838860', '138.64540650', '-34.91941710', '138.54894280', '-34.83838860', '138.64540650', '-34.91941710', '138.54894280', 155),
(242, '', 'Inner Southern Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJdTdK-RLQsGoRJ2RQJB5AnVE', 'Inner Southern Suburbs, Adelaide SA, Australia', '-34.98695870', '138.56876000', '-34.93013160', '138.63815430', '-35.05975500', '138.50371540', '-34.93013160', '138.63815430', '-35.05975500', '138.50371540', 155),
(243, '', 'Eastern Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJhfeFo5jLsGoRf4GqJyml3Rc', 'Eastern Suburbs, Adelaide SA, Australia', '-34.91853470', '138.66896970', '-34.88316100', '138.73322740', '-34.97637100', '138.61281750', '-34.88316100', '138.73322740', '-34.97637100', '138.61281750', 155),
(244, '', 'Western Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJB8rlEbjFsGoR4Nk74dy9L40', 'Western Suburbs, Adelaide SA, Australia', '-34.91545230', '138.52872670', '-34.85015230', '138.58136490', '-34.96438000', '138.47785680', '-34.85015230', '138.58136490', '-34.96438000', '138.47785680', 155),
(245, '', 'Adelaide Hills', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJ1UhgTeLRsGoRiZ98iHP3-U4', 'Adelaide Hills, Adelaide SA, Australia', '-35.01185620', '138.62886420', '-34.94534610', '138.68128390', '-35.06188330', '138.57016830', '-34.94534610', '138.68128390', '-35.06188330', '138.57016830', 155),
(246, '', 'North Eastern Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJ3exKbqG0sGoRP2y5TCm9g0Q', 'North Eastern Suburbs, Adelaide SA, Australia', '-34.83007290', '138.69906790', '-34.74433520', '138.78589310', '-34.88948670', '138.61868230', '-34.74433520', '138.78589310', '-34.88948670', '138.61868230', 155),
(247, '', 'The Port', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJVZwy_oTHsGoRhiz3NKKaM8U', 'The Port, SA, Australia', '-34.81559260', '138.50872090', '-34.75698810', '138.58239020', '-34.88439210', '138.47568880', '-34.75698810', '138.58239020', '-34.88439210', '138.47568880', 155),
(248, '', 'Southern Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJPTjLLNwnsWoRkcgGBGQTk9Y', 'Southern Suburbs, Adelaide SA, Australia', '-35.12988030', '138.53873230', '-35.02914610', '138.64507810', '-35.24732970', '138.46159960', '-35.02914610', '138.64507810', '-35.24732970', '138.46159960', 155),
(249, '', 'Northern Suburbs', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJ_-zJ3yyssGoRyQ_6jDUAfMg', 'Northern Suburbs, Adelaide SA, Australia', '-34.69326950', '138.67900070', '-34.50787180', '138.84788270', '-34.84981900', '138.44466300', '-34.50787180', '138.84788270', '-34.84981900', '138.44466300', 155),
(250, '', 'Southern Vales', '', '', 0, '2016-06-21 07:41:26', '2016-06-27 04:27:56', 'ChIJTQEyi-8vsWoRIUprFC32ADc', 'Southern Vales, SA, Australia', '-35.24614000', '138.59880400', '-35.14481150', '138.71878360', '-35.37792630', '138.42127600', '-35.14481150', '138.71878360', '-35.37792630', '138.42127600', 155);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
