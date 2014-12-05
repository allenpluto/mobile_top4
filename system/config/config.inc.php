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
define('PATH_SYSTEM', PATH_BASE . 'system/config/');
define('PATH_INCLUDE', PATH_BASE . 'system/include/');
define('PATH_CLASS', PATH_BASE . 'system/class/');

// Load Pre-Include Functions
include_once(PATH_INCLUDE.'db.inc.php');

// Load Classes
set_include_path(PATH_CLASS);
spl_autoload_extensions('.class.php');
spl_autoload_register();


?>