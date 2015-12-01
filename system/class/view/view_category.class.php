<?php
// Class Object
// Name: view_category
// Description: entity_web_page's main view table

class view_category extends view
{
    var $parameter = array(
        'table' => 'ListingCategory',
    );

    function __construct($value = Null, $parameter = array())
    {
        $this->parameter['page_size'] = $GLOBALS['global_preference']->business_summary_view_page_size;

        parent::__construct($value, $parameter);

        return $this;
    }
}
    
?>