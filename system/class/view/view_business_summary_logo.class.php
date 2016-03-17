<?php
// Class Object
// Name: view_business_summary_logo
// Description: image view

class view_business_summary_logo extends view_image
{
    function fetch_value($parameter = array())
    {
        if (!isset($parameter['image_size'])) $parameter['image_size'] = 'xxs';
        $result = parent::fetch_value($parameter);
        if ($result !== false AND is_array($this->row))
        {
            foreach ($this->row as $row_index=>$row_value)
            {
                $this->row[$row_index]['image_src_xxs'] = URI_IMAGE . 'xxs/' . $row_value['image_file'];
                $this->row[$row_index]['image_src_xs'] = URI_IMAGE . 'xs/' . $row_value['image_file'];
            }
            $result = $this->row;
        }
        return $result;
    }
}


?>