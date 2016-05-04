<?php
// URI
define('URI_SITE_BASE',URI_DOMAIN . URI_SITE_PATH);

define('URI_ASSET', URI_SITE_BASE . 'asset/');
define('URI_IMAGE', URI_ASSET . 'image/');

define('URI_CONTENT', URI_SITE_BASE . 'content/');
define('URI_CONTENT_CSS', URI_CONTENT . 'css/');
define('URI_CONTENT_IMAGE', URI_CONTENT . 'image/');
define('URI_CONTENT_JS', URI_CONTENT . 'js/');

// Core Paths
define('PATH_SYSTEM', PATH_BASE . 'system/');
define('PATH_CLASS', PATH_SYSTEM . 'class/');
define('PATH_INCLUDE', PATH_SYSTEM . 'include/');
define('PATH_TEMPLATE', PATH_SYSTEM . 'template/');

define('PATH_ASSET', PATH_BASE . 'asset/');
define('PATH_IMAGE', PATH_ASSET . 'image/');
define('PATH_CACHE', PATH_ASSET . 'cache/');
define('PATH_CACHE_CSS', PATH_CACHE . 'css/');
define('PATH_CACHE_FORMAT', PATH_CACHE . 'format/');
define('PATH_CACHE_JS', PATH_CACHE . 'js/');
define('PATH_CACHE_PAGE', PATH_CACHE . 'page/');

define('PATH_CONTENT', PATH_BASE . 'content/');
define('PATH_CONTENT_CSS', PATH_CONTENT . 'css/');
define('PATH_CONTENT_IMAGE', PATH_CONTENT . 'image/');
define('PATH_CONTENT_JAR', PATH_CONTENT . 'jar/');
define('PATH_CONTENT_JS', PATH_CONTENT . 'js/');

// File Extensions
define('FILE_EXTENSION_CLASS', '.class.php');
define('FILE_EXTENSION_INCLUDE', '.inc.php');
define('FILE_EXTENSION_TEMPLATE', '.tpl');
define('FILE_EXTENSION_CATCH', '.catch');

// Prefix
define('PREFIX_TEMPLATE_PAGE', 'page_');

// Load Pre-Include Functions (Functions that Classes May Use)
// Preference (Global variables, can be overwritten)
include_once(PATH_INCLUDE.'preference'.FILE_EXTENSION_INCLUDE);
$global_preference = preference::get_instance();
$global_preference->default_entity_row_max = 1;
$global_preference->default_view_page_size = 100;
$global_preference->view_category_page_size = 12;
$global_preference->view_business_summary_page_size = 8;

$global_preference->image_size_xxs = 45;
$global_preference->image_size_xs = 90;
$global_preference->image_size_s = 180;
$global_preference->image_size_m = 300;
$global_preference->image_size_l = 480;
$global_preference->image_size_xl = 800;
$global_preference->image_size_xxl = 1200;

$global_preference->ajax_data_encode = 'base64';

$global_preference->minify_html = false;
$global_preference->minify_css = false;
$global_preference->minify_js = false;

$global_preference->page_cache = true;

$global_preference->environment = 'production';

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

// Other configurations
// Google Analytic Tracking ID, set as '' to disable
$global_preference->ga_tracking_id = '';
?>