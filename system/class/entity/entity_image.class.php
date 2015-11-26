<?php
// Class Object
// Name: entity_image
// Description: Image Source File, store image in big size, for gallery details, source file to crop... All variation of images (different size thumbs) goes to image_variation table.

// image_id in image_object reference to source image. One source image may have zero to multiple thumbnail (cropped versions) for different scenario. Only source image may save exifData, any thumbnail can be regenerated using source image exifData and 
class entity_image extends entity_thing
{
	var $parameter = array(
		'prefix' => 'image_',
		'select_fields' => array(
			'id' => 'id',
			'friendly_url' => 'friendly_url',
			'name' => 'name',
			'alternate_name' => 'alternate_name',
			'description' => 'description',
			'image_id' => 'image_id',
			'enter_time' => 'enter_time',
			'update_time' => 'update_time',
			'caption' => 'caption',
			'width' => 'width',
			'height' => 'height',
			'type' => 'type'
		),
		'update_fields' => array(
			'friendly_url' => 'friendly_url',
			'name' => 'name',
			'alternate_name' => 'alternate_name',
			'description' => 'description',
			'update_time' => 'update_time',
			'caption' => 'caption',
			'width' => 'width',
			'height' => 'height',
			'type' => 'type'
		)
	);
	var $option = array(
		'db_image_data' => 'false', 
		'update_image' => 'true'
	);


	// class image_object is allowed to be constructed by 'friendly_url' or 'id'. However, if both provided, 'id' overwrite 'friendly_url'.
	function entity_image($parameter = array())
	{
		if (is_array($parameter))
		{
			$get_parameter = Null;
			if (!empty($parameter['get']))
			{
				$get_parameter = $parameter['get'];
				unset($parameter['get']);
			}

			$this->set_parameter($parameter);
			
			if ($get_parameter)
			{
				$this->get($get_parameter);
			}
		}
		else	// Simplified usage, not secured
		{
			if (is_numeric($parameter)) // try to initialize with id
			{
				$this->get(array('id'=>$parameter));
			}
			else // try to initialize with friendly url
			{
				$this->get(array('friendly_url'=>$parameter));
			}
		}

		return $this;
	}

	function set($parameter = array())
	{
		// Class Set Function
		if (empty($parameter['row']))
		{
			if (empty($this->row))
			{
				$this->message[] = 'Error: Empty value input';
				return false;
			}
			else
			{
				$parameter['row'] = $this->row;
			}
		}
		$this->row = array();

		foreach ($parameter['row'] as $row_index => $row_value)
		{
			if ($row_value['image_id'] > 0)
			{
				// For images having source image, do not store source data
				$row_value['source_data'] = '';
			}
		}

		// Call thing::set function
		parent::set($parameter);

		if ($this->option['db_image_data'])
		{
			foreach ($parameter['row'] as $row_index => $row_value)
			{
				if ($row_value['image_id'] > 0)
				{				
					if (!empty($row_value['source_data']))
					{
					}
				}
			}
		}
	
	}


}