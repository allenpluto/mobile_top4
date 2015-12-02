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
                    case '':
                        $index_category_obj = new index_category();
                        $index_category_obj->filter_by_active();
                        $index_category_obj->filter_by_listing_count();
                        $view_category_obj = new view_category($index_category_obj->id_group);
                        $render_parameter = array(
                            'template'=>PREFIX_TEMPLATE_PAGE.'master',
                            'build_from_content'=>array(
                                array(
                                    'title'=>'Find Top4 Businesses in Australia',
                                    'meta_description'=>'Find Top4 Businesses in Australia',
                                    'body'=>$view_category_obj
                                )
                            )
                        );
                        $view_web_page_obj = new view_web_page(null,$render_parameter);
                        $this->content = $view_web_page_obj->render();

                        break;
                    case 'search':
                        $index_organization_obj = new index_organization();
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
                                    'section_id'=>'listing_search_result_container',
                                    'section_title'=>$long_title,
                                    'section_content'=>'<div class="listing_block_wrapper">'.$view_business_summary_obj->render().'<div class="clear"></div></div>'
                                ),
                                /*array(
                                    'section_id'=>'home_listing_category_container',
                                    'section_title'=>'Category',
                                    'section_content'=>'Some Category here...'
                                )*/
                            )
                        ));

                        $render_parameter = array(
                            'template'=>PREFIX_TEMPLATE_PAGE.'master',
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

                }
                break;
            default:
                $template = PREFIX_TEMPLATE_PAGE.'default';
                switch ($instance)
                {
                    case 'home':
                        $template = PREFIX_TEMPLATE_PAGE.'master';
                        $index_organization_obj = new index_organization();
                        $view_business_summary_obj = new view_business_summary($index_organization_obj->filter_by_featured(),array('page_size'=>4,'order'=>'RAND()'));

                        $view_web_page_element_obj_body = new view_web_page_element(null, array(
                            'template'=>'element_body_section',
                            'build_from_content'=>array(
                                array(
                                    'section_id'=>'home_featured_listing_container',
                                    'section_title'=>'Featured',
                                    'section_content'=>'<div class="listing_block_wrapper">'.$view_business_summary_obj->render().'<div class="clear"></div></div>'
                                ),
                                /*array(
                                    'section_id'=>'home_listing_category_container',
                                    'section_title'=>'Category',
                                    'section_content'=>'Some Category here...'
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