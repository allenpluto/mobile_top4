<?php
// Class Object
// Name: view_business_summary_logo
// Description: image view

class view_business_summary_logo extends view_image
{
    function fetch_value($parameter = array())
    {
        if (!isset($parameter['image_size'])) $parameter['image_size'] = 'xxs';
        $result = parent::fetch_value($parameter);
        return $result;
    }
}


?>