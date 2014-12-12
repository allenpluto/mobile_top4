<?php
// Class Object
// Name: thing
// Description: Base class for all database table classes

class thing
{
	// database connection
	protected $_conn = null;

	// containers value results from database
	var $row = array();
	var $message = null;

	function thing()
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
print_r($query);
echo '<br>';
print_r($this->_conn->lastInsertId());
echo '<br>';
print_r($parameters);
echo '<br>';
foreach ($parameters as $index=>$value)
{
	$sql = str_replace($index, '\''.$value.'\'', $sql);
}
print_r($sql);
echo '<br>';
		if ($query->execute($parameters))
		{
			return $query;
		}
		else
		{
			$this->message = 'SQL query failed to execute';
			return false;
		}
/*print_r($execute_result);
echo '<br>';
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;*/
	}

	function get_columns()
	{
		$sql = 'DESCRIBE '.DATABASE_PREFIX.get_class($this);
		$column_descriptions = $this->query($sql);
		$columns = array();
		foreach ($column_descriptions as $column_description_index=>$column_description_value)
		{
			$columns[] = $column_description_value['Field'];
		}
		return $columns;
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
			$parameters['primary_key'] = 'id';
		}

		// If columns set to Null or '', select everything
		if (!$parameters['columns'])
		{
			$sql_select = '*';
		}
		else
		{
			if(is_array($parameters['columns']))
			{
				$column_prefix = '';
				if (!empty($parameters['prefix']))
				{
					$column_prefix = $parameters['prefix'];
				}
				$sql_select = array();

				foreach($parameters['columns'] as $column_index=>$column_value)
				{
					$sql_select[] = $column_value.' AS `'.$column_prefix.$column_index.'`';
				}
				$sql_select = implode(', ', $sql_select);
			}
		}
		
		$sql = 'SELECT '.$sql_select.' FROM '.DATABASE_PREFIX.get_class($this);
		if (!empty($parameters['where']))
		{
			$sql .= ' WHERE '.$parameters['where'];
		}
		else
		{
			if (!empty($this->row))
			{
				$row_ids = array();
				foreach ($this->row as $row_index=>$row_value)
				{
					if (!empty($row_value[$parameters['prefix'].$parameters['primary_key']]))
					{
						$row_ids[] = $row_value[$parameters['prefix'].$parameters['primary_key']];
					}
				}
				if (!empty($row_ids))
				{
					$parameters['where'] = '`'.$parameters['primary_key'].'` IN (';
					foreach ($row_ids as $row_id_index=>$row_id_value)
					{
						if ($row_id_index > 0)
						{
							$parameters['where'] .= ',';
						}
						$parameters['where'] .= ':id_'.$row_id_index;
						$parameters['bind_param'][':id_'.$row_id_index] = $row_id_value;
					}
					$parameters['where'] .= ')'; 
					$sql .= ' WHERE '.$parameters['where'];
				}
			}
			else
			{
				$this->message = 'Error: Select without where condition.';
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
			$sql .= ' LIMIT '.DATABASE_LIMIT;
		}
		if (!empty($parameters['offset']))
		{
			$sql .= ' OFFSET '.$parameters['offset'];
		}
		$query = $this->query($sql,$parameters['bind_param']);
		if ($query !== false)
		{
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			$this->row = $result;
			return $result;
		}
		else
		{
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
		
		if (empty($parameters['row']))
		{
			$parameters['row'] = $this->row;
		}
		$this->row = array();

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
		if (!isset($parameters['columns']))
		{
			if (!empty($this->parameters['update_fields']))
			{
				$parameters['columns'] = $this->parameters['update_fields'];
			}
			else
			{
				$parameters['columns'] = array();
				foreach ($table_columns as $column_index=>$column_value)
				{
					$parameters['columns'][] = $column_value;
				}
			}
		}

		foreach ($parameters['columns'] as $column_index=>$column_value)
		{
			if (!in_array($column_value, $table_columns))
			{
				unset($parameters['columns'][$column_index]);
			}
		}

		foreach ($parameters['row'] as $row_index=>$row_value)
		{
			$sql_columns = array();
			$sql_values = array();
			$bind_values = array();

			foreach ($parameters['columns'] as $column_index=>$column_value)
			{
				if(!empty($row_value[$parameters['prefix'].$column_value]))
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

			$sql = 'INSERT INTO '.DATABASE_PREFIX.get_class($this).' (`'.implode('`, `',$sql_columns).'`) VALUES ('.implode(', ',$sql_values).') ON DUPLICATE KEY UPDATE ';

			foreach($sql_columns as $column_index=>$column_value)
			{
				if ($column_index > 0)
				{
					$sql .= ', ';
				}
				$sql .= '`'.$column_value .'` = '.$sql_values[$column_index];
			}
			
			$parameters['bind_param'] = array_merge($parameters['bind_param'], $bind_values);
			$query = $this->query($sql,$parameters['bind_param']);
			if ($query !== false)
			{
				$this->row[] = array($parameters['prefix'].$parameters['primary_key']=>$this->_conn->lastInsertId());
			}
		}

		// Always Select from database after Insert/Update to keep data consistant
		$result = $this->get();
		return $result;
	}
}

?>