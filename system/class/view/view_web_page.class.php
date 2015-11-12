<?php
// Class Object
// Name: view_web_page
// Description: entity_web_page's main view table

class view_web_page extends view
{
    var $parameters = array(
        'table' => '`tbl_view_business_summary`',
        'primary_key' => 'id'
    );

    function __construct($init_value = Null, $parameters = array())
	{
        $init_value = 12054;

		parent::__construct($init_value, $parameters);

		return $this;
	}
	
	function get($parameter = array())
	{
		parent::get($parameter);
	}
	
}
	
?>