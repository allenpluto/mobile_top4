<?php
// Class Object
// Name: index_postcode
// Description: postcode's main index table, include all possible search fields

class index_postcode extends index
{
    var $parameters = array(
        'table' => 'top4_main.postcode_suburb'
    );

    function __construct($value = Null, $parameters = array())
    {
        parent::__construct($value, $parameters);

        return $this;
    }

    protected function filter_by_word($value)
    {
        if ($this->_initialized AND empty($this->id_group)) return false;

        if (is_numeric($value))
        {
            $filter_parameters = array(
                'where' => 'post_code = :post_code',
                'bind_param' => array(':post_code'=>$value)
            );
        }
        else
        {
            $state_list = [
                'new south wales' => 'nsw',
                'victoria' => 'vic',
                'queensland' => 'qld',
                'australian capital territory' => 'act',
                'northern territory' => 'nt',
                'south australia' => 'sa',
                'western australia' => 'wa',
                'tasmania' => 'tas'
            ];
            if (isset($state_list[$value]))
            {
                // Text matches state long name, change it into state short name
                $value = $state_list[$value];
            }
            $filter_parameters = array(
                'where' => 'lower(suburb) = :location_text OR lower(region) = :location_text OR lower(state) = :location_text',
                'bind_param' => array(':location_text'=>$value)
            );
        }
        return parent::get($filter_parameters);
    }

    // Filter by suburb name, get id(s)
    function filter_by_location_text($value, $parameters = array())
    {
        $value_parts = explode(',',$value);
        foreach ($value_parts as $value_part_index=>$value_part)
        {
            $value_part = preg_replace('/[^a-zA-Z0-9\s\']+/', '', $value_part);
            $value_part = preg_replace('/\'/', '\\\'', $value_part);
            $value_part = preg_replace('/[\s]+/',' ',$value_part);
            $value_part = trim($value_part);
            $value_part = strtolower($value_part);

            $value_parts[$value_part_index] = $value_part;
        }

        foreach ($value_parts as $value_part_index=>$value_part)
        {
            $this->filter_by_word($value_part);
        }

        if (count($this->id_group) == 0) return false;
        else return $this->id_group;
    }


}