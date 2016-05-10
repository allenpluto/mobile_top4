INSERT INTO `tbl_entity_category` (
  `id`,
  `friendly_url`,
  `name`,
  `alternate_name`,
  `description`,
  `image_id`,
  `enter_time`,
  `update_time`,
  `keywords`,
  `content`,
  `status`,
  `category_id`,
  `scoopit_url`,
  `schema_itemtype`)
  SELECT
    ListingCategory.id,
    ListingCategory.friendly_url,
    ListingCategory.title as name,
    ListingCategory.page_title as alternate_name,
    '' as description,
    0 as image_id,
    NOW() as enter_time,
    NOW() as update_time,
    ListingCategory.keywords,
    ListingCategory.content,
    IF(ListingCategory.featured = 'y', 'A', 'S') as status,
    ListingCategory.category_id,
    ListingCategory.scoopit_url,
    ListingCategory.schema_itemtype
  FROM ListingCategory
  WHERE ListingCategory.id NOT IN (SELECT tbl_entity_category.id FROM tbl_entity_category)
  GROUP BY ListingCategory.id
  ORDER BY ListingCategory.id;
