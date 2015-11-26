<?php
// Include Class Object
// Name: db
// Description: database functions

// Database Related Functions


class db
{
	private static $_conn = null;

	function db_get_connection()
	{
		if (!self::$_conn)
		{
			$dbLocation = 'mysql:dbname='.DATABASE_NAME.';host='.DATABASE_HOST;
			$dbUser = DATABASE_USER;
			$dbPass = DATABASE_PASSWORD;
			$db = new PDO($dbLocation, $dbUser, $dbPass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'utf8\''));

			self::$_conn = $db;
		}

		return self::$_conn;
	}

	function db_get_columns($table)
	{
		$table = str_replace("'","\'", $table);
		$sql = 'DESCRIBE '.$table;
		$query = self::$_conn->query($sql);

		if (self::$_conn->errorCode() == '00000')
		{
			$column = array();
			foreach ($query as $column_description_index=>$column_description_value)
			{
				$column[] = $column_description_value['Field'];
			}
			return $column;
		}
		else
		{
			$query_errorInfo = self::$_conn->errorInfo();
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): SQL Error - '.$query_errorInfo[2];
			return false;
		}		
	}

	function db_get_primary_key($table)
	{
		$table = str_replace("'","\'", $table);
		$sql = 'SHOW INDEX FROM `'.$table.'` WHERE Key_name = "PRIMARY"';
		$query = self::$_conn->query($sql);

		if (self::$_conn->errorCode() == '00000')
		{
			$column = array();
			foreach ($query as $column_description_index=>$column_description_value)
			{
				$column[] = $column_description_value['Column_name'];
			}
			return $column;
		}
		else
		{
			$query_errorInfo = self::$_conn->errorInfo();
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): SQL Error - '.$query_errorInfo[2];
			return false;
		}		
	}

    function db_get_fulltext_index($table)
    {
        $table = str_replace("'","\'", $table);
        $sql = 'SHOW INDEX FROM `'.$table.'` WHERE index_type = "FullTEXT"';
        $query = self::$_conn->query($sql);

        if (self::$_conn->errorCode() == '00000')
        {
            $column = array();
            foreach ($query as $column_description_index=>$column_description_value)
            {
                if (!isset($column[$column_description_value['Key_name']])) $column[$column_description_value['Key_name']] = array('Seq_in_index'=>array(),'Column_name'=>array());
                $column[$column_description_value['Key_name']]['Seq_in_index'][] = $column_description_value['Seq_in_index'];
                $column[$column_description_value['Key_name']]['Column_name'][] = $column_description_value['Column_name'];
            }
            $result = array();
            foreach ($column as $key_name=>$row)
            {
                array_multisort($row['Seq_in_index'], SORT_NUMERIC, SORT_ASC, $row['Column_name']);
                $result[$key_name] = $row['Column_name'];
            }
            return $result;
        }
        else
        {
            $query_errorInfo = self::$_conn->errorInfo();
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): SQL Error - '.$query_errorInfo[2];
            return false;
        }
    }
}
?>