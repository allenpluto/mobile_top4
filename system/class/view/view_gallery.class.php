<?php
// Class Object
// Name: view_gallery
// Description: gallery view

class view_gallery extends view
{
    var $parameter = array(
        'table' => '`Gallery`',
        'primary_key' => 'id'
    );

    function get_by_item($parameter = array())
    {
        $filer_parameter = array(
            'primary_key' => 'gallery_id',
            'table' => 'Gallery_Item'
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
                $this->row[$row_index]['gallery_image'] = new view_business_detail_gallery_image();
                $this->row[$row_index]['gallery_image']->get_by_gallery($row_value['id']);
            }
            $result = $this->row;
        }
        return $result;
    }
}
    
?>