<?php
// Class Object
// Name: view
// Description: Base class for all database view classes, read only, represents large number of rows
// Stored Value:
//              id_group -  row ids, set on get
//              row - row values of desired page, set on fetch_value, unset on get
//              rendered_html - implement html template of row, set on render, unset on get and fetch_value

class view
{
    // database connection
    protected $_conn = null;

    // ids of select rows
    var $id_group = array();

    // row of values, only fetch on fetch_value(), clear on get()
    protected $row = null;

    // rendered html, only generate on render(), clear on get()
    protected $rendered_html = '';

    // Object variables
    var $parameters = array();
    var $_initialized = false;

    /**
     *
     */
    function __construct($value = null, $parameters = array())
    {
        if (!empty($parameters)) $this->set_parameters($parameters);

        if ($GLOBALS['db']) $db = $GLOBALS['db'];
        else $db = new db;
        $this->_conn = $db->db_get_connection();

        // By default, view object name as database view table name, but if certain view object does not have corresponded view table in db, table name to be overwritten, columns and primary key also need to be defined specifically

        // parameters['table'] in view does not necessarily mean one table, can be multiple tables with JOIN conditions, e.g. $this->parameters['table'] = 'tbl_entity_organization JOIN tbl_entity_organization parent_organization ON tbl_entity_organization.parent_organization_id = parent_organization.id'
        if (!isset($this->parameters['table']))
        {
            $this->parameters['table'] = DATABASE_TABLE_PREFIX.get_class($this);
        }

        // parameters['table_fields'] in view suggest the columns being selected, when multiple tables are joined, fields would probably need reference the tables they are in and might need alias, e.g. parameters['table_fields'] = 'tbl_entity_organization.id, tbl_entity_organization.name, parent_organization.id AS parent_id, parent_organization.name AS parent_name'
        if (!isset($this->parameters['table_fields']))
        {
            $result = $db->db_get_columns($this->parameters['table']);
            if ($result === false)
            {
                return false;
            }
            else
            {
                $this->parameters['table_fields'] = $result;
            }
        }

        // parameters['primary_key'] in view need to be single column field, if it is not defined, default to id
        if (!isset($this->parameters['primary_key']))
        {
            $this->parameters['primary_key'] = '`id`';
        }

        if (!isset($this->parameters['template']))
        {
            if (file_exists(PATH_TEMPLATE.get_class($this).FILE_EXTENSION_TEMPLATE))
            {
                $this->parameters['template'] = PATH_TEMPLATE.get_class($this).FILE_EXTENSION_TEMPLATE;
            }
            else
            {
                $this->parameters['template'] = '';
            }
        }

        if (!isset($this->parameters['page_number']))
        {
            $this->parameters['page_number'] = 0;
        }

        if (!isset($this->parameters['page_size']))
        {
            $this->parameters['page_size'] = $GLOBALS['global_preference']->default_view_page_size;
        }

        $this->parameters['page_count'] = 0;


        if (!is_null($value))
        {
            $format = format::get_obj();
            $id_group = $format->id_group($value);
            if ($id_group === false)
            {
                if (is_string($value))
                {
                    $parameters = array(
                        'bind_param' => array(':friendly_url'=>$value),
                        'where' => array('`friendly_url` = :friendly_url')
                    );
                    $this->get($parameters);
                }
                else
                {
                    $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' initialize object with invalid id(s)';
                    return false;
                }
            }
            else
            {
                $this->id_group = $id_group;
                $this->get();
            }

            /*if (is_array($value))
            {
                $this->id_group = $value;
                $this->get();
            }
            else    // Simplified usage, not secured
            {
                if (is_numeric($value)) // try to initialize with id
                {
                    $this->id_group = array('id'=>$value);
                    $this->get();
                }
                else // try to initialize with friendly url
                {
                    $parameters = array(
                        'bind_param' => array(':friendly_url'=>$value),
                        'where' => array('`friendly_url` = :friendly_url')
                    );
                    $this->get($parameters);
                }
            }*/
            $this->parameters['page_count'] = ceil(count($this->id_group)/$this->parameters['page_size']);
        }
    }

