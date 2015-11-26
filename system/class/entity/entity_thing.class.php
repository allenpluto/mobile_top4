<?php
// Class Object
// Name: entity_thing
// Description: Base class for all database table classes, read/write limited rows per query (PHP memory limit and system performance)

class entity_thing
{
	// database connection
	protected $_conn = null;
    protected $parent = null;

	// containers value results from database
	public $row = array();
	
	// Object variables
	var $parameter = array();
	var $message = null;
	var $_initialized = false;
	var $default_value = array(
		'update_time'=>'CURRENT_TIMESTAMP',
		'enter_time'=>'CURRENT_TIMESTAMP'
	);

	function __construct()
	{
        if (get_parent_class($this) !== False)
        {
            $parent_class = get_parent_class($this);
            $this->parent = new $parent_class;
            $this->parent->set_parameter($this->parameter);
        }

        if ($GLOBALS['db']) $db = $GLOBALS['db'];
        else $db = new db;
		$this->_conn = $db->db_get_connection();

		$this->parameter['table'] = DATABASE_TABLE_PREFIX.get_class($this);
		$result = $db->db_get_columns($this->parameter['table']);
		if ($result === false)
		{
			$this->message = $db->message;
			return false;			
		}
		else
		{
			$this->parameter['table_fields'] = $result;
		}
		$result = $db->db_get_primary_key($this->parameter['table']);
		if ($result === false)
		{
			$this->message = $this->_conn->message;
			return false;			
		}
		else
		{
			if (count($result) == 1)
			{
				$this->parameter['primary_key'] = $result[0];
			}
			else
			{
				// Construction Fail, if the table does not have one and only one PK, it is not a typical entity table
				$this->message[] = 'Object Initialize Error: This table has none or multiple primary key. It is not a standard entity table.';
				return false;
			}
		}
	}

    function set_parameter($parameter = array())
    {
        $this->parameter = array_merge($this->parameter, $parameter);
    }

	protected function query($sql, $parameter=array())
	{

		$query = $this->_conn->prepare($sql);
		$query->execute($parameter);

		return $query;
	}

	function get($parameter = array())
	{
		if (count($this->row) > 0)
		{
			$this->_initialized = true;		// In case initialize process is done out of class functions
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

	function set($parameter = array())
	{
		if (!empty($parameter['row']))
		{
			$this->row = $parameter['row'];
			unset($parameter['row']);
		}

		if (empty($this->row))
		{
			$this->message[] = 'Error: Null input';
			return false;
		}
		
		$get_parameter = $parameter;
		
		$parameter = array_merge($parameter, $this->parameter);

		if (empty($parameter['bind_param']))
		{
			$parameter['bind_param'] = array();
		}


		// If columns not set, use default
		if (!isset($parameter['insert_fields']))
		{
			if (!empty($this->parameter['insert_fields']))
			{
				$parameter['insert_fields'] = array_unique(array_merge($parameter['primary_key'],$this->parameter['insert_fields']));
			}
			else
			{
				$parameter['insert_fields'] = array();
				foreach ($this->parameter['table_fields'] as $column_index=>$column_value)
				{
					$parameter['insert_fields'][] = $column_value;
				}
			}
		}
		if (!isset($parameter['update_fields']))
		{
			if (!empty($this->parameter['update_fields']))
			{
				$parameter['update_fields'] = $this->parameter['update_fields'];
			}
			else
			{
				$parameter['update_fields'] = array();
				foreach ($this->parameter['table_fields'] as $column_index=>$column_value)
				{
					if ($column_value != $parameter['primary_key'] AND $column_value != 'enter_date')
					{
						$parameter['update_fields'][] = $column_value;
					}
				}
			}
		}

		foreach ($parameter['insert_fields'] as $column_index=>$column_value)
		{
			if (!in_array($column_value, $this->parameter['table_fields']))
			{
				unset($parameter['insert_fields'][$column_index]);
			}
		}
		foreach ($parameter['update_fields'] as $column_index=>$column_value)
		{
			if (!in_array($column_value, $this->parameter['table_fields']))
			{
				unset($parameter['update_fields'][$column_index]);
			}
		}

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