<?php
// Class Object
// Name: view_business_summary
// Description: business summary block view, derived from view_organization

class view_business_summary extends view_organization
{
	var $parameter = array(
        'namespace' => 'business/',
		'table' => '`tbl_view_organization`',
		'primary_key' => 'id'
	);

	function __construct($value = Null, $parameter = array())
	{
		$this->parameter['page_size'] = $GLOBALS['global_preference']->business_summary_view_page_size;
		
		parent::__construct($value, $parameter);

		return $this;
	}
	
	function get($parameter = array())
	{
		parent::get($parameter);
	}
}
	
?>