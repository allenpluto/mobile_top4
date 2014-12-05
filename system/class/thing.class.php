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

	function select($parameters)
	{
		$bind_parameters = array();

		if (!$parameters)
		{
			$parameters = array();
		}

		if (!$parameters['columns'])
		{
			$sql_select = '*';
		}
		else
		{
			if(is_array($parameters['columns']))
			{
				if($parameters['prefix'])
				{
					$sql_select = array();

					foreach($parameters['columns'] as $column_index=>$column)
					{
						$sql_select[] = $column.' AS '.$parameters['prefix'].$column;
					}
					$sql_select = implode(', ', $sql_select);
				}
				else
				{
					$sql_select = implode(', ',$parameters['columns']);
				}
			}
		}
		$sql = 'SELECT '.$sql_select.' FROM '.DATABASE_PREFIX.$parameters['table'];
		if ($parameters['where'])
		{
			$sql .= ' WHERE '.$parameters['where'];
		}
		if ($parameters['order'])
		{
			$sql .= ' ORDER BY '.$parameters['order'];
		}
		if ($parameters['limit'])
		{
			$sql .= ' LIMIT '.$parameters['limit'];
		}
		else
		{
			$sql .= ' LIMIT '.DATABASE_LIMIT;
		}
		if ($parameters['offset'])
		{
			$sql .= ' OFFSET '.$parameters['offset'];
		}
		$result = $this->query($sql,$parameters['bind_param']);
		$this->row = $result;
		return $result;
	}

	function insert($parameters = array())
	{
		$bind_parameters = array();

		if (!$parameters['insert_columns'])
		{
			return false;
		}
		else
		{
		}
	}
}

?>