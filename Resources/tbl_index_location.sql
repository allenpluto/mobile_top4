DROP TABLE IF EXISTS `tbl_index_location`;
CREATE TABLE `tbl_index_location` AS
SELECT * FROM `top4_main`.`Postcode_Suburb`;
ALTER TABLE  `tbl_index_location` ENGINE = MYISAM DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE `tbl_index_location` ADD PRIMARY KEY(`id`);
ALTER TABLE `tbl_index_location` ADD FULLTEXT KEY fulltext_location (suburb, region, state);
