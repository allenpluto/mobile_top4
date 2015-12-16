<?php
	include('system/config/config.php');

    if (isset($_GET['instance']))
    {
        $format_function = format::get_obj();
        $instance = $format_function->instance_text($_GET['instance']);
        if (isset($_GET['namespace']))
        {
            $namespace = $format_function->instance_text($_GET['namespace']);
        }
        $page_content = new content($instance, $namespace);
        $page_content->render();
    }
    else
    {
        echo 'Page Does Not Exist';
        print_r($_GET);
    }

//    echo '<pre><div class="system_debug">';
//    print_r($GLOBALS['global_message']->all);
//    echo '</div>';
?>