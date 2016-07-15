<?php
// Class Object
// Name: index_place_suburb
// Description: suburb index

class index_place_suburb extends index
{
    var $parameter = array(
        'primary_key' => 'id'
    );
    function __construct($value = Null, $parameter = array())
    {
        parent::__construct($value, $parameter);

        return $this;
    }

    // Exact Match Search
    function filter_by_location_parameter($value, $parameter = array())
    {
        if (!is_array($value))
        {
            $value = explode('/',$value);
        }
        $filter_parameter = array('where'=>array(),'bind_param'=>array());
        foreach($value as $location_index=>$location_value)
        {
            switch($location_index)
            {
                case 'state':
                case 'region':
                case 'suburb':
                    $filter_parameter['where'][] = 'lower('.$location_index.') = :'.$location_index;
                    $filter_parameter['bind_param'][':'.$location_index] = $location_value;
                    break;
                default:
                    //$GLOBALS['global_message']->notice = __FILE__.'(line '.__LINE__.'): ['.get_class($this).'] illegal location value ['.$location_index.':'.$location_value.'] provided for '.__METHOD__;
            }
        }
        if (count($filter_parameter['where']) > 0)
        {
            return parent::get($filter_parameter);
        }
        else return false;

    }

    // Filter by suburb/region/state name, get id(s), Fuzzy Search
    function filter_by_location_text($value, $parameter = array())
    {
        if (empty($value)) return false;

        $filter_parameter = [
            'where'=>'formatted_address = :formatted_address',
            'bind_param'=> [':formatted_address'=>$value]
        ];
        $filter_parameter = array_merge($filter_parameter,$parameter);

        $result = array();

        $this->get($filter_parameter);
        if (count($this->id_group)>0)
        {
            $result['status'] = 'exact_match';
            $result['value'] = $this->id_group;
        }
        else
        {
            $this->reset();
            $filter_parameter = [
                'where'=>'suburb = :suburb',
                'bind_param'=> [':suburb'=>$value]
            ];
            $filter_parameter = array_merge($filter_parameter,$parameter);
            $this->get($filter_parameter);

            if (count($this->id_group) == 1)
            {
                $result['status'] = 'exact_match';
                $result['value'] = $this->id_group;
            }
            else
            {
                $this->reset();
                $filter_parameter = array(
                    'value'=> $value,
                    'fulltext_mode'=>'nature-language',
                    'fulltext_index_key'=>'fulltext_location',
                    'fulltext_min_score'=>0.5
                );
                $filter_parameter = array_merge($filter_parameter,$parameter);
                $result_score = $this->full_text_search($filter_parameter);

                if (count($this->id_group)>0)
                {
                    $result['status'] = 'text_match';
                    $result['value'] = $this->id_group;
                    $result['score'] = $result_score;
                }
                else
                {
                    $result['status'] = 'fail';
                }
            }
        }
        return $result;
    }
}