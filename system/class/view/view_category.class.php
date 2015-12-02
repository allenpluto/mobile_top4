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
        $this->parameter['page_size'] = $GLOBALS['global_preference']->view_category_page_size;

        parent::__construct($value, $parameter);

        return $this;
    }

    function render($parameter = array())
    {
        if (isset($this->rendered_html) AND !isset($parameter['template']))
        {
            return $this->rendered_html;
        }

        if (!isset($this->row))
        {
            $result = $this->fetch_value($parameter);

            if ($result === false)
            {
                $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' cannot render object due to fetch value failed';
                return false;
            }
        }
        foreach ($this->row as $row_index=>$row_value)
        {
            $index_image_obj = new index_image();
            $index_image_obj->get_gallery_images($row_value['id'],array('item_type'=>'listingcategory','order'=>'RAND()'));
            $view_image_obj = new view_image($index_image_obj->id_group,array('page_size'=>1));
            $this->row[$row_index]['image'] = $view_image_obj;
        }

        return parent::render($parameter);
    }
}
    
?>