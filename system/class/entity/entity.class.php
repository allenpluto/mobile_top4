<?php
// Class Object
// Name: entity
// Description: Base class for all database table classes, read/write limited rows per query (PHP memory limit and system performance)

class entity
{
	// database connection
	protected $_conn = null;

	// containers value results from database
	var $row = array();
	
	// Object variables
	var $parameters = array();
	var $message = null;
	var $_initialized = false;
	var $default_value = array(
		'update_time'=>'CURRENT_TIMESTAMP',
		'enter_time'=>'CURRENT_TIMESTAMP'
	);

	function __construct()
	{
		$db = new db;
		$this->_conn = $db->db_get_connection();

		$this->parameters['table'] = DATABASE_TABLE_PREFIX.get_class($this);
		$result = $db->db_get_columns($this->parameters['table']);
		if ($result === false)
		{
			$this->message = $db->message;
			return false;			
		}
		else
		{
			$this->parameters['table_fields'] = $result;
		}
		$result = $db->db_get_primary_key($this->parameters['table']);
		if ($result === false)
		{
			$this->message = $this->_conn->message;
			return false;			
		}
		else
		{
			if (count($result) == 1)
			{
				$this->parameters['primary_key'] = $result[0];
			}
			else
			{
				// Construction Fail, if the table does not have one and only one PK, it is not a typical entity table
				$this->message[] = 'Object Initialize Error: This table has none or multiple primary key. It is not a standard entity table.';
				return false;
			}
		}
	}

	function query($sql, $parameters=array())
	{

		$query = $this->_conn->prepare($sql);
		$query->execute($parameters);
/*echo '<pre>';
print_r($query);
echo '<br>';
print_r($parameters);
echo '<br>';*/
		return $query;
	}

