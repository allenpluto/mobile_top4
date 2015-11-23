<?php
// Class Object
// Name: index_organization
// Description: entity_organization's main index table, include all possible search fields

class index_organization extends index
{
    var $parameters = array(
        'table' => 'listing'
    );

    function __construct($value = Null, $parameters = array())
    {
        parent::__construct($value, $parameters);

        return $this;
    }

    function filter_by_category($value, $parameters = array())
    {
        $format = format::get_obj();
        $category_id_group = $format->id_group(array('value'=>$value,'key_prefix'=>':category_id_'));
        if ($category_id_group === false)
        {
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' invalid category id(s)';
            return false;
        }

        $filer_parameters = array(
            'primary_key' => 'listing_id',
            'table' => 'listing_category',
            'where' => 'category_id IN ('.implode(',',array_keys($category_id_group)).')',
        );

        $filer_parameters = array_merge($filer_parameters, $parameters);
        if (!isset($filer_parameters['bind_param'])) $filer_parameters['bind_param'] = array();
        $filer_parameters['bind_param'] = array_merge($filer_parameters['bind_param'], $category_id_group);

        return parent::get($filer_parameters);
    }

    function filter_by_featured($parameters = array())
    {
        $filer_parameters = array(
            'primary_key' => 'listing_id',
            'table' => 'listingfeatured'
        );

        $filer_parameters = array_merge($filer_parameters, $parameters);
        return parent::get($filer_parameters);
    }

    function full_text_search($value, $parameters = array())
    {
        if (isset($value[0])) $keyword = $value[0];
        if (isset($value['keyword'])) $keyword = $value['keyword'];
        if (!isset($keyword)) $keyword = '';

        if (isset($value[1])) $location = $value[1];
        if (isset($value['location'])) $location = $value['location'];
        if (!isset($location)) $location = '';

        // keywords part allow &, ' as special characters, however, they are not fulltext searchable, need to be separated
        if (preg_match('/[\&\']/', $keyword))
        {
            $keyword_items = explode(' ',$keyword);
            foreach ($keyword_items as $keyword_item_index=>$keyword_item_value)
            {

            }
        }

        $keyword_refined = preg_replace('/[^a-zA-Z0-9\s]+/', ' ', $keyword);
        $keyword_refined = preg_replace('/[\s]+/',' ',$keyword_refined);
        $keyword_refined = trim($keyword_refined);
        $keyword_refined = strtolower($keyword_refined);

        $location_refined = preg_replace('/[^a-zA-Z0-9\s]+/', ' ', $location);
        $location_refined = preg_replace('/[\s]+/',' ',$location_refined);
        $location_refined = trim($location_refined);
        $location_refined = strtolower($location_refined);

    }
}

?>