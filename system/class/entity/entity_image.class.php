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

    function set($parameter = array())
    {
        if (isset($parameter['row']))
        {
            foreach($parameter['row'] as $record_index => $record)
            {
                if (isset($record['image_src']))
                {
                    $image_size = getimagesize($record['image_src']);
                    if ($image_size !== false)
                    {
                        $parameter['row'][$record_index]['width'] = $image_size[0];
                        $parameter['row'][$record_index]['height'] = $image_size[1];
                        if (isset($image_size['mime'])) $parameter['row'][$record_index]['mime'] = $image_size['mime'];
                    }
                    unset($image_size);

                    $image_data = file_get_contents($record['image_src']);
                    if ($image_data !== false)
                    {
                        $parameter['row'][$record_index]['data'] = $image_data;
                    }
                    unset($image_data);
                }
            }
        }

        $result = parent::set($parameter);
        if ($result === false) return false;
        $format = format::get_obj();

        foreach($this->row as $record_index=>$record)
        {
            if (isset($record['data']))
            {
                $file_name = $format->file_name((!empty($record['friendly_url'])?$record['friendly_url']:$record['name']).'-'.$record['id']);
                switch($record['mime'])
                {
                    case 'image/gif':
                        $file_name .= '.gif';
                        break;
                    case 'image/png':
                        $file_name .= '.png';
                        break;
                    case 'image/jpeg':
                    case 'image/pjpeg';
                    default:
                        $file_name .= '.jpg';
                }
                file_put_contents(PATH_IMAGE.'default/'.$file_name,  $record['data']);
            }
        }

        //$listing_image = explode(',', $_POST['listing_logo_thumb']);

        //file_put_contents($file_path,  base64_decode($listing_image[count($listing_image)-1]));

    }
}