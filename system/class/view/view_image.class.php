<?php
// Class Object
// Name: view_image
// Description: image view

class view_image extends view
{
    var $parameter = array(
        'namespace' => 'image/',
        'table' => '`tbl_view_image`',
        'primary_key' => 'id',
        'image_size' => 'm',
        'page_size' => 1
    );

    function get_by_gallery($value, $parameter = array())
    {
        $format = format::get_obj();
        $gallery_id_group = $format->id_group(array('value'=>$value,'key_prefix'=>':gallery_id_'));
        if ($gallery_id_group === false)
        {
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' invalid gallery id(s)';
            return false;
        }

        $filer_parameter = array(
            'primary_key' => 'image_id',
            'table' => 'Gallery_Image',
            'where' => array(
                '`gallery_id` IN ('.implode(',',array_keys($gallery_id_group)).')'
            ),
            'bind_param' => $gallery_id_group
        );
        $filer_parameter = array_merge($filer_parameter, $parameter);
        return parent::get($filer_parameter);
    }

    function fetch_value($parameter = array())
    {
        $parameter = array_merge($this->parameter,$parameter);
        $result = parent::fetch_value($parameter);
        if ($result !== false AND is_array($this->row))
        {
            foreach ($this->row as $row_index=>$row_value)
            {
                $this->row[$row_index]['image_src'] = URI_IMAGE . $parameter['image_size'] . '/' . $row_value['image_file'];
            }
            $result = $this->row;
        }
        return $result;
    }

}
    
?>