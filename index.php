<?php
	include('system/config/config.php');

    if (isset($_GET['instance']))
    {
        $format = format::get_obj();
        $instance = $format->file_name($_GET['instance']);
        if (isset($_GET['namespace']))
        {
            $namespace = $format->file_name($_GET['namespace']);
        }
        $page_content = new content($instance, $namespace);
        $page_content->render();
    }
    else
    {
        header('Location: /'.URI_SITE_BASE);
        //echo 'Page Does Not Exist';
        //print_r($_GET);
    }

    //echo '<pre><div class="system_debug">';
    //print_r($GLOBALS['global_message']->all);
    //echo '</div>';
?>