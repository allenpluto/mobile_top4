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
        $uri_parameter = $format->uri_decoder($_GET);
        $template = PREFIX_TEMPLATE_PAGE.$namespace;
        $base_render_parameter = array(
            'namespace'=>$namespace,
            'instance'=>$instance
        );
        switch ($namespace)
        {
            case 'business':
//echo '<pre>';
                $view_business_detail_obj = new view_business_detail($instance);
//print_r($view_business_detail_obj);
//exit();
                $view_business_detail_value = $view_business_detail_obj->fetch_value();

                $render_parameter = array(
                    'build_from_content'=>array(
                        array(
                            'title'=>$view_business_detail_value[0]['name'],
                            'meta_description'=>$view_business_detail_value[0]['description'],
                            'body'=>$view_business_detail_obj
                        )
                    )
                );
                $render_parameter = array_merge($base_render_parameter, $render_parameter);
                $view_web_page_obj = new view_web_page(null, $render_parameter);
                $this->content = $view_web_page_obj->render();
                break;
            case 'listing':
                $page_parameter = $format->pagination_param($_GET);
                if ($page_parameter === false) $page_parameter = array();
                switch ($instance)
                {
                    case '':
                        $index_category_obj = new index_category();
                        $index_category_obj->filter_by_active();
                        $index_category_obj->filter_by_listing_count();
                        $view_category_obj = new view_category($index_category_obj->id_group);
                        $inpage_script = '$(document).ready(function(){$(\'.ajax_loader_container\').ajax_loader($.parseJSON(atob(\''.base64_encode(json_encode(array('object_type'=>'business_category','data_encode_type'=>'base64','id_group'=>$view_category_obj->id_group,'page_size'=>$view_category_obj->parameter['page_size'],'page_number'=>$view_category_obj->parameter['page_number'],'page_count'=>$view_category_obj->parameter['page_count']))).'\')));});';
                        $view_web_page_element_obj_body = new view_web_page_element(null, array(
                            'template'=>'element_body_section',
                            'build_from_content'=>array(
                                array(
                                    'id'=>'category_container',
                                    'class_extra'=>' category_block_wrapper',
                                    'title'=>'<h1>Popular Categories</h1>',
                                    'content'=>'<div class="column_container ajax_loader_container">'.$view_category_obj->render().'<div class="clear"></div></div>'
                                ),
                            )
                        ));
                        $render_parameter = array(
                            'build_from_content'=>array(
                                array(
                                    'name'=>'Find Top4 Businesses in Australia',
                                    'meta_description'=>'Find Top4 Businesses in Australia',
                                    'inpage_script'=>$inpage_script,
                                    'body'=>$view_web_page_element_obj_body
                                )
                            )
                        );
                        $render_parameter = array_merge($base_render_parameter, $render_parameter);
                        $view_web_page_obj = new view_web_page(null,$render_parameter);
                        $this->content = $view_web_page_obj->render();

                        break;
                    case 'ajax_load':
                        if (!isset($_POST['object_type']))
                        {
                            $_POST['object_type'] = 'business';
                        }
                        switch($_POST['object_type'])
                        {
                            case 'business_category':
                                $view_category_obj = new view_category($_POST['id_group'],array('page_size'=>$_POST['page_size'],'page_number'=>$_POST['page_number']));
                                $this->content = $view_category_obj->render();
                                break;
                            case 'business':
                            default:
                                // unknown object type default to 'business'
                                $view_business_summary_obj = new view_business_summary($_POST['id_group'],array('page_size'=>$_POST['page_size'],'page_number'=>$_POST['page_number']));
                                $this->content = $view_business_summary_obj->render();
                                break;
                        }

                        if (isset($_POST['data_encode_type']))
                        {
                            switch ($_POST['data_encode_type'])
                            {
                                case 'none':
                                    break;
                                case 'base64':
                                default:
                                    // unknown encode type default to base64
                                    $this->content = base64_encode($this->content);
                                    break;

                            }
                        }

                        break;
                    case 'find':
                        $index_organization_obj = new index_organization();
                        if (empty($uri_parameter['category']))
                        {
                            header('Location: /'.URI_SITE_PATH.$namespace.'/');
                            exit();
                        }

                        $view_category_obj = new view_category($uri_parameter['category']);
                        if ($view_category_obj->id_group == 0)
                        {
                            header('Location: /'.URI_SITE_PATH.$namespace.'/');
                            exit();
                        }
                        $index_organization_obj->filter_by_category($view_category_obj->id_group);

                        if (!empty($uri_parameter['state']))
                        {
                            $index_location_obj = new index_location();
                            $index_location_obj->filter_by_location_parameter($uri_parameter);

                            $index_organization_obj->filter_by_location($index_location_obj->id_group);
                        }
                        $view_business_summary_obj = new view_business_summary($index_organization_obj->id_group, $page_parameter);
                        if (count($view_business_summary_obj->id_group) > 0)
                        {
                            $content = '<div id="search_result_listing_block_wrapper" class="listing_block_wrapper block_wrapper ajax_loader_container">'.$view_business_summary_obj->render().'<div class="clear"></div></div>';
                            $inpage_script = '$(document).ready(function(){$(\'#search_result_listing_block_wrapper\').ajax_loader($.parseJSON(atob(\''.base64_encode(json_encode(array('data_encode_type'=>'base64','id_group'=>$view_business_summary_obj->id_group,'page_size'=>$view_business_summary_obj->parameter['page_size'],'page_number'=>$view_business_summary_obj->parameter['page_number'],'page_count'=>$view_business_summary_obj->parameter['page_count']))).'\')));});';
                        }
                        else
                        {
                            $content = '<div class="section_container container article_container"><div class="section_title"><h2>Here\'s how we can help you find what you\'re looking for:</h2></div><div class="section_content"><ul><li>Check the spelling and try again.</li><li>Try a different suburb or region.</li><li>Try a more general search.</li></ul></div></div>';
                        }

                        $category_row = $view_category_obj->fetch_value();
                        $long_title = 'Top 4 '.$category_row[0]['page_title'];

                        $view_web_page_element_obj_body = new view_web_page_element(null, array(
                            'template'=>'element_body_section',
                            'build_from_content'=>array(
                                array(
                                    'id'=>'listing_search_result_container',
                                    'title'=>'<h1>'.$long_title.'</h1>',
                                    'content'=>$content
                                )
                            )
                        ));

                        $render_parameter = array(
                            'template'=>PREFIX_TEMPLATE_PAGE.'default',
                            'build_from_content'=>array(
                                array(
                                    'title'=>$long_title,
                                    'meta_description'=>$long_title,
                                    'inpage_script'=>$inpage_script,
                                    'body'=>$view_web_page_element_obj_body
                                )
                            )
                        );
                        $render_parameter = array_merge($base_render_parameter, $render_parameter);
                        $view_web_page_obj = new view_web_page(null,$render_parameter);
                        $this->content = $view_web_page_obj->render();

                        break;
                    case 'search':
                        $index_organization_obj = new index_organization();
                        if (!isset($_GET['extra_parameter']))
                        {
                            $GLOBALS['global_message']->warning = __FILE__.'(line '.__LINE__.'): '.get_class($this).' URL pointing to search without search terms';
                            header('Location: /'.URI_SITE_PATH.$namespace.'/');
                            exit();
                        }
                        $ulr_part = $format->split_uri($_GET['extra_parameter']);

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
                        $view_business_summary_obj = new view_business_summary($index_organization_obj->id_group, $page_parameter);
                        if (count($view_business_summary_obj->id_group) > 0)
                        {
                            $content = '<div id="search_result_listing_block_wrapper" class="listing_block_wrapper block_wrapper ajax_loader_container">'.$view_business_summary_obj->render().'<div class="clear"></div></div>';
                            //$inpage_script = '$(document).ready(function(){$(\'.listing_block_wrapper\').data('.json_encode(array('id_group'=>$view_business_summary_obj->id_group,'page_size'=>$view_business_summary_obj->parameter['page_size'],'page_number'=>$view_business_summary_obj->parameter['page_number'],'page_count'=>$view_business_summary_obj->parameter['page_count'])).');});';
                            $inpage_script = '$(document).ready(function(){$(\'#search_result_listing_block_wrapper\').ajax_loader($.parseJSON(atob(\''.base64_encode(json_encode(array('data_encode_type'=>'base64','id_group'=>$view_business_summary_obj->id_group,'page_size'=>$view_business_summary_obj->parameter['page_size'],'page_number'=>$view_business_summary_obj->parameter['page_number'],'page_count'=>$view_business_summary_obj->parameter['page_count']))).'\')));});';
                        }
                        else
                        {
                            $content = '<div class="section_container container article_container"><div class="section_title"><h2>Here\'s how we can help you find what you\'re looking for:</h2></div><div class="section_content"><ul><li>Check the spelling and try again.</li><li>Try a different suburb or region.</li><li>Try a more general search.</li></ul></div></div>';
                            $inpage_script = '';
                        }


                        $long_title = 'Search '.($what?html_entity_decode($what):'Business').' in '.($where?$where:'Australia');

                        $view_web_page_element_obj_body = new view_web_page_element(null, array(
                            'template'=>'element_body_section',
                            'build_from_content'=>array(
                                array(
                                    'id'=>'listing_search_result_container',
                                    'title'=>'<h1>'.$long_title.'</h1>',
                                    'content'=>$content
                                )
                            )
                        ));

                        $render_parameter = array(
                            'template'=>PREFIX_TEMPLATE_PAGE.'default',
                            'build_from_content'=>array(
                                array(
                                    'title'=>$long_title,
                                    'meta_description'=>$long_title,
                                    'inpage_script'=>$inpage_script,
                                    'body'=>$view_web_page_element_obj_body
                                )
                            )
                        );
                        $render_parameter = array_merge($base_render_parameter, $render_parameter);
                        $view_web_page_obj = new view_web_page(null,$render_parameter);
                        $this->content = $view_web_page_obj->render();

                        break;
                    default:
                        header('Location: /'.URI_SITE_PATH.$namespace.'/');
                }
                break;
            default:
                switch ($instance)
                {
                    case 'home':
                        $index_organization_obj = new index_organization();
                        $view_business_summary_obj = new view_business_summary($index_organization_obj->filter_by_featured(),array('page_size'=>4,'order'=>'RAND()'));
                        $inpage_script = '$(document).ready(function(){$(\'.ajax_loader_container\').ajax_loader($.parseJSON(atob(\''.base64_encode(json_encode(array('data_encode_type'=>'base64','id_group'=>$view_business_summary_obj->id_group,'page_size'=>$view_business_summary_obj->parameter['page_size'],'page_number'=>$view_business_summary_obj->parameter['page_number'],'page_count'=>$view_business_summary_obj->parameter['page_count']))).'\')));});';

                        $view_web_page_element_obj_body = new view_web_page_element(null, array(
                            'template'=>'element_body_section',
                            'build_from_content'=>array(
                                array(
                                    'id'=>'home_featured_listing_container',
                                    'title'=>'<h2>Featured</h2>',
                                    'content'=>'<div class="listing_block_wrapper block_wrapper ajax_loader_container">'.$view_business_summary_obj->render().'<div class="clear"></div></div>'
                                ),
                                /*array(
                                    'id'=>'home_listing_category_container',
                                    'title'=>'Category',
                                    'content'=>'Some Category here...'
                                )*/
                            )
                        ));

                        $render_parameter = array(
                            'build_from_content'=>array(
                                array(
                                    'title'=>'Home Page',
                                    'meta_description'=>'Home Description',
                                    'inpage_script'=>$inpage_script,
                                    'body'=>$view_web_page_element_obj_body
                                )
                            )
                        );
                        $render_parameter = array_merge($base_render_parameter, $render_parameter);
                        $view_web_page_obj = new view_web_page(null, $render_parameter);
                        $this->content = $view_web_page_obj->render();
                        break;
                    case '404':
                        header("HTTP/1.0 404 Not Found");
                        print_r('404 Not Found');
                        break;
                    default:
                        $view_web_page_obj = new view_web_page($instance,$uri_parameter);
                        if (count($view_web_page_obj->id_group) == 0)
                        {
                            header('Location: ./404');
                        }
                        $this->content = $view_web_page_obj->render();
                }
        }
    }

    function render($parameter = array())
    {
        header('Content-Type: text/html; charset=utf-8');
        return print_r($this->content);
    }
}