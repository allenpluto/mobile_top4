<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/03/2016
 * Time: 2:28 PM
 */

include('../system/config/config.php');

$value = 'abcabcabc';
$value2 = 'abcabcac';

$pattern = '/(abc)++(.)*c/s';
$pattern2 = '/(abc)+(.)*c/s';

echo 'Pattern 1 Test: <br>';
echo preg_match($pattern, $value);
echo '<br>';
echo preg_match($pattern, $value2);
echo '<br>';

echo 'Pattern 2 Test: <br>';
echo preg_match($pattern2, $value);
echo '<br>';
echo preg_match($pattern2, $value2);
echo '<br>';

$css = file_get_contents('../content/css/default.css');
file_put_contents(PATH_CACHE_CSS.'test.css',$format->minify_css($css));

$js = file_get_contents('../content/js/default.js');
file_put_contents(PATH_CACHE_JS.'test.js',$format->minify_js($js));

echo '<link href="test.css" type="text/css" rel="stylesheet">';
echo '<script type="text/javascript" src="../content/js/jquery-1.11.3.js"></script>';
echo '<script type="text/javascript" src="test.js"></script>';