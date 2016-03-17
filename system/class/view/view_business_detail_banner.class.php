<?php
// Class Object
// Name: view_business_detail_banner
// Description: image view

class view_business_detail_banner extends view_image
{
    function fetch_value($parameter = array())
    {
        if (!isset($parameter['image_size'])) $parameter['image_size'] = 'l';
        $result = parent::fetch_value($parameter);
        return $result;
    }

    function render($parameter = array())
    {
        $result = parent::render($parameter);
        if ($result !== false)
        {
            $this->rendered_html = trim($this->rendered_html);
        }
        return $this->rendered_html;
    }
}

?>