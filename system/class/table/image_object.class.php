<?php
// Class Object
// Name: image_object
// Description: Image Source File, store image in big size, for gallery details, source file to crop... All variation of images (different size thumbs) goes to image_variation table.

// image_id in image_object reference to source image. One source image may have zero to multiple thumbnail (cropped versions) for different scenario. Only source image may save exifData, any thumbnail can be regenerated using source image exifData and 
class image_object
{
	var $parameters = array(
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
			'exifData' => 'exifData',
			'email' => 'email',
			'width' => 'width',
			'height' => 'height',
			'type' => 'type'
		)
	);

	// class image_object is allowed to be constructed by 'friendly_url' or 'id'. However, if both provided, 'id' overwrite 'friendly_url'.
	function image_object($parameters = array())
	{
		if (is_array($parameters))
		{
			$get_parameters = Null;
			if (!empty($parameters['get']))
			{
				$get_parameters = $parameters['get'];
				unset($parameters['get']);
			}

			$this->set_parameters($parameters);
			
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

	function set($parameters = array())
	{
		// Class Set Function


		// Call thing::set function
		parent::set($parameters);
	}


}