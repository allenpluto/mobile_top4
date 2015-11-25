<?php
// Include Class Object
// Name: format
// Description: format functions

// Format Related Functions


class format
{
    private $previous_call = array();
    private static $_obj = null;

    private function __construct() {}

    public static function get_obj()
    {
        if (empty(self::$_obj))
        {
            self::$_obj = new format();
        }
        return self::$_obj;
    }

    public function __call($method, $value = array())
    {
        if (!method_exists(self::$_obj, $method)) {
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' class method "'.$method.'" does not exist';
            return false;
        }
        else
        {
            $result = call_user_func_array(array(self::$_obj, $method), $value);
            $previous_call[] = array(
                'method' => $method,
                'value' => $value,
                'result' => $result
            );
            return $result;
        }
    }

    private function friendly_url($value)
    {
        $value = strtolower($value);
        $value = preg_replace('/[^a-z0-9]/', '-', $value);
        $value = preg_replace('/-+/', '-', $value);
        $result = trim($value,'-');

        return $result;
    }

    private function id_group($value)
    {
        if (empty($value))
        {
            return false;
        }

        if (is_array($value))
        {
            if (!empty($value['value']))
            {
                extract($value);
            }
        }

        if (!is_array($value))
        {
            $value = explode(',',$value);
        }
        $counter = 0;
        if (!isset($key_prefix))
        {
            $key_prefix = ':id_';
        }
        $result = array();
        foreach ($value as $id_index=>$id_value)
        {
            if (is_numeric($id_value))
            {
                $id_value = intval($id_value);
                if ($id_value > 0)
                {
                    $result[$key_prefix.$counter] = $id_value;
                    $counter++;
                }
            }
        }

        if ($counter > 0)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    private function instance_text($value)
    {
        $value = strtolower($value);
        $value = preg_replace('/[^-_a-z0-9]/', '', $value);

        return $value;
    }

    private function  search_term($value)
    {
        if (empty($value))
        {
            return false;
        }
        if (is_array($value))
        {
            if (!empty($value['value']))
            {
                extract($value);
            }
        }
        if (!isset($delimiter)) $delimiter = ' ';
        // Make sure min_string_length is greater or equal to db/solr full text search min characters
        if (!isset($min_string_length)) $min_string_length = 3;
        if (is_array($value))
        {
            $value = implode($delimiter,$value);
        }
        $value = preg_replace('/[^a-zA-Z0-9\s]+/', $delimiter, $value);
        $value = explode($delimiter,$value);
        $result = array();
        foreach($value as $key=>$item)
        {
            $item = strtolower(trim($item));
            if (strlen($item) >= $min_string_length)
            {
                $result[] = $item;
            }
        }
        return $result;
    }
}

?>