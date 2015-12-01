DROP VIEW IF EXISTS `tbl_view_image`;
CREATE VIEW `tbl_view_image` AS
SELECT id, width, height, CONCAT('http://stg.top4.com.au/custom/domain_1/image_files/', prefix, 'photo_', id, '.', LCASE(type)) AS image_src
FROM Image