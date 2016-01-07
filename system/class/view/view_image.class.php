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
        'page_size' => 1
    );

    function fetch_value($parameter = array())
    {
        $result = parent::fetch_value($parameter);
        if ($result !== false AND is_array($this->row))
        {
            foreach ($this->row as $row_index=>$row_value)
            {
                $this->row[$row_index]['image_src'] = URI_IMAGE . $row_value['image_file'];
            }
            $result = $this->row;
        }
        return $result;
    }

}
    
?>