<?php
// Class Object
// Name: view_organization
// Description: Base class for all database view classes, read only, represents large number of rows (store id only to reduce php memory use)

class view_organization extends view
{
	function __construct($init_value = Null, $parameters = array())
	{	
		parent::__construct();
		if (!empty($parameters))
		{
			$this->set_parameters($parameters);
		}
		if (!is_null($init_value))
		{
			if (is_array($init_value))
			{
				$this->id_group = $init_value;
				$this->get();
			}
			else	// Simplified usage, not secured
			{
				if (is_numeric($parameters)) // try to initialize with id
				{
					$this->get(array('id'=>$parameters));
				}
				else // try to initialize with friendly url
				{
					$this->get(array('friendly_url'=>$parameters));
				}
			}
		}

		return $this;
	}
	
	function get($parameter = array())
	{
		parent::get($parameter);
	}
	
}
	
?>