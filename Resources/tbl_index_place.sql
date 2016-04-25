DROP TABLE IF EXISTS `tbl_index_place`;
CREATE TABLE IF NOT EXISTS `tbl_index_place` (
  `id` int(11) NOT NULL DEFAULT '0',
  `suburb` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `suburb_alt` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `state` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `state_alt` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country_alt` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `post` varchar(4) NOT NULL,
  `enter_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `bounds_northeast_latitude` decimal(10,7) NOT NULL,
  `bounds_northeast_longitude` decimal(10,7) NOT NULL,
  `bounds_southwest_latitude` decimal(10,7) NOT NULL,
  `bounds_southwest_longitude` decimal(10,7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE `tbl_index_place` ADD FULLTEXT KEY fulltext_location (suburb,suburb_alt,state,state_alt,country,post);