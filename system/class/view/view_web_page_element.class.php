<?php
// Class Object
// Name: view_web_page
// Description: entity_web_page's main view table

class view_web_page_element extends view
{
    var $parameter = array(
        'table' => '`tbl_view_organization`',
        'primary_key' => 'id'
    );

    function fetch_value($parameter = array())
    {
        if (isset($this->parameter['build_from_content']))
        {
            $this->row = $this->parameter['build_from_content'];
        }
        else
        {
            parent::fetch_value($parameter);
        }
    }

}
    
?>