<?php
// Class Object
// Name: view_business_summary
// Description: business summary block view, derived from view_organization

class view_business_summary extends view_organization
{
	/*var $parameters = array(
		'table' => '`tbl_entity_organization`
JOIN `tbl_rel_organization_to_person` ON `tbl_entity_organization`.`id` = `tbl_rel_organization_to_person`.`organization_id` AND `tbl_rel_organization_to_person`.`relationship` = 1
JOIN `tbl_entity_person` ON `tbl_rel_organization_to_person`.`person_id` = `tbl_entity_person`.`id`',
		'table_fields' => array('`tbl_entity_organization`.id','`tbl_entity_organization`.friendly_url','`tbl_entity_organization`.name','`tbl_entity_organization`.description','`tbl_entity_organization`.logo_id','`tbl_entity_person`.name AS owner_name'),
		'primary_key' => '`tbl_entity_organization`.`id`');*/
	var $parameters = array(
		'table' => '`tbl_view_organization`',
		'table_fields' => array('id','friendly_url','name','description','logo_id','"/asset/image/test-image.jpg" as logo_src'),
		'primary_key' => 'id'		
	);	
	
	function __construct($init_value = Null, $parameters = array())
	{
		$this->parameters['page_size'] = $GLOBALS['global_preference']->business_summary_view_page_size;
		
		parent::__construct($init_value, $parameters);

		return $this;
	}
	
	function get($parameter = array())
	{
		parent::get($parameter);
	}
	
}
	
?>