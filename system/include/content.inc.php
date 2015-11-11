<?php
// Include Class Object
// Name: content
// Description: web page content functions

// Render template, create html page view...

class content {
    protected $template = null;
    protected $content = array();

    function __construct($instance, $namespace = 'default')
    {
        $template = PREFIX_TEMPLATE_PAGE.$namespace;
        switch ($namespace)
        {
            case 'business':
                $view_business_detail_obj = new view_business_detail($instance);
                $template = PREFIX_TEMPLATE_PAGE.'master';
                $this->content = $view_business_detail_obj->render(array('template'=>$template));
                break;
            default:
                $view_web_page_obj = new view_web_page($instance);

        }
    }

    function render($parameter = array())
    {
        header('Content-Type: text/html; charset=utf-8');
        return print_r($this->content);
    }
}