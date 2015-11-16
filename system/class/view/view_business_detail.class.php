<?php
// Class Object
// Name: view_business_detail
// Description: business detail content view, derived from view_organization

class view_business_detail extends view_organization
{
	var $parameters = array(
		'table' => '`tbl_view_organization`',
		'primary_key' => 'id',
        'page_size' => 1
	);
	
	function __construct($init_value = Null, $parameters = array())
	{
		parent::__construct($init_value, $parameters);

		return $this;
	}
	
	function get($parameter = array())
	{
		parent::get($parameter);
	}
	
}
	
?>