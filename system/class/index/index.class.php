<?php
// Class Object
// Name: index
// Description: Base class for all database index classes, filters and search functions, primary key might not be unique
//              due to joining multiple to multiple relationship tables

class index
{
    // database connection
    protected $_conn = null;

    // ids of select rows
    var $id_group = array();

    // Object variables
    var $parameters = array();
    var $_initialized = false;

    function __construct($value = null, $parameters = array())
    {
        if (!empty($parameters)) $this->set_parameters($parameters);

        if ($GLOBALS['db']) $db = $GLOBALS['db'];
        else $db = new db;
        $this->_conn = $db->db_get_connection();

        // By default, index object name as database index table name
        // parameters['table'] in index is normally multiple tables with JOIN conditions, e.g. $this->parameters['table'] = 'tbl_entity_organization JOIN tbl_entity_organization parent_organization ON tbl_entity_organization.parent_organization_id = parent_organization.id'
        if (!isset($this->parameters['table'])) {
            $this->parameters['table'] = DATABASE_TABLE_PREFIX . get_class($this);
        }

        // parameters['table_fields'] in index suggest the columns being selected;
        // when multiple tables are joined, fields would probably need reference the tables they are in and might need alias, e.g. parameters['table_fields'] = 'tbl_entity_organization.id, tbl_entity_organization.name, parent_organization.id AS parent_id, parent_organization.name AS parent_name'
        // index tables should only have the search related tables, e.g. date, id, value... anything that can be search criteria
        if (!isset($this->parameters['table_fields'])) {
            $result = $db->db_get_columns($this->parameters['table']);
            if ($result === false) {
                return false;
            } else {
                $this->parameters['table_fields'] = $result;
            }
        }

        // parameters['primary_key'] in index need to be single column field, if it is not defined, default to id
        if (!isset($this->parameters['primary_key'])) {
            $this->parameters['primary_key'] = 'id';
        }

        if (!is_null($value)) {
            $format = format::get_obj();
            $id_group = $format->id_group($value);
            if ($id_group === false)
            {
                $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' initialize object with invalid id(s)';
                return false;
            }
            else
            {
                $this->id_group = $id_group;
                $this->get();
            }
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
        $this->parameters = array_merge($this->parameters, $parameters);
    }

    function get($parameters = array())
    {
        $parameters = array_merge($this->parameters,$parameters);

        if (count($this->id_group) > 0)
        {
            $this->_initialized = true;
        }

        if (empty($parameters['bind_param']))
        {
            $parameters['bind_param'] = array();
        }

        $sql = 'SELECT DISTINCT '.$parameters['primary_key'].' FROM '.$parameters['table'];
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

        if (!empty($parameters['order']))
        {
            if (is_array($parameters['order']))
            {
                $parameters['order'] = implode(', ', $parameters['order']);
            }
            $sql .= ' ORDER BY '.$parameters['order'];
        }

        $result = $this->query($sql,$parameters['bind_param']);

        if ($result !== false)
        {
            $new_id_group = array();

            foreach ($result as $row_index=>$row_value)
            {
                $new_id_group[] = $row_value[$parameters['primary_key']];
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
            return $this->id_group;
        }
        else
        {
            return false;
        }
    }


}