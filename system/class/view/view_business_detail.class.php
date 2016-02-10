<?php
// Class Object
// Name: view_business_detail
// Description: business detail content view, derived from view_organization

class view_business_detail extends view_organization
{
    var $parameter = array(
        'table' => '`tbl_view_organization`',
        'primary_key' => 'id',
        'page_size' => 1
    );

    function fetch_value($parameter = array())
    {
        $result = parent::fetch_value($parameter);
        foreach ($result as $row_index=>$row)
        {
            if (isset($row['keywords']))
            {
                $this->row[$row_index]['keywords'] = '<p>'.str_replace('<br />',', ',nl2br(strip_tags($row['keywords']))).'</p>';
            }
            if (isset($row['long_description']))
            {
                $this->row[$row_index]['long_description'] = '<p>'.str_replace('<br />','</p><p>',nl2br(strip_tags($row['long_description']))).'</p>';
            }
        }
        return $result;
    }
}
    
?>