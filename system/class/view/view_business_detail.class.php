<?php
// Class Object
// Name: view_business_detail
// Description: business detail content view, derived from view_organization

class view_business_detail extends view_organization
{
    var $parameter = array(
        'table' => '`tbl_view_organization`',
        'primary_key' => 'id',
        'page_size' => 1
    );

    function fetch_value($parameter = array())
    {
        $result = parent::fetch_value($parameter);
        foreach ($result as $row_index=>$row)
        {
            if (isset($row['keywords']))
            {
                $this->row[$row_index]['keywords'] = '<p>'.str_replace('<br />',', ',nl2br(strip_tags($row['keywords']))).'</p>';
            }
            if (isset($row['long_description']))
            {
                $this->row[$row_index]['long_description'] = '<p>'.str_replace('<br />','</p><p>',nl2br(strip_tags($row['long_description']))).'</p>';
            }
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

        if (empty($this->row))
        {
            $GLOBALS['global_message']->notice = __FILE__.'(line '.__LINE__.'): '.get_class($this).' rendering empty array';
            return '';
        }

        foreach ($this->row as $row_index=>$row_value)
        {
            $this->row[$row_index]['logo'] = new view_business_detail_logo($row_value['logo_id']);
            $this->row[$row_index]['top_text_container_column'] = ' column_8';
            if ($this->row[$row_index]['logo']->_initialized === false)
            {
                // For listing without logo, hide the logo div
                $this->row[$row_index]['logo']->rendered_html = '';
                $this->row[$row_index]['top_text_container_column'] = ' column_12';
            }
            $this->row[$row_index]['banner'] = new view_business_detail_banner($row_value['banner_id']);
            if ($this->row[$row_index]['banner']->_initialized === false)
            {
                // For Listing without banner, use default
                // $this->row[$row_index]['banner']->rendered_html = '';
            }

            $keyword_strip_tags = strip_tags($this->row[$row_index]['keywords']);
            if (!empty($keyword_strip_tags))
            {
                $this->row[$row_index]['keyword_section'] = new view_web_page_element(null, array(
                    'template'=>'view_business_detail_keyword',
                    'build_from_content'=>array(
                        array(
                            'keywords'=>$this->row[$row_index]['keywords']
                        )
                    )
                ));
            }
            unset($keyword_strip_tags);

            $overview_strip_tags = strip_tags($this->row[$row_index]['long_description']);
            if (!empty($overview_strip_tags))
            {
                $this->row[$row_index]['overview_section'] = new view_web_page_element(null, array(
                    'template'=>'view_business_detail_overview',
                    'build_from_content'=>array(
                        array(
                            'long_description'=>$this->row[$row_index]['long_description']
                        )
                    )
                ));

            }
            unset($overview_strip_tags);

            $geo_location_formatted = round($this->row[$row_index]['latitude'],6).','.round($this->row[$row_index]['longitude'],6);
            // check latitude, longitude exists
            if (preg_match('/^(-?\d{2}\.\d+),(\d{3}\.\d+)$/', $geo_location_formatted))
            {
                $this->row[$row_index]['map_section'] = new view_web_page_element(null, array(
                    'template'=>'view_business_detail_map',
                    'build_from_content'=>array(
                        array(
                            'street_address'=>$this->row[$row_index]['street_address'],
                            'suburb'=>$this->row[$row_index]['suburb'],
                            'state'=>$this->row[$row_index]['state'],
                            'post'=>$this->row[$row_index]['post'],
                            'geo_location_formatted'=>$geo_location_formatted
                        )
                    )
                ));
            }
            unset($geo_location_formatted);
        }

        return parent::render($parameter);
    }
}
    
?>