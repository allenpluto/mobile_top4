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

    // row of values, INPUT/UPDATE data into the table and SELECT data from table
    public $row = null;

    // Object variables
    var $parameter = array();
    var $_initialized = false;

    // By default, all entities can be constructed by a number (id), an array of numbers (ids), a string of numbers separate by comma (e.g. "10,11,12") or a string of friendly url
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
print_r($sql.'<br>');
//print_r($parameter);
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

    // Select id_group by conditions
    function get($parameter = array())
    {
        // When id_group changes, reset the stored row value and rendered html
        $this->row = null;

        $parameter = array_merge($this->parameter,$parameter);

        if (count($this->id_group) > 0)
        {
            $this->_initialized = true;
        }

        if (empty($parameter['bind_param']))
        {
            $parameter['bind_param'] = array();
        }

        $sql = 'SELECT '.$parameter['primary_key'].' FROM '.$parameter['table'];
        $where = array();
        if (!empty($parameter['where']))
        {
            if (is_array($parameter['where']))
            {
                $where = $parameter['where'];
            }
            else
            {
                $where[] = $parameter['where'];
            }
        }
        if ($this->_initialized)
        {
            if (!empty($this->id_group))
            {
                $where[] = $parameter['primary_key'].' IN ('.implode(',',array_keys($this->id_group)).')';
                $parameter['bind_param'] = array_merge($parameter['bind_param'],$this->id_group);
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

        if (!empty($parameter['order']))
        {
            if (is_array($parameter['order']))
            {
                $parameter['order'] = implode(', ', $parameter['order']);
            }
            $sql .= ' ORDER BY '.$parameter['order'];
        }
        if (!empty($parameter['limit']))
        {
            $sql .= ' LIMIT '.$parameter['limit'];
        }
        if (!empty($parameter['offset']))
        {
            $sql .= ' OFFSET '.$parameter['offset'];
        }
        $query = $this->query($sql,$parameter['bind_param']);
        if ($query !== false)
        {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $new_id_group = array();
            foreach ($result as $row_index=>$row_value)
            {
                $new_id_group[] = $row_value[$parameter['primary_key']];
            }
            // Keep the original id order if no specific "order by" is set
            if ($this->_initialized AND empty($parameter['order'])) $this->id_group = array_intersect($this->id_group, $new_id_group);
            else
            {
                $format = format::get_obj();
                $new_id_group = $format->id_group($new_id_group);
                $this->id_group = $new_id_group;
            }

            $this->_initialized = true;
            return $this->id_group;
        }
        else
        {
            return false;
        }
    }

    // INSERT/UPDATE multiple rows of data, return id_group of inserted/updated rows
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
                $this->row = null;
            }
        }
        $parameter = array_merge($this->parameter,$parameter);
        $format = format::get_obj();

        if (empty($parameter['bind_param']))
        {
            $parameter['bind_param'] = array();
        }

        $id_group = array();

        $sql = 'INSERT INTO '.$parameter['table'].' (`'.implode('`,`',$parameter['table_fields']).'`) VALUES (:'.implode(',:',$parameter['table_fields']).') ON DUPLICATE KEY UPDATE ';
        $field_bind = array();
        foreach ($parameter['table_fields'] as $field_index=>$field_name)
        {
            if ($field_name != $parameter['primary_key'])
            {
                $field_bind[] = '`'.$field_name.'` = :'.$field_name;
            }
        }
        $sql .= implode(',',$field_bind);
        unset($field_bind);
        $query = $this->_conn->prepare($sql);
        foreach ($value as $index=>$row)
        {
            $bind_value = array();
            foreach ($parameter['table_fields'] as $field_index=>$field_name)
            {
                if (isset($row[$field_name]) OR isset($row[$field_index]))
                {
                    $bind_value[':'.$field_name] = isset($row[$field_name])?$row[$field_name]:$row[$field_index];
                }
            }
            $bind_value = array_merge($parameter['bind_param'],$bind_value);

            if (count($bind_value) != count($parameter['table_fields']))
            {
                $GLOBALS['global_message']->warning = __FILE__.'(line '.__LINE__.'): '.get_class($this).' INSERT/UPDATE number of tokens ('.count($parameter['table_fields']).') does not match number of bound variables('.count($bind_value).') - '.print_r($bind_value,true);
            }
            else
            {
                $query->execute($bind_value);

                if ($query->errorCode() == '00000')
                {
                    if ($query->rowCount() == 0)
                    {
                        $GLOBALS['global_message']->warning = __FILE__.'(line '.__LINE__.'): '.get_class($this).' Row '.print_r($bind_value,true).' has not been inserted or updated. All values might be same as original row.';
                    }
                    else
                    {
                        $query2 = $this->_conn->query('SELECT LAST_INSERT_ID() AS new_id;');
                        $result = $query2->fetch(PDO::FETCH_ASSOC);
                        if ($query2->errorCode() == '00000')
                        {
                            if ($result['new_id'] == 0) $id_group[] = $bind_value[':'.$parameter['primary_key']];
                            else $id_group[] = $result['new_id'];
                        }
                        else
                        {
                            $query_errorInfo = $query2->errorInfo();
                            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): SQL Error - '.$query_errorInfo[2];
                        }
                    }
                }
                else
                {
                    $query_errorInfo = $query->errorInfo();
                    $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): SQL Error - '.$query_errorInfo[2];
                }
            }
        }

        $this->id_group = $format->id_group($id_group);
        $this->_initialized = true;
        return $this->id_group;
    }

    function delete($parameter = array())
    {
        if (!$this->_initialized)
        {
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' cannot perform delete before it is initialized with get() or set() function';
            return false;
        }
        if (empty($this->id_group))
        {
            $GLOBALS['global_message']->notice = __FILE__.'(line '.__LINE__.'): '.get_class($this).' cannot perform delete with empty id_group';
            return array();
        }
        $parameter = array_merge($this->parameter,$parameter);
        $format = format::get_obj();

        if (empty($parameter['bind_param']))
        {
            $parameter['bind_param'] = array();
        }

        $sql = 'DELETE FROM '.$parameter['table'];

        $where = array();
        if (!empty($parameter['where']))
        {
            if (is_array($parameter['where']))
            {
                $where = $parameter['where'];
            }
            else
            {
                $where[] = $parameter['where'];
            }
        }
        $where[] = $parameter['primary_key'].' IN ('.implode(',',array_keys($this->id_group)).')';
        $parameter['bind_param'] = array_merge($parameter['bind_param'],$this->id_group);

        if (!empty($where))
        {
            $sql .= ' WHERE '.implode(' AND ', $where);
        }

        $query = $this->query($sql, $parameter['bind_param']);
        if ($query !== false)
        {
            if ($query->rowCount() == 0)
            {
                $GLOBALS['global_message']->notice = __FILE__.'(line '.__LINE__.'): '.get_class($this).' no row deleted under condition '.print_r($where, true);
                return false;
            }
            else
            {
                $GLOBALS['global_message']->notice = __FILE__.'(line '.__LINE__.'): '.get_class($this).' '.$query->rowCount().' row(s) deleted';
                return true;
            }
        }
        else
        {
            return false;
        }
    }

    function update($value = array(), $parameter = array())
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
                $value = $this->row[0];
                $this->row = null;
            }
        }
        if (!$this->_initialized)
        {
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' cannot perform delete before it is initialized with get() or set() function';
            return false;
        }
        if (empty($this->id_group))
        {
            $GLOBALS['global_message']->notice = __FILE__.'(line '.__LINE__.'): '.get_class($this).' cannot perform delete with empty id_group';
            return array();
        }
        $parameter = array_merge($this->parameter,$parameter);
        $format = format::get_obj();

        if (empty($parameter['bind_param']))
        {
            $parameter['bind_param'] = array();
        }

        $sql = 'UPDATE '.$parameter['table'].' SET ';
        $field_bind = array();
        foreach ($parameter['table_fields'] as $field_index=>$field_name)
        {
            if (isset($value[$field_name]))
            {
                $field_bind[] = '`'.$field_name.'` = :'.$field_name;
                $parameter['bind_param'][':'.$field_name] = $value[$field_name];
            }
        }
        $sql .= implode(',',$field_bind);
        unset($field_bind);

        $where = array();
        if (!empty($parameter['where']))
        {
            if (is_array($parameter['where']))
            {
                $where = $parameter['where'];
            }
            else
            {
                $where[] = $parameter['where'];
            }
        }
        $where[] = $parameter['primary_key'].' IN ('.implode(',',array_keys($this->id_group)).')';
        $parameter['bind_param'] = array_merge($parameter['bind_param'],$this->id_group);
        if (!empty($where))
        {
            $sql .= ' WHERE '.implode(' AND ', $where);
        }

        $query = $this->query($sql, $parameter['bind_param']);
        if ($query !== false)
        {
            if ($query->rowCount() == 0)
            {
                $GLOBALS['global_message']->notice = __FILE__.'(line '.__LINE__.'): '.get_class($this).' no row updated for '.print_r($parameter['bind_param']).' under condition '.print_r($where, true);
                return false;
            }
            else
            {
                $GLOBALS['global_message']->notice = __FILE__.'(line '.__LINE__.'): '.get_class($this).' '.$query->rowCount().' row(s) updated';
                return true;
            }
        }
        else
        {
            return false;
        }
    }

    function sync($parameter = array())
    {
        if (!isset($parameter['sync_table']))
        {
            $parameter['sync_table'] = str_replace('entity','view',$parameter['table']);
        }
        $parameter = array_merge($this->parameter,$parameter);

        if (!isset($parameter['join']))
        {
            $parameter['join'] = array();
        }

        if ($GLOBALS['db']) $db = $GLOBALS['db'];
        else $db = new db;

        if (!$db->db_table_exists($parameter['sync_table']))
        {
            $GLOBALS['global_message']->warning = __FILE__.'(line '.__LINE__.'): Create the sync target table '.$parameter['sync_table'].' first then run sync function again';
            return false;
        }

        if (!isset($parameter['sync_table_primary_key'])) {
            $result = $db->db_get_primary_key($parameter['sync_table']);
            if (empty($result[0]))
            {
                $parameter['sync_table_primary_key'] = 'id';
            }
            else
            {
                $parameter['sync_table_primary_key'] = $result[0];
            }
        }

        // id_group to delete
        $compare_result = $db->db_compare_records(array(
            'source_table'=>$parameter['table'],
            'source_primary_key'=>$parameter['primary_key'],
            'target_table'=>$parameter['sync_table'],
            'target_primary_key'=>$parameter['sync_table_primary_key']
        ));
        if ($compare_result === false) return false;
        if (count($compare_result['delete_id_group']) > 0)
        {
            $sql = 'DELETE FROM '.$parameter['sync_table'].' WHERE '.$parameter['sync_table_primary_key'].' IN ('.implode(',',$compare_result['delete_id_group']).')';
            $query = $this->query($sql);
            if ($query !== false)
            {
                if ($query->rowCount() == 0)
                {
                    $GLOBALS['global_message']->notice = __FILE__.'(line '.__LINE__.'): '.get_class($this).' on sync no row deleted';
                }
                else
                {
                    $GLOBALS['global_message']->notice = __FILE__.'(line '.__LINE__.'): '.get_class($this).' on sync '.$query->rowCount().' row(s) deleted';
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            $GLOBALS['global_message']->notice = __FILE__.'(line '.__LINE__.'): '.get_class($this).' on sync no row deleted';
        }

        $id_group = array_merge($compare_result['insert_id_group'], $compare_result['update_id_group']);
        if (count($id_group) > 0)
        {
            // Generate INSERT/UPDATE query
            if (!isset($parameter['sync_table_fields'])) {
                $result = $db->db_get_columns($parameter['sync_table']);
                if ($result === false) {
                    return false;
                } else {
                    $parameter['sync_table_fields'] = $result;
                }
            }

            if (!isset($parameter['join_query'])) $parameter['join_query'] = array();

            if (!isset($parameter['update_fields'])) $parameter['update_fields'] = array();

            $shared_table_fields = array_intersect($parameter['table_fields'], $parameter['sync_table_fields']);
            foreach ($shared_table_fields as $field_index => $field_name) {
                if (!array_key_exists($field_name, $parameter['update_fields'])) $parameter['update_fields'][$field_name] = $parameter['table'] . '.' . $field_name;
            }
            unset($shared_table_fields);

            // default table fields remove two timestamp fields, but on sync, they are required
            if (!array_key_exists('enter_time', $parameter['update_fields'])) $parameter['update_fields']['enter_time'] = $parameter['table'] . '.enter_time';
            if (!array_key_exists('update_time', $parameter['update_fields'])) $parameter['update_fields']['update_time'] = $parameter['table'] . '.update_time';

            $sql = 'INSERT INTO ' . $parameter['sync_table'] . ' (' . implode(',', array_keys($parameter['update_fields'])) . ')
SELECT ' . implode(',', $parameter['update_fields']) . ' FROM ' . $parameter['table'] . ' ' . implode(' ', $parameter['join']) . ' WHERE ' . $parameter['table'] . '.' . $parameter['primary_key'] . ' IN (' . implode(',', $id_group) . ')';
            if (!empty($parameter['where'])) $sql .= ' AND (' . implode(' AND ', $parameter['where']) . ')';
            $sql .= 'ON DUPLICATE KEY UPDATE ';
            $update_fields = array();
            foreach ($parameter['update_fields'] as $field_index => $field_name) {
                $update_fields[] = $field_index . '=VALUES(' . $field_index . ')';
            }
            $sql .= implode(',', $update_fields);
            unset($update_fields);
            $query = $this->query($sql);
            if ($query !== false) {
                if ($query->rowCount() == 0) {
                    $GLOBALS['global_message']->notice = __FILE__ . '(line ' . __LINE__ . '): ' . get_class($this) . ' on sync no row inserted/updated';
                } else {
                    $GLOBALS['global_message']->notice = __FILE__ . '(line ' . __LINE__ . '): ' . get_class($this) . ' on sync ' . $query->rowCount() . ' row(s)/field(s) inserted/updated';
                }
            } else {
                return false;
            }
        }
        return true;
    }

    function full_sync($parameter = array())
    {
        $parameter = array_merge($this->parameter,$parameter);
        $sql = 'DROP TABLE IF EXISTS '.$parameter['sync_table'].';';
        $update_fields = array();
        foreach ($parameter['update_fields'] as $field_index=>$field_value)
        {
            $update_fields[] = $field_value.' AS '.$field_index;
        }
        $sql .= 'CREATE TABLE '.$parameter['sync_table'].' SELECT '.implode(',',$update_fields).' FROM '.$parameter['table'].' '.implode(' ',$parameter['join']);
        if (!empty($parameter['where'])) $sql .= ' WHERE ('.implode(' AND ',$parameter['where']).')';
        unset($update_fields);
        $sql .= ';';
        $sql .= 'ALTER TABLE '.$parameter['sync_table'].' ENGINE = MyISAM DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;';
        $sql .= 'ALTER TABLE '.$parameter['sync_table'].' ADD PRIMARY KEY ('.$parameter['primary_key'].');';
        $sql .= 'ALTER TABLE '.$parameter['sync_table'].' MODIFY enter_time TIMESTAMP NOT NULL DEFAULT "0000-00-00 00:00:00"';
        $sql .= ', MODIFY update_time TIMESTAMP NOT NULL DEFAULT "0000-00-00 00:00:00"';
        if (isset($parameter['fulltext_key']))
        {
            foreach ($parameter['fulltext_key'] as $fulltext_index=>$fulltext_fields)
            {
                $sql .= ', ADD FULLTEXT KEY '.$fulltext_index.' ('.implode(',',$fulltext_fields).')';
            }
        }
        $sql .= ';';
        $query = $this->query($sql);
        if ($query !== false)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>