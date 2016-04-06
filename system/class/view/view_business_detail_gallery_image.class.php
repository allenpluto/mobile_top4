<?php
// Class Object
// Name: view_business_detail_gallery_image
// Description: listing detail gallery image

class view_business_detail_gallery_image extends view_image
{
    function __construct($value = Null, $parameter = array())
    {
        parent::__construct($value, $parameter);
        $this->set_parameter(['page_size'=>10]);

        return $this;
    }

    function fetch_value($parameter = array())
    {
        if (!isset($parameter['image_size'])) $parameter['image_size'] = 'm';
        $result = parent::fetch_value($parameter);
        if ($result !== false AND is_array($this->row))
        {
            foreach ($this->row as $row_index=>$row_value)
            {
                $this->row[$row_index]['image_src_m'] = URI_IMAGE . 'm/' . $row_value['image_file'];
                $this->row[$row_index]['image_src_l'] = URI_IMAGE . 'l/' . $row_value['image_file'];
                $this->row[$row_index]['image_src_xl'] = URI_IMAGE . 'xl/' . $row_value['image_file'];
            }
            $result = $this->row;
        }
        return $result;
    }

    function pre_render($parameter = array())
    {
        $css_style = ['default'=>[],'s'=>[],'m'=>[]];
        foreach ($this->row as $row_index=>$row_value)
        {
            if ($row_index == 0 OR $row_index == count($this->row)-1)
            {
                $css_style['default'][] = '#listing_detail_view_gallery_image_container_'.$row_value['id'].'_clone {background-image: url('.$row_value['image_src_m'].');}';
                $css_style['xs'][] = '#listing_detail_view_gallery_image_container_'.$row_value['id'].'_clone {background-image: url('.$row_value['image_src_l'].');}';
                $css_style['s'][] = '#listing_detail_view_gallery_image_container_'.$row_value['id'].'_clone {background-image: url('.$row_value['image_src_xl'].');}';
            }
            $css_style['default'][] = '#listing_detail_view_gallery_image_container_'.$row_value['id'].' {background-image: url('.$row_value['image_src_m'].');}';
            $css_style['xs'][] = '#listing_detail_view_gallery_image_container_'.$row_value['id'].' {background-image: url('.$row_value['image_src_l'].');}';
            $css_style['s'][] = '#listing_detail_view_gallery_image_container_'.$row_value['id'].' {background-image: url('.$row_value['image_src_xl'].');}';
        }
        $GLOBALS['page_content']->content['style'][] = array('type'=>'text_content', 'content'=>implode('',$css_style['default']).'@media only screen and (min-width:320px) and (max-width:479px) {'.implode('',$css_style['xs']).'} @media only screen and (min-width:480px) and (max-width:991px) {'.implode('',$css_style['s']).'}');
        unset($css_style);
    }
}


?>