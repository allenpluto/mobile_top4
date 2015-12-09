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

    private function class_name($value)
    {
        $value = strtolower($value);
        $value = preg_replace('/[^a-z0-9]/', '_', $value);
        $value = preg_replace('/_+/', '_', $value);
        $result = trim($value,'_');

        return $result;
    }

    private function friendly_url($value)
    {
        $value = strtolower($value);
        $value = preg_replace('/[^a-z0-9]/', '-', $value);
        $value = preg_replace('/-+/', '-', $value);
        $result = trim($value,'-');

        return $result;
    }

    private function html_text_content($value)
    {
        $result = strip_tags($value, '<h2><h3><h4><h5><h6><p><ul><ol><li><a><span><strong><em>');
        return $result;
    }

    private function id_group($value)
    {
        if (empty($value))
        {
            if (is_array($value)) return array();
            else return false;
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

    private function search_term($value)
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
        // any word with less length will go into special word, too many special word will slow search down
        if (!isset($min_string_length)) $min_string_length = 3;
        if (!isset($special_pattern)) $special_pattern = '';
        if (is_array($value))
        {
            $value = implode($delimiter,$value);
        }
        $value = preg_replace('/[^'.$special_pattern.'a-zA-Z0-9\s]+/', $delimiter, $value);
        $value = explode($delimiter,$value);
        $result = array('full_text_word'=>array(),'special_word'=>array());
        foreach($value as $key=>$item)
        {
            $item = strtolower(trim($item));
            if (strlen($item) < $min_string_length)
            {
                if (strlen($item) > 0) $result['special_word'][] = $item;
            }
            else
            {
                if (!empty($special_pattern))
                {
                    if (preg_match('/['.$special_pattern.']/', $item))  $result['special_word'][] = $item;
                    else $result['full_text_word'][] = $item;
                }
                else
                {
                    $result['full_text_word'][] = $item;
                }
            }
        }
        $result['full_text_word'] = array_unique($result['full_text_word']);
        $result['special_word'] = array_unique($result['special_word']);
        return $result;
    }

    private function split_uri($value)
    {
        $value_part = explode('/',$value);
        $result = array();
        foreach($value_part as $value_part_index=>$value_part_item)
        {
            $result[] = urldecode($value_part_item);
        }
        return $result;
    }

    private function uri_decoder($value)
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
        if (!isset($parameter)) $parameter = array();

        $result = array();
        if (is_string($value))
        {
            $uri_part = $this->split_uri($value);
            $result['namespace'] = isset($uri_part[0])?$uri_part[0]:'default';
            $result['instance'] = isset($uri_part[1])?$uri_part[1]:'home';
            $sub_uri = array_slice($uri_part, 2);
        }
        else
        {
            $result['namespace'] = isset($value['namespace'])?$value['namespace']:'default';
            $result['instance'] = isset($value['instance'])?$value['instance']:'home';
            $sub_uri = isset($value['extra_parameter'])?$this->split_uri($value['extra_parameter']):array();
        }



        switch($result['namespace'])
        {
            case 'listing':
                switch($result['instance'])
                {
                    case 'find':
                        if (!empty($sub_uri[0])) $result['category'] = $sub_uri[0];
                        else return false;
                        if (!empty($sub_uri[1])) $result['state'] = $sub_uri[1];
                        if (!empty($sub_uri[2])) $result['region'] = str_replace('-',' ',$sub_uri[2]);
                        if (!empty($sub_uri[3])) $result['suburb'] = str_replace('-',' ',$sub_uri[3]);
                        break;
                    case 'search':
                        if (!empty($sub_uri[0])) $result['name_keyword'] = $sub_uri[0];
                        else return false;
                        if (isset($sub_uri[1]) AND $sub_uri[1] == 'where' AND !empty($sub_uri[2])) $result['location_keyword'] = $sub_uri[2];
                        break;
                    default:
                }
                break;
            default:
        }

        return $result;

    }
}

?>