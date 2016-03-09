<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/03/2016
 * Time: 11:29 AM
 */

$request_uri = 'https://api.lessannoyingcrm.com?UserCode=80A4G&APIToken=8WWPK860YK7BR0VMW3S9KYP5F2NF0DXFDZMXBQ83X57JV04FDW&Function=CreateContact&Parameters=%7B%22FullName%22%3A%22Allen+Wu%22%2C%22Email%22%3A%5B%7B%22Text%22%3A%22allen%40twmg.com.au%22%2C%22Type%22%3A%22Work%22%7D%5D%2C%22Phone%22%3A%5B%7B%22Text%22%3A%2296392711%22%2C%22Type%22%3A%22Work%22%7D%5D%7D';

echo '<strong>Source: </strong>http://mobile.top4.com.au/robots.txt';
echo '<br><strong>Result: </strong>';
print_r(file_get_contents('http://mobile.top4.com.au/robots.txt'));
echo '<br>';
echo '<br>';

print_r('<strong>Source: </strong>'.$request_uri);
echo '<br><strong>Result: </strong>';
print_r(file_get_contents($request_uri));