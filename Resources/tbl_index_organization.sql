DROP TABLE IF EXISTS `tbl_index_organization`;
CREATE TABLE `tbl_index_organization` AS
SELECT tbl_entity_organization.id,tbl_entity_organization.name,tbl_entity_organization.alternate_name,tbl_entity_organization.description,tbl_entity_organization.enter_time,tbl_entity_organization.update_time,tbl_entity_organization.keywords,tbl_entity_organization.account_id,tbl_entity_organization.place_id,TRIM(CONCAT(tbl_entity_organization.address_additional_info,' / ',tbl_entity_place.formatted_address)) AS street_address,place_locality.alternate_name AS suburb,place_administrative_area_level_1.alternate_name AS state,Listing.zip_code AS post,Listing.avg_review,Listing.count_review,Listing.number_views as count_visit,GROUP_CONCAT(ListingCategory.id) AS category_id,GROUP_CONCAT(ListingCategory.page_title) AS category_name,GROUP_CONCAT(ListingCategory.keywords) AS category_keywords,IF((CURDATE()<=ListingFeatured.date_end AND CURDATE()>=ListingFeatured.date_start), 1, 0) AS featured FROM Listing Listing
LEFT JOIN Listing_Category Listing_Category ON Listing.id = Listing_Category.listing_id
LEFT JOIN ListingCategory ListingCategory ON ListingCategory.id = Listing_Category.category_id
LEFT JOIN ListingFeatured ON Listing.id = ListingFeatured.listing_id
GROUP BY Listing.id;
ALTER TABLE `tbl_index_organization` ADD PRIMARY KEY(`id`);
ALTER TABLE `tbl_index_organization` ENGINE = MYISAM DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE `tbl_index_organization` ADD FULLTEXT KEY fulltext_category (category_name, category_keywords);
ALTER TABLE `tbl_index_organization` ADD FULLTEXT KEY fulltext_keyword (name, alternate_name, description, keywords);
ALTER TABLE `tbl_index_organization` ADD FULLTEXT KEY fulltext_location (street_address, suburb, region, state);