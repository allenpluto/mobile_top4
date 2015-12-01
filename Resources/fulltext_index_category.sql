DROP INDEX fulltext_keyword ON ListingCategory;
ALTER TABLE ListingCategory
ADD FULLTEXT KEY fulltext_keyword (page_title,keywords);