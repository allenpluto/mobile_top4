<?php
// Class Object
// Name: entity
// Description: Base class for all database table classes, read/write limited rows per query (PHP memory limit and system performance)

class entity
{
    // database connection
    protected $_conn = null;

    // ids of select rows
    var $id_group = array();

    // row of values, only fetch on fetch_value(), clear on get()
    protected $row = null;

    // Object variables
    var $parameter = array();
    var $_initialized = false;

    function __construct($value = null, $parameter = array())
    {
        if (!empty($parameter)) $this->set_parameter($parameter);

        if ($GLOBALS['db']) $db = $GLOBALS['db'];
        else $db = new db;
        $this->_conn = $db->db_get_connection();

        if (!isset($this->parameter['table']))
        {
            $this->parameter['table'] = DATABASE_TABLE_PREFIX.get_class($this);
        }

        if (!isset($this->parameter['table_fields']))
        {
            $result = $db->db_get_columns($this->parameter['table']);
            if ($result === false)
            {
                return false;
            }
            else
            {
                $this->parameter['table_fields'] = $result;
                // By default, leave enter_time and update_time untended, let MYSQL update them with system timestamp
                $field_index = array_search('update_time', $this->parameter['table_fields']);
                if ($field_index !== false)
                {
                    unset($this->parameter['table_fields'][$field_index]);
                }
                $field_index = array_search('enter_time', $this->parameter['table_fields']);
                if ($field_index !== false)
                {
                    unset($this->parameter['table_fields'][$field_index]);
                }
                unset($field_index);
            }
        }

        // parameter['primary_key'] in entity need to be single column field, if it is not defined, default to id
        if (!isset($this->parameter['primary_key']))
        {
            $result = $db->db_get_primary_key($this->parameter['table']);
            if (empty($result[0]))
            {
                $this->parameter['primary_key'] = 'id';
            }
            else
            {
                $this->parameter['primary_key'] = $result[0];
            }
        }

        if (!is_null($value))
        {
            $format = format::get_obj();
            $id_group = $format->id_group($value);
            if ($id_group === false)
            {
                if (is_string($value))
                {
                    $parameter = array(
                        'bind_param' => array(':friendly_url'=>$value),
                        'where' => array('`friendly_url` = :friendly_url')
                    );
                    $this->get($parameter);
                }
                else
                {
                    $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' initialize object with invalid id(s) {'.print_r($id_group,1).'}';
                    return false;
                }
            }
            else
            {
                $this->id_group = $id_group;
                $this->get();
            }
        }

        return true;
    }

