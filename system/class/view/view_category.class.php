<?php
// Class Object
// Name: view_category
// Description: entity_category's main view table

class view_category extends view
{
    var $parameter = array(
        'namespace' => 'listing',
        'path' => '/find/',
        'table' => 'ListingCategory',
    );

    function __construct($value = Null, $parameter = array())
    {
        $this->parameter['page_size'] = $GLOBALS['global_preference']->view_category_page_size;

        parent::__construct($value, $parameter);

        return $this;
    }

    function fetch_value($parameter = array())
    {
        $format = format::get_obj();
        $result = parent::fetch_value($parameter);
        
        $parameter = array_merge($this->parameter,$parameter);
        if ($result !== false)
        {
            foreach ($result as $row_index=>$row)
            {
                if (isset($row['name']))
                {
                    $result[$row_index]['friendly_url'] = $format->file_name($row['name'].'-'.$row[$this->parameter['primary_key']]);
                }
                $result[$row_index]['full_url'] =  $parameter['namespace'] .  $parameter['path'] . $result[$row_index]['friendly_url'];
            }
            $this->row = $result;
        }
        return $result;
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
            $view_image_obj = new view_category_image($index_image_obj->id_group,array('page_size'=>1));
            $this->row[$row_index]['image'] = $view_image_obj;
            if ($this->row[$row_index]['image']->_initialized === false)
            {
                // For Listing without image, use default image
                $this->row[$row_index]['image']->row[] = array('image_src'=>'./content/image/img_listing_default_280_280.jpg');
            }
            else
            {
                $this->row[$row_index]['image']->fetch_value();
                $this->content['script'][] = array('type'=>'text_content', 'content'=>'');
                $GLOBALS['page_content']->content['style'][] = array('type'=>'text_content', 'content'=>'#category_block_container_'.$row_value['id'].' .block_thumb_image_container {background-image: url('.URI_IMAGE.'m/'.$this->row[$row_index]['image']->row[0]['image_file'].');} @media only screen and (min-width:768px) and (max-width:991px) {#category_block_container_'.$row_value['id'].' .block_thumb_image_container {background-image: url('.URI_IMAGE.'l/'.$this->row[$row_index]['image']->row[0]['image_file'].');}}');
            }
        }

        return parent::render($parameter);
    }
}
    
?>