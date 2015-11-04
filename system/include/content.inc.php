<?php
// Include Class Object
// Name: content
// Description: web page content functions

// Render template, create html page view...

class content {
    protected $template = null;
    var $content = array();

    function __construct($content)
    {
        // TODO: Construct page from db, reference by id or friendly url
        //if ($GLOBALS['db']) $db = $GLOBALS['db'];
        //else $db = new db;
        //$this->_conn = $db->db_get_connection();

        $this->content = $content;
        $this->template = PATH_TEMPLATE.'page_master'.FILE_EXTENSION_TEMPLATE;
    }

    function render()
    {
        $content = $this->content;
        if (file_exists($this->template))
        {
            $template = file_get_contents($this->template);
            $rendered_content = $template;
            preg_match_all('/\[\[(\W+)?(\w+)\]\]/', $template, $matches, PREG_OFFSET_CAPTURE);
            foreach($matches[2] as $key=>$value)
            {
                if (!isset($content[$value[0]]))
                {
                    $rendered_content = str_replace($matches[0][$key][0], '', $rendered_content);
                    continue;
                }
                switch ($matches[1][$key][0])
                {
                    case '*':
                        $rendered_content = str_replace($matches[0][$key][0], $content[$value[0]], $rendered_content);
                        break;
                    case '$':
                        $chunk_render = '';
                        if (is_object( $content[$value[0]]))
                        {
                            if (method_exists($content[$value[0]], 'render'))
                            {
                                $chunk_render = $content[$value[0]]->render();
                            }
                        }
                        $rendered_content = str_replace($matches[0][$key][0], $chunk_render, $rendered_content);
                        break;
                    default:
                        // Un-recognized template variable types, do not process
                        $GLOBALS['global_message']->warning[] = 'Un-recognized template variable types. ('.__FILE__.':'.__LINE__.')';
                        $rendered_content = str_replace($matches[0][$key][0], '', $rendered_content);
                }
            }
            return $rendered_content;
        }
        else return print_r($content,1);
        //return ob_get_clean();
    }

}