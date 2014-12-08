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
		$query->execute($parameters);
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
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
			$parameters['columns'] = $this->parameters['select_fields'];
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
					$sql_select[] = $column_value.' AS '.$column_prefix.$column_index;
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

		if (!empty($parameters['columns']))
		{
			$insert_columns = array();
			$insert_default_values = array();
			$update_columns = array();
			$update_default_values = array();
			foreach($parameters['columns'] as $fields_index=>$fields_value)
			{
				$insert_columns[] = $fields_index;
				$insert_default_values[] = $fields_value;
				$update_columns[] = $fields_index;
				$update_default_values[] = $fields_value;
			}
			$insert_columns = $parameters['columns'];
			$parameters['update_columns'] = $parameters['columns'];
		}
		else
		{
			$insert_columns = array();
			$insert_default_values = array();
			foreach($this->parameters['insert_fields'] as $insert_fields_index=>$insert_fields_value)
			{
				$insert_columns[] = $fields_index;
				$insert_default_values[] = $fields_value;
			}

			$update_columns = array();
			$update_default_values = array();
			foreach($this->parameters['update_fields'] as $update_fields_index=>$update_fields_value)
			{
				$update_columns[] = $fields_index;
				$update_default_values[] = $fields_value;
			}
		}

		if (!is_array($parameters['primary_key']))
		{
			$parameter['primary_key'] = array('id');
		}

		$primary_key_sets = array();
		foreach($parameters['primary_key'] as $primary_key_index=>$primary_key_value)
		{
			$primary_key_sets[] = $primary_key_value.' = :'.$primary_key_value;
		}
		$primary_key_sets = implode(' AND ', $primary_key_sets);

		foreach ($this->row as $row_index=>$row_value)
		{
			$primary_key_provided = true;

			foreach ($parameter['primary_key'] as $primary_key_index=>$primary_key_value)
			{
				if (empty($row_value[$primary_key_value]))
				{
					$primary_key_provided = false;
					break;
				}
			}

			$row_insert_value = array_merge($insert_default_values,$row_value);

			if ($primary_key_provided)
			{
				$sql = 'INSERT INTO '.DATABASE_PREFIX.get_class($this).' ('.implode(', ',$insert_columns).') VALUES ('.$row_insert_value.') ON DUPLICATE KEY UPDATE ';

				/*foreach($update_columns as $update_column_index=>$update_column_value)
				{
					$sql .= $update_columns_value .' = :'$update_columns_value;
				}*/

			}

		}

	}
}

?>