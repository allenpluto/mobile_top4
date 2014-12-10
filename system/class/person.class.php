<?php
// Class Object
// Name: person
// Description: person, account table, which stores all user reltated information

class person extends thing
{
	var $parameters = array(
		'prefix' => 'person_',
		'select_fields' => array(
			'id' => 'id',
			'friendly_url' => 'friendly_url',
			'name' => 'name',
			'alternate_name' => 'alternate_name',
			'description' => 'description',
			'image' => 'image',
			'enter_time' => 'enter_time',
			'update_time' => 'update_time',
			'address' => 'address',
			'birth_date' => 'birth_date',
			'email' => 'email',
			'family_name' => 'family_name',
			'additional_name' => 'additional_name',
			'given_name' => 'given_name',
			'full_name' => 'CONCAT(given_name,\' \',additional_name,\' \',family_name)',
			'gender' => 'gender'
		)
	);

	// class person is allowed to be constructed by 'friendly_url' or 'id'. However, if both provided, 'id' overwrite 'friendly_url'. e.g. $person_obj = new person(array('prefix'=>'','select_fields'=>array('First Name' => 'given_name','Last Name'=>'family_name'),'get'=>array('id'=>1)))
	// use other functions to select a group of people
	function person($parameters = array())
	{
		if (is_array($parameters))
		{
			$get_parameters = Null;
			if (!empty($parameters['get']))
			{
				$get_parameters = $parameters['get'];
				unset($parameters['get']);
			}

			$this->setParameters($parameters);
			
			if ($get_parameters)
			{
				$this->get($get_parameters);
			}
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

		return $this;
	}

	function setParameters($parameters)
	{
		if(!is_array($parameters))
		{
			$parameters = array();
		}
		$this->parameters = array_merge($this->parameters, $parameters);
	}

	function get($parameters = array())
	{
		$get_parameters = array('bind_param'=>array());

		if (is_array($parameters))
		{
			foreach ($parameters as $parameter_index => $parameter_value)
			{
				switch ($parameter_index)
				{
					case 'friendly_url':
						$get_parameters['where'] = '`friendly_url` = :friendly_url';
						$get_parameters['bind_param'][':friendly_url'] = $parameter_value;
						break;
					case 'id':
						$get_parameters['where'] = '`id` = :id';
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
		if (empty($parameters['row']) and empty($this->row))
		{
			$this->error = 'Null Value Error';
			return false;
		}

		// Call thing::set function
		parent::set($parameters);
	}
}

?>