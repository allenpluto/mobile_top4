<?php
// Database
define('DATABASE_HOST', '127.0.0.1');
define('DATABASE_NAME', 'stgtop4_domain1');
define('DATABASE_USER', 'stgtop4_dbuser');
define('DATABASE_PASSWORD', 'edir!2011');
define('DATABASE_CHARSET', 'utf8');
define('DATABASE_TABLE_PREFIX', 'tbl_');

<<<<<<< HEAD
<<<<<<< Updated upstream
// Core Paths
define('PATH_BASE', '/wamp/www/allen_frame_trial/');
=======
// URI
define('URI_DOMAIN','http://mobile.top4.com.au/');
define('URI_SITE_PATH','');
define('URI_SITE_BASE',URI_DOMAIN . URI_SITE_PATH);

// Core Paths
define('PATH_BASE', '/home/mobiletop4/public_html/');

>>>>>>> Stashed changes
=======
// URI
define('URI_DOMAIN','http://localhost/');
define('URI_SITE_PATH','allen_frame_trial/');
define('URI_SITE_BASE',URI_DOMAIN . URI_SITE_PATH);

// Core Paths
define('PATH_BASE', '/wamp/www/allen_frame_trial/');

>>>>>>> Universal-ID
define('PATH_SYSTEM', PATH_BASE . 'system/');
define('PATH_CLASS', PATH_SYSTEM . 'class/');
define('PATH_INCLUDE', PATH_SYSTEM . 'include/');
define('PATH_TEMPLATE', PATH_SYSTEM . 'template/');

define('PATH_ASSET', PATH_BASE . 'asset/');
define('PATH_IMAGE', PATH_ASSET . 'image/');

// File Extensions
define('FILE_EXTENSION_CLASS', '.class.php');
define('FILE_EXTENSION_INCLUDE', '.inc.php');
define('FILE_EXTENSION_TEMPLATE', '.tpl');

// Prefix
define('PREFIX_TEMPLATE_PAGE', 'page_');

// Load Pre-Include Functions (Functions that Classes May Use)
// Preference (Global constant variables, can be overwritten)
include_once(PATH_INCLUDE.'preference'.FILE_EXTENSION_INCLUDE);
$global_preference = preference::get_instance();
$global_preference->default_entity_row_max = 100;
$global_preference->default_view_page_size = 100;
$global_preference->view_category_page_size = 12;
$global_preference->view_business_summary_page_size = 8;

// Message (Global message, record handled errors)
include_once(PATH_INCLUDE.'message'.FILE_EXTENSION_INCLUDE);
$global_message = message::get_instance();

// Database Connection, by default, all connect using a single global variable to avoid multiple db connections
include_once(PATH_INCLUDE.'db'.FILE_EXTENSION_INCLUDE);
$db = new db;

// Format adjust, such as friendly url, phone number, abn...
include_once(PATH_INCLUDE.'format'.FILE_EXTENSION_INCLUDE);
$format = format::get_obj();

// Load Classes
// Each Entity Class represents one and only one table, handle table operations
// View Classes are read only classes, display to front end
// Index Classes are indexed tables for search only
set_include_path(PATH_CLASS.'entity/'.PATH_SEPARATOR.PATH_CLASS.'view/'.PATH_SEPARATOR.PATH_CLASS.'index/');
spl_autoload_extensions(FILE_EXTENSION_CLASS);
spl_autoload_register();

// Load System Functions (Functions that may call Classes)
include_once(PATH_INCLUDE.'content'.FILE_EXTENSION_INCLUDE);
?>