    function query($sql, $parameters=array())
    {
        $query = $this->_conn->prepare($sql);
        $query->execute($parameters);

        if ($query->errorCode() == '00000')
        {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        else
        {
            $query_errorInfo = $query->errorInfo();
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): SQL Error - '.$query_errorInfo[2];
            return false;
        }
    }

    function set_parameters($parameters = array())
    {
        // In view table, primary_key are fixed during construction
        if (isset($parameters['primary_key']))
        {
            unset($parameters['primary_key']);
        }
        $this->parameters = array_merge($this->parameters, $parameters);
    }

    function set_page_size($page_size)
    {
        $page_size = intval($page_size);
        if ($page_size > 0)
        {
            $this->parameters['page_number'] = 0;
            $this->parameters['page_size'] = $page_size;
            $this->parameters['page_count'] = ceil(count($this->id_group)/$this->parameters['page_size']);
        }
    }

    function get($parameters = array())
    {
        // When id_group changes, reset the stored row value and rendered html
        $this->row = null;
        $this->rendered_html = null;

        $parameters = array_merge($this->parameters,$parameters);

        if (count($this->id_group) > 0)
        {
            $this->_initialized = true;
        }

        if (empty($parameters['bind_param']))
        {
            $parameters['bind_param'] = array();
        }

        $sql = 'SELECT '.$this->parameters['primary_key'].' FROM '.$this->parameters['table'];
        $where = array();
        if (!empty($parameters['where']))
        {
            if (is_array($parameters['where']))
            {
                $where = $parameters['where'];
            }
            else
            {
                $where[] = $parameters['where'];
            }
        }
        if ($this->_initialized)
        {
            if (!empty($this->id_group))
            {
                $where[] = $parameters['primary_key'].' IN ('.implode(',',array_keys($this->id_group)).')';
                $parameters['bind_param'] = array_merge($parameters['bind_param'],$this->id_group);
            }
        }

        if (!empty($where))
        {
            $sql .= ' WHERE '.implode(' AND ', $where);
        }
        else
        {
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' cannot retrieve records with none specific where conditions and empty id_group in view.';
            return false;
        }

        if (!empty($parameters['order']))
        {
            if (is_array($parameters['order']))
            {
                $parameters['order'] = implode(', ', $parameters['order']);
            }
            $sql .= ' ORDER BY '.$parameters['order'];
        }
        if (!empty($parameters['limit']))
        {
            $sql .= ' LIMIT '.$parameters['limit'];
        }
        if (!empty($parameters['offset']))
        {
            $sql .= ' OFFSET '.$parameters['offset'];
        }
        $result = $this->query($sql,$parameters['bind_param']);
        if ($result !== false)
        {
            $new_id_group = array();
            foreach ($result as $row_index=>$row_value)
            {
                $new_id_group[] = $row_value[$this->parameters['primary_key']];
            }
            // Keep the original id order if no specific "order by" is set
            if ($this->_initialized AND empty($parameters['order'])) $this->id_group = array_intersect($this->id_group, $new_id_group);
            else
            {
                $format = format::get_obj();
                $new_id_group = $format->id_group($new_id_group);
                $this->id_group = $new_id_group;
            }

            $this->_initialized = true;
            $this->parameters['page_count'] = ceil(count($this->id_group)/$this->parameters['page_size']);
            return $this->id_group;
        }
        else
        {
            return false;
        }
    }

