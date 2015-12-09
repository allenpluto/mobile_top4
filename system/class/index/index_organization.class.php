<?php
// Class Object
// Name: index_organization
// Description: organization's main index table, include all possible search fields

class index_organization extends index
{
    var $parameter = array(
        'table' => 'Listing'
    );

    function __construct($value = Null, $parameter = array())
    {
        parent::__construct($value, $parameter);

        return $this;
    }

    function filter_by_active($parameter = array())
    {
        $filer_parameter = array(
            'where' => 'status = \'A\''
        );

        $filer_parameter = array_merge($filer_parameter, $parameter);
        return parent::get($filer_parameter);
    }

    function filter_by_featured($parameter = array())
    {
        $filer_parameter = array(
            'primary_key' => 'listing_id',
            'table' => 'ListingFeatured'
        );

        $filer_parameter = array_merge($filer_parameter, $parameter);
        return parent::get($filer_parameter);
    }

    // Exact Match Search
    function filter_by_category($value, $parameter = array())
    {
        $format = format::get_obj();
        $category_id_group = $format->id_group(array('value'=>$value,'key_prefix'=>':category_id_'));
        if ($category_id_group === false)
        {
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' invalid category id(s)';
            return false;
        }

        $filter_parameter = array(
            'primary_key' => 'listing_id',
            'table' => 'listing_category',
            'where' => 'category_id IN ('.implode(',',array_keys($category_id_group)).')',
        );

        $filter_parameter = array_merge($filter_parameter, $parameter);
        if (!isset($filter_parameter['bind_param'])) $filter_parameter['bind_param'] = array();
        $filter_parameter['bind_param'] = array_merge($filter_parameter['bind_param'], $category_id_group);

        return parent::get($filter_parameter);
    }

    function filter_by_suburb($value, $parameter = array())
    {
        $format = format::get_obj();
        $postcode_suburb_id_group = $format->id_group(array('value'=>$value,'key_prefix'=>':postcode_suburb_id_'));
        if ($postcode_suburb_id_group === false)
        {
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' invalid postcode_suburb id(s)';
            return false;
        }

        $filter_parameter = array(
            'where' => 'postcode_suburb_id IN ('.implode(',',array_keys($postcode_suburb_id_group)).')',
        );
        $filter_parameter = array_merge($filter_parameter, $parameter);
        if (!isset($filter_parameter['bind_param'])) $filter_parameter['bind_param'] = array();
        $filter_parameter['bind_param'] = array_merge($filter_parameter['bind_param'], $postcode_suburb_id_group);

        return parent::get($filter_parameter);
    }

    // Fuzzy Search
    function filter_by_keyword($value, $parameter = array())
    {
        $filter_parameter = array(
            'value'=> $value,
            'special_pattern'=>'\&\'',
            'fulltext_index_key'=>'fulltext_keyword'
        );
        $filter_parameter = array_merge($filter_parameter,$parameter);
        return $this->full_text_search($filter_parameter);
    }

    function filter_by_location($value, $parameter = array())
    {
        $filter_parameter = array(
            'value'=> $value,
            'special_pattern'=>'\'',
            'fulltext_index_key'=>'fulltext_location'
        );
        $filter_parameter = array_merge($filter_parameter,$parameter);
        return $this->full_text_search($filter_parameter);
    }

}

?>