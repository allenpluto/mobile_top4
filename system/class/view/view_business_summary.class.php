<?php
// Class Object
// Name: view_business_summary
// Description: business summary block view, derived from view_organization

class view_business_summary extends view_organization
{
    var $parameter = array(
        'namespace' => 'business',
        'path' => '/',
        'table' => '`tbl_view_organization`',
        'primary_key' => 'id'
    );

    function __construct($value = Null, $parameter = array())
    {
        $this->parameter['page_size'] = $GLOBALS['global_preference']->view_business_summary_page_size;
        
        parent::__construct($value, $parameter);

        return $this;
    }
    
    function get($parameter = array())
    {
        parent::get($parameter);
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
            $this->row[$row_index]['logo'] = new view_business_summary_logo($row_value['logo_id']);
            if ($this->row[$row_index]['logo']->_initialized === false)
            {
                // For listing without logo, hide the logo div
                $this->row[$row_index]['logo']->rendered_html = '';
            }
            $this->row[$row_index]['image'] = new view_business_summary_image($row_value['image_id'],array('page_size'=>1));
            if ($this->row[$row_index]['image']->_initialized === false)
            {
                // For Listing without image, use default image
                $this->row[$row_index]['image']->row[] = array('image_src'=>'./content/image/img_listing_default_280_280.jpg');
            }
        }

        return parent::render($parameter);
    }
}
    
?>