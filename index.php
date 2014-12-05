<?php
	include('system/config/config.inc.php');

	$person = new person(array('id'=>1));
	echo '<pre>';
	print_r($person);
?>