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
                $render_parameter = array(
                    'template'=>$template,
                    'extra_content'=>array(
                        'title'=>$view_business_detail_value[0]['name'],
                        'meta_description'=>$view_business_detail_value[0]['description'],
                        'business_detail_content'=>$view_business_detail_obj
                    )
                );
                $this->content = $view_business_detail_obj->render($render_parameter);
                break;
            case 'listing':
                switch ($instance)
                {
                    case 'search':
                        $index_organization = new index_organization();
                        if (!isset($_GET['extra_parameter']))
                        {
                            echo 'No keyword no search >_<';
                            exit();
                        }
                        $format = format::get_obj();
                        $ulr_part = $format->extra_parameter($_GET['extra_parameter']);

                        if (empty($ulr_part[0]) OR $ulr_part[0] == 'empty')
                        {
                            echo 'No keyword no search >_<';
                            exit();
                        }
                        $what =  trim(html_entity_decode(strtolower($ulr_part[0])));
                        $score = $index_organization->filter_by_keyword($ulr_part[0]);

                        $where = '';
                        if (isset($ulr_part[2]))
                        {
                            $where = trim(html_entity_decode(strtolower($ulr_part[2])));
                            if (strtolower($ulr_part[1]) == 'where' AND $where != 'empty')
                            {
                                $score = $index_organization->filter_by_location($ulr_part[2],array('preset_score'=>$score));
                            }

                        }

                        $view_business_summary_obj = new view_business_summary($index_organization->id_group);
                        $render_parameter = array(
                            'template'=>PREFIX_TEMPLATE_PAGE.'master',
                            'extra_content'=>array(
                                'title'=>'Search Result',
                                'meta_description'=>'Search '.($what?html_entity_decode($what):'Business').' IN '.($where?$where:'Australia'),
                                'featured'=>$view_business_summary_obj
                            )
                        );
                        $view_web_page_obj = new view_web_page();
                        $this->content = $view_web_page_obj->render($render_parameter);

                        break;
                }
                break;
            default:
                $template = PREFIX_TEMPLATE_PAGE.'default';
                switch ($instance)
                {
                    case 'home':
                        $view_web_page_obj = new view_web_page();
                        $template = PREFIX_TEMPLATE_PAGE.'master';


                        $index_organization = new index_organization();
                        $view_business_summary_obj = new view_business_summary($index_organization->filter_by_featured(),array('page_size'=>4,'order'=>'RAND()'));

                        $render_parameter = array(
                            'template'=>$template,
                            'extra_content'=>array(
                                'title'=>'Home Page',
                                'meta_description'=>'Home Description',
                                'featured'=>$view_business_summary_obj
                            )
                        );
                        $this->content = $view_web_page_obj->render($render_parameter);
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