	function get($parameters = array())
	{
		if (count($this->row) > 0)
		{
			$this->_initialized = true;		// In case initialize process is done out of class functions
		}
		
		// If columns not set, use default
		if (!isset($parameters['columns']))
		{
			if (!empty($this->parameters['select_fields']))
			{
				$parameters['columns'] = $this->parameters['select_fields'];
			}
			else
			{
				$parameters['columns'] = array('*');
			}
		}

		if (empty($parameters['bind_param']))
		{
			$parameters['bind_param'] = array();
		}

		$sql = 'SELECT '.implode(',',$parameters['columns']).' FROM '.DATABASE_TABLE_PREFIX.get_class($this);
		if (!empty($parameters['where']))
		{
			if (is_array($parameters['where']))
			{
				$parameters['where'] = implode(' AND ', $parameters['where']);
			}
			$sql .= ' WHERE '.$parameters['where'];
		}
		else
		{
			if ($this->_initialized)
			{
				$row_ids = array();
				foreach ($this->row as $row_index=>$row_value)
				{

					if (!empty($row_value[$this->parameters['primary_key']]))
					{
						$row_ids[] = $row_value[$this->parameters['primary_key']];
					}
				}
				if (!empty($row_ids))
				{
					$where = '`'.$this->parameters['primary_key'].'` IN (-1';

					foreach ($row_ids as $row_id_index=>$row_id_value)
					{
						$where .= ',:id_'.$row_id_index;
						$parameters['bind_param'][':id_'.$row_id_index] = $row_id_value;
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
		if (!empty($parameters['order']))
		{
			$sql .= ' ORDER BY '.$parameters['order'];
		}
		else
		{
			if ($this->_initialized)
			{
				$row_ids = array();
				foreach ($this->row as $row_index=>$row_value)
				{

					if (!empty($row_value[$this->parameters['primary_key']]))
					{
						$row_ids[] = $row_value[$this->parameters['primary_key']];
					}
				}
				if (!empty($row_ids))
				{
					$order = 'FIELD(`'.$this->parameters['primary_key'].'`';

					foreach ($row_ids as $row_id_index=>$row_id_value)
					{
						$order .= ',:id_'.$row_id_index;
						$parameters['bind_param'][':id_'.$row_id_index] = $row_id_value;
					}
					$order .= ')'; 
					$sql .= ' ORDER BY '.$order;
				}
			}
		}
		if (!empty($parameters['limit']))
		{
			$sql .= ' LIMIT '.$parameters['limit'];
		}
		else
		{
			$sql .= ' LIMIT '.DATABASE_ROW_LIMIT;
		}
		if (!empty($parameters['offset']))
		{
			$sql .= ' OFFSET '.$parameters['offset'];
		}
		$query = $this->query($sql,$parameters['bind_param']);
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

	function set_parameters($parameters = array())
	{
		$this->parameters = array_merge($this->parameters, $parameters);
	}

	function set($parameters = array())
	{
		if (!empty($parameters['row']))
		{
			$this->row = $parameters['row'];
			unset($parameters['row']);
		}

		if (empty($this->row))
		{
			$this->message[] = 'Error: Null input';
			return false;
		}
		
		$get_parameters = $parameters;
		
		$parameters = array_merge($parameters, $this->parameters);

		if (empty($parameters['bind_param']))
		{
			$parameters['bind_param'] = array();
		}


		// If columns not set, use default
		if (!isset($parameters['insert_fields']))
		{
			if (!empty($this->parameters['insert_fields']))
			{
				$parameters['insert_fields'] = array_unique(array_merge($parameters['primary_key'],$this->parameters['insert_fields']));
			}
			else
			{
				$parameters['insert_fields'] = array();
				foreach ($this->parameters['table_fields'] as $column_index=>$column_value)
				{
					$parameters['insert_fields'][] = $column_value;
				}
			}
		}
		if (!isset($parameters['update_fields']))
		{
			if (!empty($this->parameters['update_fields']))
			{
				$parameters['update_fields'] = $this->parameters['update_fields'];
			}
			else
			{
				$parameters['update_fields'] = array();
				foreach ($this->parameters['table_fields'] as $column_index=>$column_value)
				{
					if ($column_value != $parameters['primary_key'] AND $column_value != 'enter_date')
					{
						$parameters['update_fields'][] = $column_value;
					}
				}
			}
		}

		foreach ($parameters['insert_fields'] as $column_index=>$column_value)
		{
			if (!in_array($column_value, $this->parameters['table_fields']))
			{
				unset($parameters['insert_fields'][$column_index]);
			}
		}
		foreach ($parameters['update_fields'] as $column_index=>$column_value)
		{
			if (!in_array($column_value, $this->parameters['table_fields']))
			{
				unset($parameters['update_fields'][$column_index]);
			}
		}

		foreach ($this->row as $row_index=>$row_value)
		{
			$sql_columns = array();
			$sql_values = array();
			$bind_values = array();
			
			// Bind values for all insert and update fields
			$sql_columns = array_unique(array_merge($parameters['insert_fields'],$parameters['update_fields']));

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
			foreach($parameters['insert_fields'] as $column_index=>$column_value)
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
			foreach($parameters['insert_fields'] as $column_index=>$column_value)
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
			foreach($parameters['update_fields'] as $column_index=>$column_value)
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

			$row_bind_values = array_merge($parameters['bind_param'], $bind_values);
			$query = $this->query($sql,$row_bind_values);
			if ($query->errorCode() == '00000')
			{
				$this->row[$row_index][$this->parameters['primary_key']] = $this->_conn->lastInsertId();
			}
			else
			{
				$query_errorInfo = $query->errorInfo();
				$this->message[] = 'SQL Error: '.$query_errorInfo[2];
				return false;
			}
		}

		// Always Select from database after Insert/Update to keep data consistant
		$get_parameters = $parameters;
		unset($get_parameters['bind_param']);

		$result = $this->get($get_parameters);
		return $result;
	}
}

?>