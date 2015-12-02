<?php
// Class Object
// Name: index_category
// Description: organization's main index table, include all possible search fields

class index_category extends index
{
    var $parameter = array(
        'table' => 'ListingCategory'
    );

    function __construct($value = Null, $parameter = array())
    {
        parent::__construct($value, $parameter);

        return $this;
    }

    function filter_by_active($parameter = array())
    {
        $filer_parameter = array(
            'where' => 'featured = \'y\''
        );

        $filer_parameter = array_merge($filer_parameter, $parameter);
        return parent::get($filer_parameter);
    }

    function filter_by_listing_count($parameter = array())
    {
        $filer_parameter = array(
            'get_field' => array(
                'listing_count' => 'COUNT(*)'
            ),
            'primary_key' => 'category_id',
            'table' => 'Listing_Category',
            'group' => 'category_id',
            'order' => 'listing_count DESC'
        );

        $filer_parameter = array_merge($filer_parameter, $parameter);
        $result = parent::get($filer_parameter);
        return $result['listing_count'];
    }

    // Exact Match Search
    function filter_by_listing($value, $parameter = array())
    {
        $format = format::get_obj();
        $listing_id_group = $format->id_group(array('value'=>$value,'key_prefix'=>':listing_id_'));
        if ($listing_id_group === false)
        {
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' invalid listing id(s)';
            return false;
        }

        $filter_parameter = array(
            'primary_key' => 'category_id',
            'table' => 'Listing_Category',
            'where' => 'listing_id IN ('.implode(',',array_keys($listing_id_group)).')',
        );

        $filter_parameter = array_merge($filter_parameter, $parameter);
        if (!isset($filter_parameter['bind_param'])) $filter_parameter['bind_param'] = array();
        $filter_parameter['bind_param'] = array_merge($filter_parameter['bind_param'], $listing_id_group);

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

}

?>