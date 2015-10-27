<?php
// Class Object
// Name: entity_organization
// Description: organization, business, company table, which stores all company (or organziaton) reltated information

class entity_organization extends entity
{
	// class organziaton is allowed to be constructed by 'friendly_url' or 'id'. However, if both provided, 'id' overwrite 'friendly_url'. e.g. $organization_obj = new organization('example-friendly-url-345')
	// use other functions to select a group of people
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
				$this->row = $init_value;
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

	function get($parameters = array())
	{
		$get_parameters = array('bind_param'=>array());

		if (is_array($parameters)) $parameters = array_merge($this->parameters, $parameters);
		else $parameters = $this->parameters;

		if (!empty($parameters))
		{
			foreach ($parameters as $parameter_index => $parameter_value)
			{
				switch ($parameter_index)
				{
					case 'friendly_url':
						$get_parameters['where'][] = '`friendly_url` = :friendly_url';
						$get_parameters['bind_param'][':friendly_url'] = $parameter_value;
						break;
					case 'id':
						$get_parameters['where'][] = '`id` = :id';
						$get_parameters['bind_param'][':id'] = $parameter_value;
						break;
					case 'order_by':
						$get_parameters['order_by'] = $parameter_value;
						break;
					case 'limit':
						$get_parameters['limit'] = ':limit';
						$get_parameters['bind_param'][':limit'] = $parameter_value;
						break;
					case 'offset':
						$get_parameters['offset'] = ':offset';
						$get_parameters['bind_param'][':offset'] = $parameter_value;
						break;
					default:
						break;
				}
			}
		}

		// Call thing::get function
		parent::get($get_parameters);

		// Additional data format change code here
	}

	function set($parameters = array())
	{
		// Call thing::set function
		parent::set($parameters);
	}
}

?>