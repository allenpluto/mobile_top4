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
        $format = format::get_obj();
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
                    case '':
                        $index_category_obj = new index_category();
                        $index_category_obj->filter_by_active();
                        $index_category_obj->filter_by_listing_count();
                        $view_category_obj = new view_category($index_category_obj->id_group);
                        $view_web_page_element_obj_body = new view_web_page_element(null, array(
                            'template'=>'element_body_section',
                            'build_from_content'=>array(
                                array(
                                    'id'=>'category_container',
                                    'class_extra'=>' category_block_wrapper',
                                    'title'=>'<h1>Popular Categories</h1>',
                                    'content'=>'<div class="column_container">'.$view_category_obj->render().'<div class="clear"></div></div>'
                                ),
                            )
                        ));
                        $render_parameter = array(
                            'template'=>PREFIX_TEMPLATE_PAGE.'default',
                            'build_from_content'=>array(
                                array(
                                    'name'=>'Find Top4 Businesses in Australia',
                                    'meta_description'=>'Find Top4 Businesses in Australia',
                                    'body'=>$view_web_page_element_obj_body
                                )
                            )
                        );
                        $view_web_page_obj = new view_web_page(null,$render_parameter);
                        $this->content = $view_web_page_obj->render();

                        break;
                    case 'find':
                        $index_organization_obj = new index_organization();
                        if (!isset($_GET['extra_parameter']))
                        {
                            header('Location: /'.URI_SITE_PATH.$namespace.'/');
                            exit();
                        }
                        $ulr_part = $format->extra_parameter($_GET['extra_parameter']);

                        if (empty($ulr_part[0]))
                        {
                            header('Location: /'.URI_SITE_PATH.$namespace.'/');
                            exit();
                        }

                        $view_category_obj = new view_category($ulr_part[0]);

                        if ($view_category_obj->id_group == 0)
                        {
                            header('Location: /'.URI_SITE_PATH.$namespace.'/');
                            exit();
                        }
                        $index_organization_obj->filter_by_category($view_category_obj->id_group);
                        $view_business_summary_obj = new view_business_summary($index_organization_obj->id_group);


                        break;
                    case 'search':
                        $index_organization_obj = new index_organization();
                        if (!isset($_GET['extra_parameter']))
                        {
                            $GLOBALS['global_message']->warning = __FILE__.'(line '.__LINE__.'): '.get_class($this).' URL pointing to search without search terms';
                            header('Location: /'.URI_SITE_PATH.$namespace.'/');
                            exit();
                        }
                        $ulr_part = $format->extra_parameter($_GET['extra_parameter']);

                        if (empty($ulr_part[0]) OR $ulr_part[0] == 'empty')
                        {
                            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' illegal search term';
                            header('Location: /'.URI_SITE_PATH.$namespace.'/');
                            exit();
                        }
                        $what =  trim(html_entity_decode(strtolower($ulr_part[0])));
                        $score = $index_organization_obj->filter_by_keyword($ulr_part[0]);

                        $where = '';
                        if (isset($ulr_part[2]))
                        {
                            $where = trim(html_entity_decode(strtolower($ulr_part[2])));
                            if (strtolower($ulr_part[1]) == 'where' AND $where != 'empty')
                            {
                                $score = $index_organization_obj->filter_by_location($ulr_part[2],array('preset_score'=>$score));
                            }

                        }
                        $view_business_summary_obj = new view_business_summary($index_organization_obj->id_group);

                        $long_title = 'Search '.($what?html_entity_decode($what):'Business').' in '.($where?$where:'Australia');

                        $view_web_page_element_obj_body = new view_web_page_element(null, array(
                            'template'=>'element_body_section',
                            'build_from_content'=>array(
                                array(
                                    'id'=>'listing_search_result_container',
                                    'title'=>'<h1>'.$long_title.'</h1>',
                                    'content'=>'<div class="listing_block_wrapper">'.$view_business_summary_obj->render().'<div class="clear"></div></div>'
                                )
                            )
                        ));

                        $render_parameter = array(
                            'template'=>PREFIX_TEMPLATE_PAGE.'default',
                            'build_from_content'=>array(
                                array(
                                    'title'=>$long_title,
                                    'meta_description'=>$long_title,
                                    'body'=>$view_web_page_element_obj_body
                                )
                            )
                        );
                        $view_web_page_obj = new view_web_page(null,$render_parameter);
                        $this->content = $view_web_page_obj->render();

                        break;
                    default:
                        header('Location: /'.URI_SITE_PATH.$namespace.'/');
                }
                break;
            default:
                $template = PREFIX_TEMPLATE_PAGE.'default';
                switch ($instance)
                {
                    case 'home':
                        $index_organization_obj = new index_organization();
                        $view_business_summary_obj = new view_business_summary($index_organization_obj->filter_by_featured(),array('page_size'=>4,'order'=>'RAND()'));

                        $view_web_page_element_obj_body = new view_web_page_element(null, array(
                            'template'=>'element_body_section',
                            'build_from_content'=>array(
                                array(
                                    'id'=>'home_featured_listing_container',
                                    'title'=>'<h2>Featured</h2>',
                                    'content'=>'<div class="listing_block_wrapper">'.$view_business_summary_obj->render().'<div class="clear"></div></div>'
                                ),
                                /*array(
                                    'id'=>'home_listing_category_container',
                                    'title'=>'Category',
                                    'content'=>'Some Category here...'
                                )*/
                            )
                        ));

                        $render_parameter = array(
                            'template'=>$template,
                            'build_from_content'=>array(
                                array(
                                    'title'=>'Home Page',
                                    'meta_description'=>'Home Description',
                                    'body'=>$view_web_page_element_obj_body
                                )
                            )
                        );
                        $view_web_page_obj = new view_web_page(null, $render_parameter);
                        $this->content = $view_web_page_obj->render();
                        break;
                    case '404':
                        header("HTTP/1.0 404 Not Found");
                        print_r('404 Not Found');
                        break;
                    default:
                        $view_web_page_obj = new view_web_page($instance);
                        if (count($view_web_page_obj->id_group) == 0)
                        {
                            header('Location: ./404');
                        }
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