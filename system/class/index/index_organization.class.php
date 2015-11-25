<?php
// Class Object
// Name: index_organization
// Description: organization's main index table, include all possible search fields

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

    function filter_by_featured($parameters = array())
    {
        $filer_parameters = array(
            'primary_key' => 'listing_id',
            'table' => 'listingfeatured'
        );

        $filer_parameters = array_merge($filer_parameters, $parameters);
        return parent::get($filer_parameters);
    }

    // Exact Match Search
    function filter_by_category($value, $parameters = array())
    {
        $format = format::get_obj();
        $category_id_group = $format->id_group(array('value'=>$value,'key_prefix'=>':category_id_'));
        if ($category_id_group === false)
        {
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' invalid category id(s)';
            return false;
        }

        $filter_parameters = array(
            'primary_key' => 'listing_id',
            'table' => 'listing_category',
            'where' => 'category_id IN ('.implode(',',array_keys($category_id_group)).')',
        );

        $filter_parameters = array_merge($filter_parameters, $parameters);
        if (!isset($filter_parameters['bind_param'])) $filter_parameters['bind_param'] = array();
        $filter_parameters['bind_param'] = array_merge($filter_parameters['bind_param'], $category_id_group);

        return parent::get($filter_parameters);
    }

    function filter_by_suburb($value, $parameters = array())
    {
        $format = format::get_obj();
        $postcode_suburb_id_group = $format->id_group(array('value'=>$value,'key_prefix'=>':postcode_suburb_id_'));
        if ($postcode_suburb_id_group === false)
        {
            $GLOBALS['global_message']->error = __FILE__.'(line '.__LINE__.'): '.get_class($this).' invalid postcode_suburb id(s)';
            return false;
        }

        $filter_parameters = array(
            'where' => 'postcode_suburb_id IN ('.implode(',',array_keys($postcode_suburb_id_group)).')',
        );
        $filter_parameters = array_merge($filter_parameters, $parameters);
        if (!isset($filter_parameters['bind_param'])) $filter_parameters['bind_param'] = array();
        $filter_parameters['bind_param'] = array_merge($filter_parameters['bind_param'], $postcode_suburb_id_group);

        return parent::get($filter_parameters);
    }

    // Fuzzy Search
    function filter_by_keywords($value, $parameters = array())
    {
        $filter_parameters = array(
            'where' => 'title LIKE CONCAT(\'%\',:keyword,\'%\')',
            'bind_param' => array(':keyword'=>$value)
        );
        $result_id_group = parent::get($filter_parameters);
        if ($result_id_group === false) $result_id_group = array();
        print_r($result_id_group);

        $format = format::get_obj();
        $keyword_phrases = $format->search_term($value);
        $keyword = implode(' ',$keyword_phrases);

        if (!empty($keyword))
        {
            $this->reset();
            $filter_parameters = array(
                'calculated_field' => array(
                    'title' => 'title',
                    'score' => 'MATCH(title, description, keywords) AGAINST (:keyword IN BOOLEAN MODE) / '.count($keyword_phrases)
                    //'score' => 'MATCH(title) AGAINST (:keyword IN BOOLEAN MODE) / '.count($keyword_phrases)
                ),
                'bind_param' => array(
                    ':keyword' => $keyword
                ),
                'where' => 'MATCH(title, description, keywords) AGAINST (:keyword) > 0',
                //'where' => 'MATCH(title) AGAINST (:keyword) > 0',
                'order' => 'score DESC'
            );
            $new_result = parent::get($filter_parameters);
        }
        else
        {
            $new_result = false;
        }

        $max_score = 1;
        $result = array();
        if ($new_result !== false)
        {
            // retrieve ids only in Like search result (special characters keywords return no results from full text search)
            $result_id_group_diff = array_diff($result_id_group,$this->id_group);
            // retrieve ids only in both search results
            $result_id_group_intersect = array_intersect($result_id_group,$this->id_group);
            // change id array order
            $result_id_group = array_merge($result_id_group_intersect, $result_id_group_diff);
        }
        foreach ($result_id_group as $id_index=>$id)
        {
            $result = array($id=>array('score'=>$max_score)) + $result;
        }
        if ($new_result !== false)
        {
            $result = $result + $new_result;
            $result_id_group = array_merge($result_id_group,$this->id_group);
        }

        $this->id_group = $result_id_group;
        return $result;
    }
}

?>