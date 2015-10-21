<?php
// Class Object
// Name: entity
// Description: Base class for all database table classes

class entity
{
	// database connection
	protected $_conn = null;

	// containers value results from database
	var $row = [];
	var $message = null;
	var $_initialized = false;

	function entity()
	{
	}

	function query($sql, $parameters=array())
	{
		if (!$this->_conn)
		{
			$db = new db;
			$this->_conn = $db->db_get_connection();
		}

		$query = $this->_conn->prepare($sql);
		$query->execute($parameters);
/*echo '<pre>';
print_r($query);
echo '<br>';
print_r($parameters);
echo '<br>';*/
		return $query;
	}

	function get_columns()
	{
		$sql = 'DESCRIBE '.DATABASE_TABLE_PREFIX.get_class($this);
		$query = $this->query($sql);
		if ($query->errorCode() == '00000')
		{
			$columns = array();
			foreach ($query as $column_description_index=>$column_description_value)
			{
				$columns[] = $column_description_value['Field'];
			}
			return $columns;
		}
		else
		{
			$this->message[] = 'SQL Error: '.$query->errorInfo()[2];
			return false;
		}
	}

	function get_primary_key()
	{
		$sql = 'SHOW INDEX FROM `'.DATABASE_TABLE_PREFIX.get_class($this).'` WHERE Key_name = "PRIMARY"';
		$query = $this->query($sql);
		$columns = array();
		foreach ($query as $column_description_index=>$column_description_value)
		{
			$columns[] = $column_description_value['Column_name'];
		}
		return $columns;
		/*if ($query->errorCode() == '00000')
		{
			$columns = array();
			foreach ($query as $column_description_index=>$column_description_value)
			{
				$columns[] = $column_description_value['Field'];
			}
			return $columns;
		}
		else
		{
			$this->message[] = 'SQL Error: '.$query->errorInfo()[2];
			return false;
		}*/
	}

	function get($parameters = array())
	{
		// If columns not set, use default
		if (!isset($parameters['columns']))
		{
			if (!empty($this->parameters['select_fields']))
			{
				$parameters['columns'] = $this->parameters['select_fields'];
			}
			else
			{
				$parameters['columns'] = '';
			}
		}

		if (!isset($parameters['prefix']))
		{
			$parameters['prefix'] = $this->parameters['prefix'];
		}

		if (empty($parameters['primary_key']))
		{			
			$parameters['primary_key'] = $this->get_primary_key();
		}

		if (empty($parameters['bind_param']))
		{
			$parameters['bind_param'] = array();
		}

		$sql = 'SELECT * FROM '.DATABASE_TABLE_PREFIX.get_class($this);
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
			if (!empty($this->row) AND count($parameters['primary_key']) == 1)
			{
				$primary_key_column = $parameters['primary_key'][0];
				$row_ids = array();
				foreach ($this->row as $row_index=>$row_value)
				{

					if (!empty($row_value[$primary_key_column]))
					{
						$row_ids[] = $row_value[$primary_key_column];
					}
				}
				if (!empty($row_ids))
				{
					$parameters['where'] = '`'.$primary_key_column.'` IN (0';
					$parameters['order'] = ' ORDER BY FIELD('.$primary_key_column.')';

					foreach ($row_ids as $row_id_index=>$row_id_value)
					{
						$parameters['where'] .= ',:id_'.$row_id_index;
						$parameters['order'] .= ',:id_'.$row_id_index;
						$parameters['bind_param'][':id_'.$row_id_index] = $row_id_value;
					}
					$parameters['where'] .= ')'; 
					$parameters['order'] .= ')'; 
					$sql .= ' WHERE '.$parameters['where'];

				}
			}
			else
			{
				$this->message[] = 'Error: Cannot retrieve records without specific conditions and primary key.';
				return false;
			}
		}
		if (!empty($parameters['order']))
		{
			$sql .= ' ORDER BY '.$parameters['order'];
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
			return $result;
		}
		else
		{
			$this->message[] = 'SQL Error: '.$query->errorInfo()[2];
			return false;
		}
	}

	function set_parameters($parameters = array())
	{
		$this->parameters = array_merge($this->parameters, $parameters);
	}

	function set($parameters = array())
	{
		if (!isset($parameters['prefix']))
		{
			$parameters['prefix'] = $this->parameters['prefix'];
		}
		
		if (!empty($parameters['row']))
		{
			$this->row = $parameters['row'];
		}

		if (empty($this->row))
		{
			$this->message[] = 'Error: Null input';
			return false;
		}

		if (empty($parameters['bind_param']))
		{
			$parameters['bind_param'] = array();
		}

		if (empty($parameters['primary_key']))
		{
			$parameters['primary_key'] = 'id';
		}

		$table_columns = $this->get_columns();
		// If columns not set, use default
		if (!isset($parameters['update_fields']))
		{
			if (!empty($this->parameters['update_fields']))
			{
				$parameters['update_fields'] = $this->parameters['update_fields'];
				// Force PK in update fields
				if (!in_array($parameters['primary_key'], $this->parameters['update_fields']))
				{
					array_unshift($this->parameters['update_fields'],$parameters['primary_key']);
				}
			}
			else
			{
				$parameters['update_fields'] = [];
				foreach ($table_columns as $column_index=>$column_value)
				{
					$parameters['update_fields'][] = $column_value;
				}
			}
		}

		foreach ($parameters['update_fields'] as $column_index=>$column_value)
		{
			if (!in_array($column_value, $table_columns))
			{
				unset($parameters['update_fields'][$column_index]);
			}
		}

		foreach ($this->row as $row_index=>$row_value)
		{
			$sql_columns = array();
			$sql_values = array();
			$bind_values = array();

			foreach ($parameters['update_fields'] as $column_index=>$column_value)
			{
				if(isset($row_value[$parameters['prefix'].$column_value]))
				{
					$sql_columns[] = $column_value;
					$sql_values[] = ':'.$column_value;
					$bind_values[':'.$column_value] = $row_value[$parameters['prefix'].$column_value];
				}
				else
				{
					// Special field `update_time`
					if ($column_value == 'update_time')
					{
						$sql_columns[] = $column_value;
						$sql_values[] = 'CURRENT_TIMESTAMP';
					}
				}
			}


			$sql = 'INSERT INTO '.DATABASE_TABLE_PREFIX.get_class($this).' (`'.implode('`, `',$sql_columns).'`) VALUES ('.implode(', ',$sql_values).') ON DUPLICATE KEY UPDATE ';
			foreach($sql_columns as $column_index=>$column_value)
			{
				if ($column_index > 0)
				{
					$sql .= ', ';
				}
				$sql .= '`'.$column_value .'` = VALUES(`'.$column_value .'`)';
			}
			
			$row_bind_values = array_merge($parameters['bind_param'], $bind_values);
			$query = $this->query($sql,$row_bind_values);
			if ($query->errorCode() == '00000')
			{
				$this->row[] = array($parameters['prefix'].$parameters['primary_key']=>$this->_conn->lastInsertId());
			}
			else
			{
				$this->message[] = 'SQL Error: '.$query->errorInfo()[2];
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