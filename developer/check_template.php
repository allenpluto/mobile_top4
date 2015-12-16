<?php
    include('../system/config/config.php');
    echo '<pre>';

    if (file_exists(PATH_TEMPLATE.$_GET['template'].FILE_EXTENSION_TEMPLATE)) {
        $template = file_get_contents(PATH_TEMPLATE.$_GET['template'].FILE_EXTENSION_TEMPLATE);
        $rendered_content = $template;
        preg_match_all('/\[\[(\W+)?(\w+)\]\]/', $template, $matches, PREG_OFFSET_CAPTURE);

        $template_variables = array();
        $template_variable_column = array();
        foreach($matches[2] as $key=>$value)
        {
            $template_variables[] = $matches[1][$key][0].$value[0];
            if ($matches[1][$key][0] == '*')
            {
                $template_variable_column[] = $value[0];
            }
        }
        asort($template_variables);
        $template_variables = array_unique($template_variables);

        asort($template_variable_column);
        $template_variable_column = array_unique($template_variable_column);

        echo '<div class="system_debug">';
        print_r($template_variables);
        print_r(implode(',',$template_variable_column));
        echo '</div>';
    }
?>