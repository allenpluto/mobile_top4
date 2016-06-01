<?php
// Class Object
// Name: view_business_detail
// Description: business detail content view, derived from view_organization

class view_business_amp_detail extends view_organization
{
    var $parameter = array(
        'table' => '`tbl_view_organization`',
        'primary_key' => 'id',
        'page_size' => 1
    );

    function fetch_value($parameter = array())
    {
        $result = parent::fetch_value($parameter);
        $format = format::get_obj();
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
            if (isset($row['latitude']) AND isset($row['longitude']))
            {
                $this->row[$row_index]['geo_location_formatted'] =  round($row['latitude'],6).','.round($row['longitude'],6);
                if (!preg_match('/^(-?\d{2}\.\d+),(\d{3}\.\d+)$/', $this->row[$row_index]['geo_location_formatted']))
                {
                    unset($this->row[$row_index]['geo_location_formatted']);
                }
            }
            if (!empty($row['hours_work']))
            {
                $hours_work = json_decode($row['hours_work'],true);
                $hours_work_formatted = '';
                $hours_work_schema = array();
                $weekday_names = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

                foreach ($weekday_names as $weekday_index=>$weekday_name)
                {
                    $weekday_number = ($weekday_index + 1) % 7;
                    $hours_work_formatted .= '<div class="weekday_row"><div class="weekday_name">'.$weekday_names[$weekday_index].'</div><div class="weekday_content hour_row_container">';
                    if (isset($hours_work[$weekday_number]))
                    {
                        foreach ($hours_work[$weekday_number] as $time_period_index=>$time_period)
                        {
                            $open_time = $format->time($time_period[0]);
                            $close_time = $format->time($time_period[1]);
                            if ($close_time=='24:00') $close_time = '23:59';
                            $hours_work_formatted .= '<div class="hour_row">'.$open_time.' to '.$close_time.'</div>';
                            $hours_work_schema[] = [
                                '@type'=>'OpeningHoursSpecification',
                                'dayOfWeek'=>'http://schema.org/'.$weekday_name,
                                'opens'=>$open_time,
                                'closes'=>$close_time
                            ];
                        }
                    }
                    else
                    {
                        $hours_work_formatted .= '<div class="hour_row">Closed</div>';
                        $hours_work_schema[] = [
                            '@type'=>'OpeningHoursSpecification',
                            'dayOfWeek'=>'http://schema.org/'.$weekday_name,
                            'opens'=>'00:00',
                            'closes'=>'00:00'
                        ];
                    }
                    $hours_work_formatted .= '</div></div>';
                }

                $this->row[$row_index]['hours_work_formatted'] =  $hours_work_formatted;
                if ($row['base_category_id'] == 4)      // Only apply OpeningHoursSpecification schema markup for LocalBusiness and sub types
                {
                    $this->row[$row_index]['hours_work_schema'] =  $hours_work_schema;
                }
                unset($hours_work_formatted);
                unset($hours_work_schema);
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

        $format = format::get_obj();

        foreach ($this->row as $row_index=>$row_value)
        {
            $this->row[$row_index]['logo'] = new view_business_detail_logo($row_value['logo_id'],['template'=>'view_business_amp_detail_logo']);
            $this->row[$row_index]['top_text_container_column'] = ' column_8';
            if ($this->row[$row_index]['logo']->_initialized === false)
            {
                // For listing without logo, hide the logo div
                $this->row[$row_index]['logo']->rendered_html = '';
                $this->row[$row_index]['top_text_container_column'] = ' column_12';
            }
            else
            {
                $this->row[$row_index]['logo']->fetch_value();
                $GLOBALS['page_content']->content['script'][] = array('type'=>'json-ld','content'=>['image'=>$this->row[$row_index]['logo']->row[0]['image_src']]);
            }
            $this->row[$row_index]['banner'] = new view_business_detail_banner($row_value['banner_id']);
            if ($this->row[$row_index]['banner']->_initialized === false)
            {
                // For Listing without banner, use default
                // $this->row[$row_index]['banner']->rendered_html = '';
            }
            else
            {
                $this->row[$row_index]['banner']->fetch_value();
                $GLOBALS['page_content']->content['style'][] = array('type'=>'text_content', 'content'=>'#listing_detail_view_wrapper {background-image: url('.URI_IMAGE.'m/'.$this->row[$row_index]['banner']->row[0]['image_file'].');} @media only screen and (min-width:320px) and (max-width:479px) {#listing_detail_view_wrapper {background-image: url('.URI_IMAGE.'l/'.$this->row[$row_index]['banner']->row[0]['image_file'].');}} @media only screen and (min-width:480px) and (max-width:767px) {#listing_detail_view_wrapper {background-image: url('.URI_IMAGE.'xl/'.$this->row[$row_index]['banner']->row[0]['image_file'].');}} @media only screen and (min-width:768px) {#listing_detail_view_wrapper {background-image: url('.URI_IMAGE.'xxl/'.$this->row[$row_index]['banner']->row[0]['image_file'].');}}');
            }

            if ($this->row[$row_index]['count_review'] > 0)
            {
                $this->row[$row_index]['aggregaterating'] = new view_web_page_element(null, array(
                    'template'=>'view_business_detail_aggregaterating',
                    'build_from_content'=>array(
                        array(
                            'count_review'=>$this->row[$row_index]['count_review'],
                            'avg_review'=>$this->row[$row_index]['avg_review']
                        )
                    )
                ));
                $GLOBALS['page_content']->content['style'][] = array('type'=>'text_content', 'content'=>'#listing_detail_view_top_container .rating_star_front_container {width:'.$row_value['avg_review_percentage'].'%;}');
            }

            $keyword_strip_tags = strip_tags($this->row[$row_index]['keywords']);
            if (!empty($keyword_strip_tags))
            {
                $this->row[$row_index]['keyword_section'] = new view_web_page_element(null, array(
                    'template'=>'view_business_detail_keyword_section',
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
                    'template'=>'view_business_detail_overview_section',
                    'build_from_content'=>array(
                        array(
                            'long_description'=>$this->row[$row_index]['long_description']
                        )
                    )
                ));

            }
            unset($overview_strip_tags);

            if (isset($this->row[$row_index]['geo_location_formatted']))
            {
                $map_uri = 'http://maps.google.com/maps?q='.$this->row[$row_index]['geo_location_formatted'].'&z=16';
            }
            else
            {
                $map_uri = 'http://maps.google.com/maps?q='.urlencode($this->row[$row_index]['street_address'].', '.$this->row[$row_index]['suburb'].' '.$this->row[$row_index]['state'].' '.$this->row[$row_index]['post'].', Australia').'&z=16';
            }

            $this->row[$row_index]['contact_section'] = new view_web_page_element(null, array(
                'template'=>'view_business_amp_detail_contact_section',
                'build_from_content'=>array(
                    array(
                        'phone'=>$this->row[$row_index]['phone']?'<a href="tel:'.$this->row[$row_index]['phone'].'">'.$format->phone($this->row[$row_index]['phone']).'</a>':'N/A',
                        'website'=>$this->row[$row_index]['website']?'<a href="'.$format->uri($this->row[$row_index]['website']).'" target="_blank">'.$format->uri($this->row[$row_index]['website']).'</a>':'N/A',
                        'street_address'=>$this->row[$row_index]['street_address'],
                        'suburb'=>$this->row[$row_index]['suburb'],
                        'state'=>$this->row[$row_index]['state'],
                        'post'=>$this->row[$row_index]['post'],
                        'map_uri'=>$map_uri
                    )
                )
            ));

            if (isset( $this->row[$row_index]['hours_work_formatted']))
            {
                $this->row[$row_index]['hour_section'] = new view_web_page_element(null, array(
                    'template'=>'view_business_amp_detail_hour_section',
                    'build_from_content'=>array(
                        array(
                            'hours_work_formatted'=>$this->row[$row_index]['hours_work_formatted']
                        )
                    )
                ));
            }

            $this->row[$row_index]['gallery'] = new view_business_amp_detail_gallery();
            $this->row[$row_index]['gallery']->get_business_gallery($this->id_group);
            $this->row[$row_index]['gallery']->fetch_value();
            if (count($this->row[$row_index]['gallery']->id_group) == 0)
            {
                // For listing without gallery, hide the gallery section
                unset($this->row[$row_index]['gallery_section']);
            }
            else
            {
                $this->row[$row_index]['gallery_section'] = new view_web_page_element(null, array(
                    'template'=>'view_business_amp_detail_gallery_section',
                    'build_from_content'=>array(
                        array(
                            'gallery'=>$this->row[$row_index]['gallery']
                        )
                    )
                ));
            }

            if (isset($row_value['schema_itemtype']))
            {
                if (preg_match('/^(https?:\/\/[-\.\w]+)\/([-\.\w]+)\/?(.*)$/', $row_value['schema_itemtype'], $matches))
                {
                    $GLOBALS['page_content']->content['script'][] = array('type'=>'json-ld','content'=>['@context'=>$matches[1],'@type'=>$matches[2]]);
                }
            }
            if (isset($row_value['name'])) $GLOBALS['page_content']->content['script'][] = array('type'=>'json-ld','content'=>['name'=>$row_value['name']]);
            if (isset($row_value['street_address']))
            {
                $GLOBALS['page_content']->content['script'][] = array('type'=>'json-ld','content'=>[
                    'address'=>[
                        '@type'=>'PostalAddress',
                        'streetAddress'=>$row_value['street_address'],
                        'addressLocality'=>$row_value['suburb'],
                        'addressRegion'=>$row_value['state'],
                        'postalCode'=>$row_value['post'],
                        'addressCountry'=>'AU'
                    ]
                ]);
            }
            if (isset($row_value['geo_location_formatted']) AND $row_value['base_category_id'] == 4)
            {
                $GLOBALS['page_content']->content['script'][] = array('type'=>'json-ld','content'=>[
                    'geo'=>[
                        '@type'=>'GeoCoordinates',
                        'latitude'=>round($row_value['latitude'],6),
                        'longitude'=>round($row_value['longitude'],6)
                    ]
                ]);
            }
            if (isset($row_value['phone'])) $GLOBALS['page_content']->content['script'][] = array('type'=>'json-ld','content'=>['telephone'=>$row_value['phone']]);
            if (isset($row_value['website'])) $GLOBALS['page_content']->content['script'][] = array('type'=>'json-ld','content'=>['url'=>$row_value['website']]);
            if (isset( $this->row[$row_index]['hours_work_schema'])) $GLOBALS['page_content']->content['script'][] = array('type'=>'json-ld','content'=>['openingHoursSpecification'=>$row_value['hours_work_schema']]);
        }

        return parent::render($parameter);
    }
}
    
?>
