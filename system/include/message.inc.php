<?php
// Include Class Object
// Name: message
// Description: use preference class to control global variables

class message
{
	private $property = array('notice'=>array(),'warning'=>array(),'error'=>array());
	private static $instance;

	private function __construct() {}

	public static function get_instance()
	{
		if (empty(self::$instance))
		{
			self::$instance = new message();
		}
		return self::$instance;
	}

    public function __set($key, $value)
    {
        switch($key)
        {
            case 'notice':
            case 'error':
            case 'warning':
                $this->property[$key][] = $value;
                break;
            default:
                $this->property['notice'][] = $value;
        }

    }

    public function __get($key) {
        switch($key)
        {
            case 'notice':
            case 'error':
            case 'warning':
                return $this->property[$key];
                break;
            default:
                return $this->property;
        }
    }
}