    function query($sql, $parameter=array())
    {
        $query = $this->_conn->prepare($sql);
        $query->execute($parameter);

        if ($query->errorCode() == '00000')
        {
            return $query;
        }
        else
        {
            $query_errorInfo = $query->errorInfo();
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): SQL Error - '.$query_errorInfo[2];
            return false;
        }
    }

    function set_parameter($parameter = array())
    {
        $this->parameter = array_merge($this->parameter, $parameter);
    }

    function get($parameter = array())
    {
        if (count($this->row) > 0)
        {
            $this->_initialized = true;        // In case initialize process is done out of class functions
        }
        
        // If columns not set, use default
        if (!isset($parameter['columns']))
        {
            if (!empty($this->parameter['select_fields']))
            {
                $parameter['columns'] = $this->parameter['select_fields'];
            }
            else
            {
                $parameter['columns'] = array('*');
            }
        }

        if (empty($parameter['bind_param']))
        {
            $parameter['bind_param'] = array();
        }

        $sql = 'SELECT '.implode(',',$parameter['columns']).' FROM '.DATABASE_TABLE_PREFIX.get_class($this);
        if (!empty($parameter['where']))
        {
            if (is_array($parameter['where']))
            {
                $parameter['where'] = implode(' AND ', $parameter['where']);
            }
            $sql .= ' WHERE '.$parameter['where'];
        }
        else
        {
            if ($this->_initialized)
            {
                $row_ids = array();
                foreach ($this->row as $row_index=>$row_value)
                {

                    if (!empty($row_value[$this->parameter['primary_key']]))
                    {
                        $row_ids[] = $row_value[$this->parameter['primary_key']];
                    }
                }
                if (!empty($row_ids))
                {
                    $where = '`'.$this->parameter['primary_key'].'` IN (-1';

                    foreach ($row_ids as $row_id_index=>$row_id_value)
                    {
                        $where .= ',:id_'.$row_id_index;
                        $parameter['bind_param'][':id_'.$row_id_index] = $row_id_value;
                    }
                    $where .= ')'; 
                    $sql .= ' WHERE '.$where;
                }
            }
            else
            {
                $this->message[] = 'Error: Cannot retrieve records without specific where conditions and rows with primary keys.';
                return false;
            }
        }
        if (!empty($parameter['order']))
        {
            $sql .= ' ORDER BY '.$parameter['order'];
        }
        else
        {
            if ($this->_initialized)
            {
                $row_ids = array();
                foreach ($this->row as $row_index=>$row_value)
                {

                    if (!empty($row_value[$this->parameter['primary_key']]))
                    {
                        $row_ids[] = $row_value[$this->parameter['primary_key']];
                    }
                }
                if (!empty($row_ids))
                {
                    $order = 'FIELD(`'.$this->parameter['primary_key'].'`';

                    foreach ($row_ids as $row_id_index=>$row_id_value)
                    {
                        $order .= ',:id_'.$row_id_index;
                        $parameter['bind_param'][':id_'.$row_id_index] = $row_id_value;
                    }
                    $order .= ')'; 
                    $sql .= ' ORDER BY '.$order;
                }
            }
        }
        if (!empty($parameter['limit']))
        {
            $sql .= ' LIMIT '.$parameter['limit'];
        }
        else
        {
            $sql .= ' LIMIT '.$GLOBALS['global_preference']->default_entity_row_max;
        }
        if (!empty($parameter['offset']))
        {
            $sql .= ' OFFSET '.$parameter['offset'];
        }
        $query = $this->query($sql,$parameter['bind_param']);
        if ($query->errorCode() == '00000')
        {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $this->row = $result;
            $this->_initialized = true;
            return $result;
        }
        else
        {
            $query_errorInfo = $query->errorInfo();
            $this->message[] = 'SQL Error: '.$query_errorInfo[2];
            return false;
        }
    }

    function set($value = array(), $parameter = array())
    {
        if (empty($value))
        {
            if (empty($this->row))
            {
                $GLOBALS['global_message']->warning = __FILE__.'(line '.__LINE__.'): '.get_class($this).' INSERT/UPDATE entity with empty value';
                return false;
            }
            else
            {
                $value = $this->row;
            }
        }
        $parameter = array_merge($this->parameter,$parameter);

        if (empty($parameter['bind_param']))
        {
            $parameter['bind_param'] = array();
        }

        if (!isset($parameter['set_type']))
        {
            $field_index = array_search($parameter['primary_key'], $parameter['table_fields']);
            if ($field_index !== false)
            {
                // If primary key in field list, treat with INSERT ON DUPLICATE UPDATE
                $parameter['set_type'] = 'insert_update';
            }
            else
            {
                // If primary key not provided, INSERT only
                $parameter['set_type'] = 'insert';
            }
        }

        $id_group = array();

        switch($parameter['set_type'])
        {
            case 'insert':
                $sql = 'INSERT INTO '.$parameter['table'].' (`'.implode('`,`',$parameter['table_fields']).'`) VALUES (:'.implode(',:',$parameter['table_fields']).')';
                $query = $this->_conn->prepare($sql);
                foreach ($value as $index=>$row)
                {
                    $bind_value = array();
                    foreach ($parameter['table_fields'] as $field_index=>$field_name)
                    {
                        if (isset($row[$field_name]))
                        {
                            $bind_value[':'.$field_name] = $row[$field_name];
                        }
                        else
                        {
                            $bind_value[':'.$field_name] = $row[$field_index];
                        }
                    }
                    $bind_value = array_merge($parameter['bind_param'],$bind_value);

                    if (count($bind_value) != count($parameter['table_fields']))
                    {
                        $GLOBALS['global_message']->warning = __FILE__.'(line '.__LINE__.'): '.get_class($this).' INSERT/UPDATE fields count('.count($parameter['table_fields']).') is not consistent to value count('.count($bind_value).') - '.print_r($bind_value,true);
                    }
                    else
                    {
                        $query->execute($bind_value);
                        if ($query->errorCode() == '00000')
                        {
                            $query2 = $this->_conn->query('SELECT LAST_INSERT_ID() AS new_id;');
                            $result = $query2->fetch(PDO::FETCH_ASSOC);
                            $id_group[] = $result['new_id'];
                        }
                        else
                        {
                            $query_errorInfo = $query->errorInfo();
                            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): SQL Error - '.$query_errorInfo[2];
                        }
                    }
                }
                print_r($id_group);
                exit();
                break;
            case 'insert_update':
                break;
            case 'update':
                break;
        }

        //INSERT INTO `tbl_entity`(`id`, `friendly_url`, `name`) VALUES ('', 'test4', 'Test Name 4') ON DUPLICATE KEY UPDATE `friendly_url` = VALUES(`friendly_url`), `name` = VALUES(`name`);
