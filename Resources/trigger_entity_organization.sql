CREATE TRIGGER tbl_entity_organization_after_insert AFTER INSERT ON tbl_entity_organization
FOR EACH ROW 
    INSERT INTO tbl_index_organization (id, account_id, name, keywords, description, street_address, postcode_suburb_id, suburb, region, state, post, avg_review, count_review, count_vist, featured)
    VALUES (NEW.id, NEW.account_id, NEW.name, NEW.keywords, NEW.description, NEW.street_address, NEW.suburb_id, suburb, region, state, post, avg_review, count_review, count_vist, featured)
