<?php
// Class Object
// Name: view_web_page
// Description: entity_web_page's main view table

class view_web_page extends view
{
    function fetch_value($parameter = array())
    {
        if (isset($this->parameter['build_from_content']))
        {
            $this->row = $this->parameter['build_from_content'];
        }
        else
        {
            parent::fetch_value($parameter);
        }
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

        if ($this->_initialized)
        {
            $format = format::get_obj();
            foreach ($this->row as $row_index=>$row_value)
            {
                $this->row[$row_index]['body'] = new view_web_page_element(null, array(
                    'template'=>'element_body_default',
                    'build_from_content'=>array(
                        array(
                            'class_extra'=>' '.$format->class_name($row_value['friendly_url']).'_container general_style_bg_white',
                            'page_title'=>'<h1>'.$row_value['page_title'].'</h1>',
                            'page_content'=>$row_value['page_content']
                        ),
                    )
                ));
            }

        }

        return parent::render($parameter);
    }

}
    
?>