//SELECT LAST_INSERT_ID() AS new_id;


        foreach ($this->row as $row_index=>$row_value)
        {
            $sql_columns = array();
            $sql_values = array();
            $bind_values = array();
            
            // Bind values for all insert and update fields
            $sql_columns = array_unique(array_merge($parameter['insert_fields'],$parameter['update_fields']));

            foreach ($sql_columns as $column_index=>$column_value)
            {
                if(isset($row_value[$column_value]))
                {
                    $sql_values[$column_value] = ':'.$column_value;
                    $bind_values[':'.$column_value] = $row_value[$column_value];
                }
                else
                {
                    // if the field has default values, for example update_time, enter_time
                    if (isset($this->default_value[$column_value]))
                    {
                        $sql_values[$column_value] = $this->default_value[$column_value];
                    }
                }
            }


            $sql = 'INSERT INTO '.DATABASE_TABLE_PREFIX.get_class($this).' (';
            foreach($parameter['insert_fields'] as $column_index=>$column_value)
            {
                if (isset($sql_values[$column_value]))
                {
                    if ($column_index > 0)
                    {
                        $sql .= ', ';
                    }
                    $sql .= '`'.$column_value.'`';
                }
            }
            $sql .= ') VALUES (';
            foreach($parameter['insert_fields'] as $column_index=>$column_value)
            {
                if (isset($sql_values[$column_value]))
                {
                    if ($column_index > 0)
                    {
                        $sql .= ', ';
                    }
                    $sql .= $sql_values[$column_value];
                }
            }
            $sql .= ') ON DUPLICATE KEY UPDATE ';
            foreach($parameter['update_fields'] as $column_index=>$column_value)
            {
                if (isset($sql_values[$column_value]))
                {
                    if ($column_index > 0)
                    {
                        $sql .= ', ';
                    }
                    $sql .= '`'.$column_value .'` = '.$sql_values[$column_value];
                }
            }

            $row_bind_values = array_merge($parameter['bind_param'], $bind_values);
            $query = $this->query($sql,$row_bind_values);
            if ($query->errorCode() == '00000')
            {
                $this->row[$row_index][$this->parameter['primary_key']] = $this->_conn->lastInsertId();
            }
            else
            {
                $query_errorInfo = $query->errorInfo();
                $this->message[] = 'SQL Error: '.$query_errorInfo[2];
                return false;
            }
        }

        // Always Select from database after Insert/Update to keep data consistant
        $get_parameter = $parameter;
        unset($get_parameter['bind_param']);

        $result = $this->get($get_parameter);
        return $result;
    }
}

?>