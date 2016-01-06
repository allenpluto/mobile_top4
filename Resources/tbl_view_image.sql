DROP VIEW IF EXISTS `tbl_view_image`;
CREATE VIEW `tbl_view_image` AS
SELECT id, width, height, CONCAT(prefix, 'photo_', id, '.', LCASE(type)) AS image_file
FROM Image