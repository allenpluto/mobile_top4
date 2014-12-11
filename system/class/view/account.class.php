<?php
// Class Object
// Name: account
// Description: person, account table, which stores all user reltated information

class account
{
	private $person = null;
	var $row = null;

	function account($parameters = array())
	{
		$this->person = new person();
		$this->person->set_parameters(array(
			'prefix' => 'account_',
			'select_fields' => array(
				'id' => 'id',
				'friendly_url' => 'friendly_url',
				'image' => 'image',
				'enter_time' => 'enter_time',
				'update_time' => 'update_time',
				'address' => 'address',
				'birth_date' => 'birth_date',
				'email' => 'email',
				'family_name' => 'family_name',
				'middle_name' => 'additional_name',
				'given_name' => 'given_name',
				'full_name' => 'CONCAT(given_name,\' \',additional_name,\' \',family_name)',
				'gender' => 'gender'
			)
		));

		if (!empty($parameters))
		{
			$this->person->get($parameters);
			$this->row = $this->person->row;
		}
	}
}

?>