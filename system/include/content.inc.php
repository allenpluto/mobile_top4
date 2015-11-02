<?php
// Include Class Object
// Name: content
// Description: web page content functions

// Render template, create html page view...

class content {
    function __construct()
    {
        if ($GLOBALS['db']) $db = $GLOBALS['db'];
        else $db = new db;
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

}