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
	var $error = null;

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
print_r($parameters);
echo '<br>';
foreach ($parameters as $index=>$value)
{
	$sql = str_replace($index, '\''.$value.'\'', $sql);
}
print_r($sql);
echo '<br>';
		$query->execute($parameters);
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	function get_columns()
	{
		$sql = 'DESCRIBE '.DATABASE_PREFIX.get_class($this);
		$result = $this->query($sql);
		return $result;
	}

	function get($parameters)
	{
		if (!$parameters)
		{
			$parameters = array();
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
				$parameters['columns'] = '';
			}
		}

		if (!isset($parameters['prefix']))
		{
			$parameters['prefix'] = $this->parameters['prefix'];
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
		$result = $this->query($sql,$parameters['bind_param']);
		$this->row = $result;
		return $result;
	}

	function set($parameters)
	{
		if (!$parameters)
		{
			$parameters = array();
		}

		if (!isset($parameters['prefix']))
		{
			$parameters['prefix'] = $this->parameters['prefix'];
		}

		if (!isset($parameters['primary_key']))
		{
			$parameter['primary_key'] = array('id');
		}
		
		if (empty($parameters['bind_param']))
		{
			$parameters['bind_param'] = array();
		}

		if (empty($parameters['row']))
		{
			$parameters['row'] = $this->row;
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
			}
		}

		foreach ($table_columns as $column_index=>$column_value)
		{

			$parameters['columns']
		}

		foreach ($parameters['row'] as $row_index=>$row_value)
		{
			$sql_columns = array();
			$sql_values = array();
			$bind_values = array();

			foreach ($table_columns as $column_index=>$column_value)
			{
				if(!empty($row_value[$parameters['prefix'].$column_value['Field']]))
				{
					$sql_columns[] = $column_value['Field'];
					$sql_values[] = ':'.$column_value['Field'];
					$bind_values[':'.$column_value['Field']] = $row_value[$parameters['prefix'].$column_value['Field']];
				}
				else
				{
					// Special field `update_time`
					if ($column_value['Field'] == 'update_time')
					{
						$sql_columns[] = $column_value['Field'];
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
			$result[] = $this->query($sql,$parameters['bind_param']);
		}

		return $result;

	}
}

?>