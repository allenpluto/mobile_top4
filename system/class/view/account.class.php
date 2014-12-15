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
				'image_id' => 'image_id',
				'enter_time' => 'enter_time',
				'update_time' => 'update_time',
				'address_id' => 'address_id',
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
			foreach ($this->person->row as $row_index => $row_value)
			{
				if ($row_value['account_image_id'] > 0)
				{
					$image_object = new image_object(array('id'=>$row_value['account_image_id']));
					$this->row['account_image'] = $image_object->row;
				}
			}
		}
	}
}

?>