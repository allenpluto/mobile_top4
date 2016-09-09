TRUNCATE TABLE `tbl_rel_category_to_organization`;
INSERT INTO `tbl_rel_category_to_organization` (
  `category_id`,
  `organization_id`,
  `constrain`,
  `relation`)
  SELECT
    Listing_Category.category_id,
    Listing_Category.listing_id AS organization_id,
    '' as constrain,
    '' as relation
  FROM Listing_Category
  GROUP BY Listing_Category.category_id,
    Listing_Category.listing_id
  ORDER BY Listing_Category.category_id,
    Listing_Category.listing_id
ON DUPLICATE KEY UPDATE
  `relation` = `relation`