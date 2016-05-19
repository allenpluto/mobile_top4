<?php
// Class Object
// Name: entity_image
// Description: Image Source File, store image in big size, for gallery details, source file to crop... All variation of images (different size thumbs) goes to image_variation table.

// image_id in image_object reference to source image. One source image may have zero to multiple thumbnail (cropped versions) for different scenario. Only source image may save exifData, any thumbnail can be regenerated using source image exifData and 
class entity_image extends entity
{
    function __construct($value = Null, $parameter = array())
    {
        $default_parameter = [
            'store_data'=>true
        ];
        $parameter = array_merge($default_parameter, $parameter);
        parent::__construct($value, $parameter);

        if (!$this->parameter['store_data'])
        {
            unset($this->parameter['table_fields']['data']);
        }

        return $this;
    }

    function set($parameter)
    {
        $result = parent::set($parameter);
        if ($result === false) return false;

        //$listing_image = explode(',', $_POST['listing_logo_thumb']);

        //file_put_contents($file_path,  base64_decode($listing_image[count($listing_image)-1]));

    }
}