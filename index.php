<?php
	include('system/config/config.php');
    $page_content = new content($_GET);
    $page_content->render();
?>