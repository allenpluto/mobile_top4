<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26/02/2016
 * Time: 3:24 PM
 */

$thumb_width = 180;

$source_image_path = 'http://dev.top4.com.au/custom/domain_1/image_files/247_photo_147619.jpg';
$source_image = imagecreatefromjpeg($source_image_path);

list($source_width, $source_height) = getimagesize($source_image_path);
if ($source_width > $thumb_width)
{
    $target_width = $thumb_width;
    $target_height = $source_height / $source_width *  $thumb_width;
}
else
{
    $target_width = $source_width;
    $target_height = $source_height;
}
$target_image = imagecreatetruecolor($target_width, $target_height);

imagecopyresized($target_image, $source_image,0,0,0,0,$target_width, $target_height,$source_width, $source_height);

imagejpeg($target_image, '/wamp/www/allen_frame_trial/asset/image/eden-institute-image.jpg', 60);

$size = getimagesize($source_image_path);
echo $size['mime'];
