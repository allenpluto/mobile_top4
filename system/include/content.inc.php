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
//echo '<pre>';
                $view_business_detail_obj = new view_business_detail($instance);
//print_r($view_business_detail_obj);
//exit();
                $view_business_detail_value = $view_business_detail_obj->fetch_value();
                $render_parameters = array(
                    'template'=>$template,
                    'extra_content'=>array(
                        'title'=>$view_business_detail_value[0]['name'],
                        'meta_description'=>$view_business_detail_value[0]['description'],
                        'business_detail_content'=>$view_business_detail_obj
                    )
                );
                $this->content = $view_business_detail_obj->render($render_parameters);
                break;
            default:
                $template = PREFIX_TEMPLATE_PAGE.'default';
                switch ($instance)
                {
                    case 'home':
                        $view_web_page_obj = new view_web_page();
                        $template = PREFIX_TEMPLATE_PAGE.'master';

                        $view_business_summary_obj = new view_business_summary(array(12026, 10596,11760,65031,65083,65100,65217,65667),array('page_size'=>4,'order'=>'RAND()'));
                        $view_business_summary_obj->set_page_size(4);

                        $render_parameters = array(
                            'template'=>$template,
                            'extra_content'=>array(
                                'title'=>'Home Page',
                                'meta_description'=>'Home Description',
                                'featured'=>$view_business_summary_obj
                            )
                        );
                        $this->content = $view_web_page_obj->render($render_parameters);
                        break;
                    default:
                        $view_web_page_obj = new view_web_page($instance);
                        $template = PREFIX_TEMPLATE_PAGE.'static';
                        $this->content = $view_web_page_obj->render(array('template'=>$template));
                }
        }
    }

    function render($parameter = array())
    {
        header('Content-Type: text/html; charset=utf-8');
        return print_r($this->content);
    }
}