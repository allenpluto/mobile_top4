<?php
// Class Object
// Name: view_business_detail_gallery
// Description: business detail gallery view, derived from view_gallery

class view_business_detail_gallery extends view_gallery
{
    function get_business_gallery($value, $parameter = array())
    {
        $format = format::get_obj();
        $listing_id_group = $format->id_group(array('value'=>$value,'key_prefix'=>':listing_id_'));
        if ($listing_id_group === false)
        {
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' invalid listing id(s)';
            return false;
        }

        $filer_parameter = array(
            'where' => array(
                '`item_type` = "listing"',
                '`item_id` IN ('.implode(',',array_keys($listing_id_group)).')'
            ),
            'bind_param' => $listing_id_group
        );
        $filer_parameter = array_merge($filer_parameter, $parameter);
        $this->get_by_item($filer_parameter);
    }
}
    
?>