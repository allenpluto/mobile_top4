SELECT listing.id, GROUP_CONCAT(listing_category.category_id), GROUP_CONCAT(gallery_item.gallery_id) FROM `listing`
LEFT JOIN listing_category ON listing.id = listing_category.listing_id
LEFT JOIN gallery_item ON listing.id = gallery_item.item_id
WHERE listing.id = 120
GROUP BY listing.id




SELECT listing.id, cat, gal FROM `listing`
LEFT JOIN
(
	SELECT listing_id, GROUP_CONCAT(category_id) AS cat FROM listing_category WHERE listing_id IN (10,120) GROUP BY listing_id
) tbl_cat
ON listing.id = tbl_cat.listing_id
LEFT JOIN
(
	SELECT item_id, GROUP_CONCAT(gallery_id) AS gal FROM gallery_item WHERE item_id IN (10,120) GROUP BY item_id
) tbl_gal
ON listing.id = tbl_gal.item_id
WHERE listing.id IN (10,120)
