DROP TRIGGER IF EXISTS tbl_entity_organization_after_insert;
CREATE TRIGGER tbl_entity_organization_after_insert AFTER INSERT ON tbl_entity_organization
FOR EACH ROW BEGIN
  DECLARE post VARCHAR(10);
  DECLARE suburb VARCHAR(100);
  DECLARE region VARCHAR(100);
  DECLARE state VARCHAR(100);
  IF (NEW.suburb_id > 0) THEN
    SELECT post_code, suburb, region, state INTO post, suburb, region, state FROM postcode_suburb WHERE id = NEW.suburb_id;
  END IF;
  INSERT INTO tbl_index_organization (id, account_id, name, keywords, description, street_address, postcode_suburb_id, suburb, region, state, post, avg_review, count_review, count_visit, featured) VALUES (NEW.id, NEW.account_id, NEW.name, NEW.keywords, NEW.description, NEW.address, NEW.suburb_id, suburb, region, state, post, 0, 0, 0, 0);
END;

FOR EACH ROW
  BEGIN
    INSERT INTO tbl_index_organization (id, account_id, name, keywords, description, street_address, postcode_suburb_id, suburb, region, state, post, avg_review, count_review, count_visit, featured)
      SELECT ROW.id, ROW.account_id, ROW.name, ROW.keywords, ROW.description, ROW.address, ROW.suburb_id, postcode_suburb.suburb, postcode_suburb.region, postcode_suburb.state, postcode_suburb.post_code AS post, 0 AS avg_review, 0 AS count_review, 0 AS count_vist, 0 AS featured
      FROM ROW LEFT JOIN postcode_suburb ON ROW.suburb_id = postcode_suburb.id;
  END;
