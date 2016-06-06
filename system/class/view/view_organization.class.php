<?php
// Class Object
// Name: view_organization
// Description: entity_organization's main view table, display everything about organization

class view_organization extends view
{
    function fetch_value($parameter = array())
    {
        $format = format::get_obj();
        $result = parent::fetch_value($parameter);
        if ($result !== false)
        {
            foreach ($result as $row_index=>$row)
            {
                if (isset($row['name']))
                {
                    $result[$row_index]['friendly_url'] = $format->file_name($row['name'].'-'.$row[$this->parameter['primary_key']]);
                }
            }
            $this->row = $result;
        }
        return $result;
    }
}
    
?>