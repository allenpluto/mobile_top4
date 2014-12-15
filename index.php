<?php
	include('system/config/config.inc.php');

	//$person_obj = new person(array('prefix'=>'','select_fields'=>array('First Name' => 'given_name','Last Name'=>'family_name'),'get'=>array('id'=>1)));
	//$person_obj = new person(array('get'=>array('id'=>1)));
	$person_obj = new person();
	for($i=1;$i<6;$i++)
	{
		$person_obj->row[] = array(
			'person_id' => $i,
			'person_friendly_url' => 'allen-woo-'.$i,
			'person_name' => 'Allen Woo '.$i,
			'person_alternate_name' => 'Allen Alt',
			'person_description' => 'some test',
			'person_image' => -1,
			'person_address' => -1,
			'person_birth_date' => '80-12-0'.$i,
			'person_email' => 'allen@twmg.com.au',
			'person_family_name' => 'Wu',
			'person_given_name' => 'Daixi',
			'person_full_name' => 'Daixi Full Wu',
			'person_gender' => 'Male'
		);
	}
	$set_result = $person_obj->set(array(
		'update_columns' => array(
			'id' => -1,
			'friendly_url' => '',
			'name' => '',
			'description' => '',
			'family_name' => '',
			'given_name' => '',
			'gender' => 'Unspecified'
		)
	));

	echo '<pre>';
	print_r($person_obj);
	print_r($set_result);

	/*$account_obj = new account(array('id'=>1));

	echo '<pre>';
	print_r($account_obj);*/
?>