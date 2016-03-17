<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/03/2016
 * Time: 6:00 PM
 */
$version = '11mar2016';
chdir('C:\wamp\www\allen_frame_trial\developer');
exec('java -jar yuicompressor-2.4.8.jar ../content/js/default.js -o ../asset/js/default.'.$version.'.min.js', $result);
echo '<pre>';
print_r('default_'.$version.'.min.js exist: '.file_exists('default_'.$version.'.min.js'));
print_r($result);