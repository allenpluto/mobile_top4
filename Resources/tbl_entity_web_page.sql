-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2015 at 06:08 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `allen_frame_trial`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_entity_web_page`
--

DROP TABLE IF EXISTS `tbl_entity_web_page`;
CREATE TABLE IF NOT EXISTS `tbl_entity_web_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `friendly_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `alternate_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `image_id` int(11) NOT NULL DEFAULT '-1',
  `enter_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `meta_keywords` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'meta keywords',
  `page_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'content title, h1 tag by default',
  `page_content` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'content text, with html tags',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_entity_web_page`
--

INSERT INTO `tbl_entity_web_page` (`id`, `friendly_url`, `name`, `alternate_name`, `description`, `image_id`, `enter_time`, `update_time`, `meta_keywords`, `page_title`, `page_content`) VALUES
(1, 'privacy-policy', 'Privacy Policy', '', 'Top4 is committed to protecting your privacy. The Privacy Act 1988 (Cth), the Australian Privacy Principles and this Privacy Policy set out what personal information we collect, how we hold it, use it, and who we might share it with.', -1, '2015-12-02 23:41:16', '2015-12-03 04:28:47', '', 'Privacy Policy', '  <p>Top4 is committed to protecting your privacy. The Privacy Act 1988 (Cth), the Australian Privacy Principles and this Privacy Policy set out what personal information we collect, how we hold it, use it, and who we might share it with.</p>\n  <h2>1. WHAT PERSONAL INFORMATION DO WE COLLECT?</h2>\n  <ul>\n    <li>account information, including information about your account from Third Party Services. Top4 does not receive or store passwords from Third Party Services.</li>\n    <li>name;</li>\n    <li>mailing or street address;</li>\n    <li>email address;</li>\n    <li>telephone number</li>\n    <li>age or birth date;</li>\n    <li>profession, occupation or job title;</li>\n    <li>your network and connections;</li>\n    <li>details of the products and services you have purchased from us or which you have enquired about, together with any additional information necessary to deliver those products and services and to respond to your enquiries;</li>\n    <li>any additional information relating to you that you provide to us directly through our websites or indirectly through use of our website or online presence through our representatives or otherwise.</li>\n  </ul>\n  <h2>2. WHAT INFORMATION DO WE COLLECT?</h2>\n  <ul>\n    <li>directly from you through our websites, phone calls, application forms or when you download and use digital apps</li>\n    <li>from your telephone service provider, such as your listing details for our telephone directories</li>\n    <li>from public sources</li>\n    <li>from your visits and clicks on our web pages or social media presences, and</li>\n    <li>when we''re required to do so by law</li>\n  </ul>\n  <h2>3. HOW DO WE USE YOUR PERSONAL INFORMATION?</h2>\n  <p>We provide relevant businesses to you based on your location. We also monitor customer traffic patterns and site usage to help us develop the design and layout of the platform. We may also use the information we collect to occasionally notify you about important functionality changes to top4.com.au and its services, and special offers we think you''ll find valuable.</p>\n  <h2>4. HOW DO WE PROTECT YOUR PERSONAL INFORMATION?</h2>\n  <p>The information you provide us with will not be shared with third parties unless it is a requisite for us to be able to deliver a service to you. We will ascertain that we will comply with the Commonwealth Privacy Act 1988 when making use of information provided by you via online forms on this website, any type of communications that you may use to contact us or any databases we use to retain your details.</p>\n  <h2>5. DISCLOSURE OF YOUR PERSONAL INFORMATION TO OUTSIDE PARTIES</h2>\n  <p>We will never divulge any of your personal details, by which we mean your name and address or email address, to any third party for them to market unrelated products or services to you. We may use your details to advise you of money saving offers, or major changes at top4.com.a. We may subcontract a third party to mail offers to you from ourselves but they will also be bound not to divulge your personal information to third parties. Third party cookies may be used to track behaviour on our site by third parties. These cookies do not contain any personal details. <a href="http://stg.top4.com.au/content/cookie-policy.html">To find out about our Cookie Policy click here.</a>Your information will be held by Top4. If you do not wish to receive information about our promotional offers from time-to-time from Top4, please email <a href="mailto:info@top4.com.au">info@top4.com.au</a>.</p>\n  <h2>6. HOW TO CONTACT US</h2>\n  <p>If you have any questions about this privacy policy, you can contact the Top4 support team by email (<a href="mailto:support@top4.com.au">support@top4.com.au</a>).</p>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
