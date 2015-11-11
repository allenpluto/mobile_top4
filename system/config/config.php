<?php
// Database
define('DATABASE_HOST', '127.0.0.1');
define('DATABASE_NAME', 'allen_frame_trial');
define('DATABASE_USER', 'root');
define('DATABASE_PASSWORD', '');
define('DATABASE_CHARSET', 'utf8');
define('DATABASE_TABLE_PREFIX', 'tbl_');

// Core Paths
define('PATH_BASE', '/wamp/www/allen_frame_trial/');

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
$global_preference->business_summary_view_page_size = 12;

// Message (Global message, record handled errors)
include_once(PATH_INCLUDE.'message'.FILE_EXTENSION_INCLUDE);
$global_message = message::get_instance();

// Database Connection, by default, all connect using a single global variable to avoid multiple db connections
include_once(PATH_INCLUDE.'db'.FILE_EXTENSION_INCLUDE);
$db = new db;

// Format adjust, such as friendly url, phone number, abn...
include_once(PATH_INCLUDE.'format'.FILE_EXTENSION_INCLUDE);

// Load Classes
// Each Entity Class represents one and only one table, handle table operations
// View Classes are read only classes, display to front end
// Index Classes are indexed tables for search only
set_include_path(PATH_CLASS.'entity/;'.PATH_CLASS.'view/;'.PATH_CLASS.'index/');
spl_autoload_extensions(FILE_EXTENSION_CLASS);
spl_autoload_register();

// Load System Functions (Functions that may call Classes)
include_once(PATH_INCLUDE.'content'.FILE_EXTENSION_INCLUDE);
?>