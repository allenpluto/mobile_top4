<?php
// Database
define('DATABASE_HOST', '127.0.0.1');
define('DATABASE_NAME', 'stgtop4_social_directory');
define('DATABASE_USER', 'root');
define('DATABASE_PASSWORD', '');
define('DATABASE_CHARSET', 'utf8');
define('DATABASE_PREFIX', 'top4_');
define('DATABASE_LIMIT', 10);

// Core Paths
define('PATH_BASE', '/wamp/www/allen_frame_trial/');
define('PATH_SYSTEM', PATH_BASE . 'system/');
define('PATH_INCLUDE', PATH_SYSTEM . 'include/');
define('PATH_CLASS', PATH_SYSTEM . 'class/');

define('PATH_ASSET', PATH_BASE . 'asset/');
define('PATH_IMAGE', PATH_ASSET . 'image/');

// Load Pre-Include Functions (Functions that Classes May Use)
include_once(PATH_INCLUDE.'db.inc.php');

// Load Classes, table Classes represent one and only one table operations, join table SELECT are considered views that should be done in System Functions
set_include_path(PATH_CLASS.'table/;'.PATH_CLASS.'view/');
spl_autoload_extensions('.class.php');
spl_autoload_register();

// Load System Functions (Functions that may call Classes)
?>