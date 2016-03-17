<?php
// Class Object
// Name: view_category_image
// Description: image view

class view_category_image extends view_image
{
    function fetch_value($parameter = array())
    {
        if (!isset($parameter['image_size'])) $parameter['image_size'] = 'm';
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