    function fetch_value($parameters = array())
    {
        if (isset($this->row))
        {
            return $this->row;
        }
        // unset rendered html when corresponding row value changes
        $this->rendered_html = null;
        if (!$this->_initialized)
        {
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' cannot fetch value before it is initialized with get() function';
            return false;
        }
        if (empty($this->id_group))
        {
            $GLOBALS['global_message']->notice = __FILE__.'(line '.__LINE__.'): '.get_class($this).' fetch value from empty array';
            return array();
        }
        $parameters = array_merge($this->parameters,$parameters);
        $page_number = intval($parameters['page_number']);
        if ($page_number > $parameters['page_count']-1) $page_number =  $parameters['page_count']-1;
        if ($page_number < 0) $page_number = 0;
        $page_size = intval($parameters['page_size']);
        if ($page_size < 1) $page_size = 1;
        $sql = 'SELECT '.implode(',',$parameters['table_fields']).' FROM '.$this->parameters['table'];
        $where = $parameters['primary_key'].' IN ('.implode(',',array_keys($this->id_group)).')';
        $order = 'FIELD('.$this->parameters['primary_key'].','.implode(',',array_keys($this->id_group)).')';
        $bind_param = $this->id_group;
        $sql .= ' WHERE '.$where.' ORDER BY '.$order.' LIMIT '.$page_size.' OFFSET '.$page_number*$page_size;
        $result = $this->query($sql,$bind_param);
        if ($result !== false)
        {
            $this->row = $result;
        }
        else
        {
            $this->row = array();
        }
        return $this->row;
    }

    function render($parameters = array())
    {
        if (isset($this->rendered_html) AND !isset($parameters['template']))
        {
            return $this->rendered_html;
        }

        if (!isset($this->row))
        {
            $result = $this->fetch_value($parameters);

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

        if (isset($parameters['template']))
        {
            $parameters['template'] = PATH_TEMPLATE.$parameters['template'].FILE_EXTENSION_TEMPLATE;
        }

        $parameters = array_merge($this->parameters,$parameters);

        $template = $parameters['template'];
        if (!file_exists($template)) $template = '';
        else $template = file_get_contents($template);


        if (count($this->row) > 0)
        {
            if (empty($template))
            {
                return print_r($this->row,1);
            }
            else
            {
                $rendered_result = array();
                foreach ($this->row as $row_index=>$row_value)
                {
                    $content = $row_value;
                    if (isset($parameters['extra_content']))
                    {
                        $content = array_merge($content,$parameters['extra_content']);
                    }
                    $rendered_content = $template;
                    preg_match_all('/\[\[(\W+)?(\w+)\]\]/', $template, $matches, PREG_OFFSET_CAPTURE);
                    foreach($matches[2] as $key=>$value)
                    {
                        switch ($matches[1][$key][0])
                        {
                            case '*':
                                // simple value variable
                                if (!isset($content[$value[0]]))
                                {
                                    $rendered_content = str_replace($matches[0][$key][0], '', $rendered_content);
                                    continue;
                                }
                                $rendered_content = str_replace($matches[0][$key][0], str_replace(chr(146),'\'',$content[$value[0]]), $rendered_content);
                                break;
                            case '$':
                                // view object, executing sub level rendering
                                if (!isset($content[$value[0]]))
                                {
                                    $rendered_content = str_replace($matches[0][$key][0], '', $rendered_content);
                                    continue;
                                }
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
                            case '&':
                                // object parameter variable
                                if (!isset($this->parameters[$value[0]]))
                                {
                                    $rendered_content = str_replace($matches[0][$key][0], '', $rendered_content);
                                    continue;
                                }
                                $rendered_content = str_replace($matches[0][$key][0], $this->parameters[$value[0]], $rendered_content);
                                break;
                            case '-':
                                // comment area, do not render even if it matches any key
                                $rendered_content = str_replace($matches[0][$key][0], '', $rendered_content);
                                break;
                            default:
                                // Un-recognized template variable types, do not process
                                $GLOBALS['global_message']->warning = 'Un-recognized template variable types. ('.__FILE__.':'.__LINE__.')';
                                $rendered_content = str_replace($matches[0][$key][0], '', $rendered_content);

                        }
                    }
                    $rendered_result[] = $rendered_content;
                }
                $rendered_html = implode('', $rendered_result);
                // Only store rendering with default template
                if (!isset($parameters['template']))
                {
                    $this->rendered_html = $rendered_html;
                }

                return $rendered_html;
            }
        }

    }
}

?>