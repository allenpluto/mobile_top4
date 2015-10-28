<?php
// Class Object
// Name: view
// Description: Base class for all database view classes, read only, represents large number of rows (store id only to reduce php memory use)

class view
{
	// database connection
	protected $_conn = null;

	// ids of select rows
	var $id_group = array();
	
	// Object variables
	var $parameters = array();
	var $message = null;
	var $_initialized = false;

	function __construct()
	{
		$db = new db;
		$this->_conn = $db->db_get_connection();
		
		// By default, view object name as database view table name, but if certain view object does not have coorespond view table in db, table name to be overwritten, columns and primary key also need to be defined specificly
		
		// parameters['table'] in view does not necessarily mean one table, can be multiple tables with JOIN conditions, e.g. $this->parameters['table'] = 'tbl_entity_organization JOIN tbl_entity_organization parent_organization ON tbl_entity_organization.parent_organization_id = parent_organization.id'
		if (!isset($this->parameters['table']))
		{
			$this->parameters['table'] = DATABASE_TABLE_PREFIX.get_class($this);
		}
			
		// parameters['table_fields'] in view suggest the columns being selected, when multiple tables are joined, fields would probably need reference the tables they are in and might need alias, e.g. parameters['table_fields'] = 'tbl_entity_organization.id, tbl_entity_organization.name, parent_organization.id AS parent_id, parent_organization.name AS parent_name'
		if (!isset($this->parameters['table_fields']))
		{
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
		}
		
		// parameters['primary_key'] in view need to be single column field, if it is not defined, default to id
		if (!isset($this->parameters['primary_key']))
		{
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
					// Views do not necessarily have defined primary key column, assume it is 'id'
					$this->parameters['primary_key'] = 'id';				
				}
			}
		}		
	}

	function query($sql, $parameters=array())
	{

		$query = $this->_conn->prepare($sql);
		$query->execute($parameters);

		return $query;
	}

	function get($parameters = array())
	{
		if (empty($parameters['bind_param']))
		{
			$parameters['bind_param'] = array();
		}

		$sql = 'SELECT '.$this->parameters['primary_key'].' FROM '.$this->parameters['table'];
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
			if (is_array($parameters['order']))
			{
				$parameters['order'] = implode(', ', $parameters['where']);
			}
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

	function render()
	{
		if ($this->_initialized)
		{
			if (!empty($this->id_group))
			{
				$sql = 'SELECT '.implode(',',$this->parameters['table_fields']).' FROM '.$this->parameters['table'];
				$parameters['where'] = '`'.$this->parameters['primary_key'].'` IN (-1';
				$parameters['order'] = 'FIELD(`'.$this->parameters['primary_key'].'`';

				foreach ($this->id_group as $row_id_index=>$row_id_value)
				{
					$parameters['where'] .= ',:id_'.$row_id_index;
					$parameters['order'] .= ',:id_'.$row_id_index;
					$parameters['bind_param'][':id_'.$row_id_index] = $row_id_value;
				}
				$parameters['where'] .= ')'; 
				$parameters['order'] .= ')'; 
				$sql .= ' WHERE '.$parameters['where'];
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
		}
		else
		{
			
		}
	}
}

?>