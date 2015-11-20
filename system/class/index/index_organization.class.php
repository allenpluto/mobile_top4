<?php
// Class Object
// Name: index_organization
// Description: entity_organization's main index table, include all possible search fields

class index_organization extends index
{
    function __construct($value = Null, $parameters = array())
    {
        parent::__construct($value, $parameters);

        return $this;
    }

    function filter_by_category($value = null, $parameters = array())
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

        parent::get($filer_parameters);
    }
}

?>