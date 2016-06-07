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

    function pre_render($parameter = array())
    {
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
            else
            {
                $this->row[$row_index]['image']->fetch_value();
                $GLOBALS['page_content']->content['style'][] = array('type'=>'text_content', 'content'=>'#listing_block_container_'.$row_value['id'].' .block_thumb_image_container {background-image: url('.URI_IMAGE.'s/'.$this->row[$row_index]['image']->row[0]['image_file'].');} @media only screen and (min-width:768px) {#listing_block_container_'.$row_value['id'].' .block_thumb_image_container {background-image: url('.URI_IMAGE.'m/'.$this->row[$row_index]['image']->row[0]['image_file'].');}}');
            }
            if ($this->row[$row_index]['count_review'] > 0)
            {
                $this->row[$row_index]['aggregaterating'] = new view_web_page_element(null, array(
                    'template'=>'view_business_aggregaterating',
                    'build_from_content'=>array(
                        array(
                            'count_review'=>$this->row[$row_index]['count_review'],
                            'avg_review'=>$this->row[$row_index]['avg_review']
                        )
                    )
                ));
            }
        }
    }
}
    
?>