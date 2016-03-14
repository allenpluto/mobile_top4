<?php
	include('system/config/config.php');
$page_content = new content($_GET);
$page_content->render();
exit();

    if (isset($_GET['instance']))
    {
        $format = format::get_obj();
        $_GET['instance'] = $format->file_name($_GET['instance']);
        if (isset($_GET['namespace']))
        {
            $_GET['namespace'] = $format->file_name($_GET['namespace']);
        }
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