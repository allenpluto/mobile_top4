DROP TABLE IF EXISTS `tbl_rel_category_to_organization`;
CREATE TABLE `tbl_rel_category_to_organization`
  SELECT
    Listing_Category.category_id,
    Listing_Category.listing_id AS organization_id,
    '' as constrain,
    '' as relation
  FROM Listing_Category
  GROUP BY Listing_Category.category_id,
    Listing_Category.listing_id
  ORDER BY Listing_Category.category_id,
    Listing_Category.listing_id;
ALTER TABLE `tbl_rel_category_to_organization` ENGINE = InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE `tbl_rel_category_to_organization`
MODIFY `category_id` INT(11),
MODIFY `organization_id` INT(11),
MODIFY `constrain` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT "",
MODIFY `relation` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT "";
ALTER TABLE `tbl_rel_category_to_organization` ADD PRIMARY KEY (`category_id`, `organization_id`, `constrain`);
