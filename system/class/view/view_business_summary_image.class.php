<?php
// Class Object
// Name: view_business_summary_image
// Description: image view

class view_business_summary_image extends view_image
{
    function fetch_value($parameter = array())
    {
        if (!isset($parameter['image_size'])) $parameter['image_size'] = 's';
        $result = parent::fetch_value($parameter);
        return $result;
    }
}


?>