<?php
// Class Object
// Name: view_place_suburb
// Description: suburb view table, display suburb info, show in map etc

class view_place_suburb extends view
{
    function fetch_value($parameter = array())
    {
        $format = format::get_obj();
        $result = parent::fetch_value($parameter);
        if ($result !== false)
        {
            foreach ($result as $row_index=>$row)
            {
                if (isset($row['suburb']) AND !isset($row['friendly_url']))
                {
                    $result[$row_index]['friendly_url'] = $format->file_name($row['suburb'].'-'.$row['postal_code']);
                }
            }
            $this->row = $result;
        }
        return $result;
    }
}
    
?>