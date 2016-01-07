DROP VIEW IF EXISTS `tbl_view_web_page`;
CREATE VIEW `tbl_view_web_page` AS
SELECT web_page.id, web_page.friendly_url, web_page.name, web_page.description, web_page.meta_keywords, web_page.page_title, web_page.page_content, web_page.image_id, web_page_image.image_file FROM tbl_entity_web_page web_page
LEFT JOIN tbl_view_image web_page_image ON web_page.image_id = web_page_image.id