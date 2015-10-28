<?php
// Database
define('DATABASE_HOST', '127.0.0.1');
define('DATABASE_NAME', 'allen_frame_trial');
define('DATABASE_USER', 'root');
define('DATABASE_PASSWORD', '');
define('DATABASE_CHARSET', 'utf8');
define('DATABASE_TABLE_PREFIX', 'tbl_');
define('DATABASE_ROW_LIMIT', 100);			//Number of rows feteched per query

// Core Paths
define('PATH_BASE', '/wamp/www/allen_frame_trial/');
define('PATH_SYSTEM', PATH_BASE . 'system/');
define('PATH_INCLUDE', PATH_SYSTEM . 'include/');
define('PATH_CLASS', PATH_SYSTEM . 'class/');

define('PATH_ASSET', PATH_BASE . 'asset/');
define('PATH_IMAGE', PATH_ASSET . 'image/');

// Load Pre-Include Functions (Functions that Classes May Use)
include_once(PATH_INCLUDE.'db.inc.php');
include_once(PATH_INCLUDE.'format.inc.php');

// Load Classes
// Each Entity Class represents one and only one table, handle table operations
// View Classes are read only classes, display to front end
// Index Classes are indexed tables for search only
set_include_path(PATH_CLASS.'entity/;'.PATH_CLASS.'view/;'.PATH_CLASS.'index/');
spl_autoload_extensions('.class.php');
spl_autoload_register();

// Load System Functions (Functions that may call Classes)
?>