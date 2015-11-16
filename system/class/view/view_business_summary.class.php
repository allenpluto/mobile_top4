<?php
// Class Object
// Name: view_business_summary
// Description: business summary block view, derived from view_organization

class view_business_summary extends view_organization
{
	var $parameters = array(
        'namespace' => 'business/',
		'table' => '`tbl_view_featured`',
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