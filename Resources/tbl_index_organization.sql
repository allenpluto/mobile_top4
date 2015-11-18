DROP VIEW IF EXISTS `tbl_index_organization`;
CREATE VIEW `tbl_index_organization` AS
SELECT Listing.id,Listing.account_id,Listing.title as name,Listing.keywords,Listing.description,TRIM(CONCAT(Listing.address,' ',Listing.address2)) AS street_address,Listing.city AS suburb,Listing.state,Listing.zip_code AS post,Listing.avg_review,Listing.count_review,Listing.number_views as count_visit,ListingCategory.id AS category_id,ListingCategory.page_title AS category_name,IF((CURDATE()<=ListingFeatured.date_end AND CURDATE()>=ListingFeatured.date_start), 1, 0) AS featured FROM Listing Listing
JOIN Listing_Category Listing_Category ON Listing.id = Listing_Category.listing_id
JOIN ListingCategory ListingCategory ON ListingCategory.id = Listing_Category.category_id
LEFT JOIN ListingFeatured ON Listing.id = ListingFeatured.listing_id