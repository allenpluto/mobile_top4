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

    function fetch_value($parameter = array())
    {
        $result = parent::fetch_value($parameter);
        foreach ($result as $row_index=>$row)
        {
            if (isset($row['long_description']))
            {
                $this->row[$row_index]['long_description'] = '<p>'.str_replace('<br />','</p><p>',nl2br(strip_tags($row['long_description']))).'</p>';
            }
        }
        return $result;
    }
}
	
?>