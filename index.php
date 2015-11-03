<?php
	include('system/config/config.php');
$test_page_value = [
    'title'=>'Twmg Title',
    'meta_description'=>'abc 123, twmg has some tests on top4'
];

$format = new format();
$test_content = $format->apply_template($test_page_value,PATH_TEMPLATE.'master.tpl.php');
print_r($test_content);
	echo '<pre>';

	//$person_obj = new entity_person(array('prefix'=>'','select_fields'=>array('id','First Name' => 'given_name','Last Name'=>'family_name'),'get'=>array('id'=>1)));
	//$person_obj = new entity_person(array('get'=>array('id'=>1)));
/*$person_obj = new entity_person();
print_r($person_obj);
for($i=3;$i<9;$i++)
{
    $person_obj->row[] = array(
        'id' => $i
    );
    $person_obj->_initialized = true;
}
print_r($person_obj);
$result = $person_obj->get;
/*for($i=1;$i<8;$i++)
{
    $person_obj->row[] = array(
        'id' => $i,
    );
}
$result = $person_obj->get();*/



	//print_r($person_obj);

/*$test_ids = array();
for($i=3;$i<33;$i++)
{
    $test_ids[] = $i*3+1;
}
$view_business_summary_obj = new view_business_summary($test_ids);
shuffle($view_business_summary_obj->id_group);
print_r($view_business_summary_obj);
print_r($view_business_summary_obj->render(array('page_number'=>2)));
$view_business_summary_obj->get(array('where'=>array('id > :id'),'bind_param'=>array(':id'=>77)));
print_r($view_business_summary_obj);
print_r($view_business_summary_obj->render(array('page_number'=>1)));

/*$accounobj = new account(array('id'=>1));

echo '<pre>';
print_r($account_obj);*/

	/*$image_data = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAA0JCgsKCA0LCgsODg0PEyAVExISEyccHhcgLikxMC4pLSwzOko+MzZGNywtQFdBRkxOUlNSMj5aYVpQYEpRUk//2wBDAQ4ODhMREyYVFSZPNS01T09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT0//wAARCADpARgDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD06iiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKiuXMdvI46hSRSbsBFcX9tbHEsnPoOabDqdpM21ZMH/AGhisKyt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fWnyI6NhxzTdPbyIQp+8eT9avl0lXDDNeDiFCrNuI9GUAMkAVtxTSrNFb/3Vyx9ayHiaNsryBzVuC+G7Mq4Y8bhWNF8js9Bx0NnfTHlCqSTwKqfaU27twxVOSSa9JSIEIoyTXZKrbYpyJ4c6hfj/AJ5R8/WtysLQhi4fHTFbtVhneHM92OG1woooroLCiiigAooooAKKKKAOb8R6VNJMt7aAl1+8B1+tZUl5qNyqxyQMXHG7Zg13NFa+0TjyyVyHC5xUejajMm94yB6EipI7KS3PMLE+uM12NFY1eaorJ2XkL2aOXRpiceU/5VYis7yXgJ5anua6CiudYddWCp+Zn2+lxRgmb96x9elcXrWnPpV+VAPkSHKH09q9EqpqVhDqNo0Ew6/dPdT612UJKk9NhygmrHn0cmKtxy1TvrO40y6Nvcrx/A/ZhSJJivR0kro5dYuzNZJferCTe9ZCS1Os1Q4lqRqrL708S+9ZizVIJveo5SuY0PN96aZao+d70hm96OUOYsZRXLqAGPU0x5feqzTVC83HWqURXHNw5d2ye3tWloGn/brj7VOv7mP7oP8AEapaXp82q3AwCtsp+d/X2FdvBDHbwrFEu1FGAKyrVLLlRdOPVmZdaKrktbttP909KzpLO7gPMZI9RzXUUV5ksNB6rQt00zlQ044MT/8AfJpwtp5z8kDZ/KuooqPqqe7F7PzObk0y7RM7MjuAaFF6U8hEZVPBAHX8a6Sij6pFbNofIinptn9kh+b77cmrlFFdMYqKsikrBRRRVDCiiigAooooAKKKKACiiigAooooAKKKKACiiigCrf2FvqFuYblAy9j3BriNU0C901y8StPb9mUcr9a9BpCARgjIrSnVlDYmUFLc8sjmDfdNTLJXbaj4c0++yxj8qQ/xpwawLjwjfREm2uElXsG4Ndca8Jb6GDpNbGYJqcJvenyaLq8Od9oT/usDUf8AZupf8+clac0H1I5ZDvOpDN71NFoWrzfdtQo9WYVo2vhG4cg3lyqr3VBzUupBdSlCTMQz5YKuWY9AOprZ0rw7cXbLLfgxQ9fL7t9a6Ow0axsB+5hBfu7ck1oVzzxF9ImsaSW5HBBHbxLFCgRFGABUlFFcxqFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAf/2Q==';

	$image_object_obj = new image_object();

	$row = array();

	for($i=1;$i<4;$i++)
	{
		$row[] = array(
			'image_id' => $i,
			'image_friendly_url' => 'some-friendly-url-'.$i,
			'image_name' => 'Image '.$i,
			'image_alternate_name' => 'Photo',
			'image_description' => 'some test image',
			'image_image_id' => -1,
			'image_caption' => 'Test Photo '.$i,
			'image_exifData' => '',
			'image_width' => '280',
			'image_height' => '233',
			'image_source_data' => $image_data,
			'image_start_x' => '0',
			'image_start_y' => '0',
			'image_end_x' => '280',
			'image_end_y' => '233'
		);
	}

	$image_object_obj->set(array('row'=>$row));


	$image_size = getimagesize($image_data, $image_info);
	print_r($image_size);
	print_r($image_info);

	$file_name = 'test-image.jpg';
	$image_data_array = explode(',', $image_data);

	file_put_contents(PATH_IMAGE.$file_name,  base64_decode($image_data_array[count($image_data_array)-1]));

	$image_size = getimagesize('http://www.twmg.com.au/assets/template/images/portfolio/csr-digital-agency-sydney.jpg', $image_info);
	print_r($image_size);*/
?>