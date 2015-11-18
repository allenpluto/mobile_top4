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
			$columns = array();
			foreach ($query as $column_description_index=>$column_description_value)
			{
				$columns[] = $column_description_value['Field'];
			}
			return $columns;
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
			$columns = array();
			foreach ($query as $column_description_index=>$column_description_value)
			{
				$columns[] = $column_description_value['Column_name'];
			}
			return $columns;
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