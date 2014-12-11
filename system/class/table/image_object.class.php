<?php
// Class Object
// Name: image_object
// Description: Image Source File, store image in big size, for gallery details, source file to crop... All variation of images (different size thumbs) goes to image_variation table.

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
			'image' => 'image',
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
}